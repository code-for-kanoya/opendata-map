<?php

/**
 * ユーティリティ名前空間(ApplicationDataManagement)
 */
namespace App\Util;

use \SplFileObject;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use duncan3dc\Bom\StreamFilter;
use Arr;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

/**
 * 地域・年齢別人口データDBモデルクラス
 */
use App\Models\DatasetAreaAgePopulation;

/**
 * データセット一覧データDBモデルクラス
 */
use App\Models\DataSetList;

/**
 * 更新通知処理用コールバックインターフェース
 */
use App\Util\ProgressCallbackInterface;

/**
 * CSVインポートエラークラス
 */
use App\Exceptions\CSVException;

/**
 * ユーティリティクラス
 */
use Facades\App\Util\CustomUtility;

/**
 * データセットデータCSV取込
 */
class DatasetAreaAgePopulationCSVImporter
{
    /**
     * ファイル読込用リソースファイルパス
     *
     * フィルターを含むよ読込ファイルパスを保持
     */
    protected $resourcePath;

    /**
     * 更新通知処理用コールバックインターフェース
     */
    protected $callbackInterface;

    /**
     * コンストラクタ
     *
     * @param string $file ファイルパス
     * @param App\Util\ProgressCallbackInterface 処理結果通知用コールバック
     */
    public function __construct($file, ProgressCallbackInterface $callbackInterface = null)
    {
        // 読込を行うファイルを設定して、ファイルオブジェクトを作成
        if (is_string($file)) {
            $filePath = $file;
        } elseif ($file instanceof UploadedFile) {
            // ファイル形式確認
            if ($file->getClientOriginalExtension() !== 'csv') {
                throw new \InvalidArgumentException("construction parameter error: file format error [ext = {$file->getClientOriginalExtension()}]", 1);
            }
            $filePath = $file->getPathname();
        } else {
            throw new \InvalidArgumentException("construction parameter error: file", 1);
        }

        // 更新通知処理用コールバックインターフェースを設定
        $this->callbackInterface = $callbackInterface;

        // 1行分の仮読み込みを行って、エンコードを推定する
        $tmpFile = new SplFileObject($filePath);
        $encodingTarget = $tmpFile->fgets();
        $encoding = CustomUtility::detectEncoding($encodingTarget);
        $tmpFile = null;

        // ファイルエンコーディングがUTF-8でない場合は、文字列フィルターをかける様にする。
        $filter = '';
        if ($encoding !== 'UTF-8') {
            if ($encoding === 'SJIS-win') {
                // SJIS-winの場合、cp932に書き換えないと変換が上手くいかない。
                $encoding = 'cp932';
            } elseif ($encoding === false) {
                if (\File::extension($file) === 'csv') {
                    $encoding = CustomUtility::detect_utf_encoding($file);
                }
            }
            // 入力がUTF-8でない場合、UTF-8に変換を行う。
            $filter = "php://filter/read=convert.iconv.{$encoding}%2Futf-8/resource=";
        } else {
            stream_filter_register("bom-filter", StreamFilter::class);
            $filter = "php://filter/read=bom-filter/resource=";
        }

        // 読込を行うファイルを設定して、リソースパスを作成
        $this->resourcePath = $filter.$filePath;
    }

    /**
     * DBへのCSVインポート処理
     *
     * @param string $dirName ファイル格納フォルダ名
     * @Exception 読込失敗時例外発生
     */
    public function importFile($dirName, $extension, $file)
    {
        // Excelファイルのインポート処理を実行
        if ($extension !== 'csv') {
            $this->importExcelFile($dirName, $extension, $file);
            return;
        }

        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // データの取込は処理が完了するまで件数が不明の為、不定として(-1)を返却
            $this->callbackInterface->progressInit(-1);
        }

        // php7.1でのcsvヘッダ読込のバグに対応
        if (0 === strpos(PHP_OS, 'WIN')) {
            setlocale(LC_CTYPE, 'C');
        }

        // 読込を行うファイルを設定して、ファイルオブジェクトを作成
        $fileObj = new SplFileObject($this->resourcePath);

        // CSV読込を行う。
        $fileObj->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);

        // データインポート開始
        $this->importData($dirName, $fileObj);

        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // 更新完了通知
            $this->callbackInterface->progressFinish();
        }
    }

    /**
     * DBへのExcelインポート処理
     *
     * @param string $dirName ファイル格納フォルダ名
     * @Exception 読込失敗時例外発生
     */
    private function importExcelFile($dirName, $extension, $file)
    {
        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // データの取込は処理が完了するまで件数が不明の為、不定として(-1)を返却
            $this->callbackInterface->progressInit(-1);
        }

        // EXCEL読込を行う。
        if ($extension === 'xlsx') {
            $reader = new Xlsx;
        } else {
            $reader = new Xls;
        }
        $spreadSheet = $reader->load($file->getpathName());
        $sheet = $spreadSheet->getActiveSheet();
        $sheetData = $sheet->toArray('', true, false, false);

        // データインポート開始
        $this->importData($dirName, $sheetData, $extension);

        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // 更新完了通知
            $this->callbackInterface->progressFinish();
        }
    }

    /**
     * DBへのインポート処理
     *
     * @param string $dirName ファイル格納フォルダ名
     * @Exception 読込失敗時例外発生
     */
    public function importData($dirName, $data, $extension = 'csv')
    {
        // 変数の初期化
        $lineNumber = 0; // ループ回数カウント
        $csvTitleTable = []; // CSVの列タイトルと列番号の対応表

        // 格納フォルダ名より団体コードと団体名を取得しておく
        $code = \Str::of($dirName)->before('_')->__toString();
        $codeName = \Str::of($dirName)->afterLast('_')->__toString();

        // 既存登録のデリート
        $record = DatasetAreaAgePopulation::where('code', $code)->delete();

        // データを1行ずつ処理する
        foreach ($data as $line) {
            // 各列の情報を取得
            if ($lineNumber === 0) {
                if ($extension !== 'csv') {
                    // 必須列タイトルチェック
                    $titleCount = 0;
                    for ($j = 0; $j < count($line); $j++) {
                        switch ($line[$j]) {
                            case DatasetAreaAgePopulationCSVTitleNumber::RESEARCH_DATE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AREA_NAME:
                            case DatasetAreaAgePopulationCSVTitleNumber::TOTAL_POPULATION:
                            case DatasetAreaAgePopulationCSVTitleNumber::TOTAL_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::TOTAL_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_0_TO_4_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_0_TO_4_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_5_TO_9_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_5_TO_9_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_10_TO_14_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_10_TO_14_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_15_TO_19_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_15_TO_19_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_20_TO_24_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_20_TO_24_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_25_TO_29_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_25_TO_29_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_30_TO_34_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_30_TO_34_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_35_TO_39_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_35_TO_39_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_40_TO_44_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_40_TO_44_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_45_TO_49_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_45_TO_49_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_50_TO_54_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_50_TO_54_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_55_TO_59_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_55_TO_59_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_60_TO_64_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_60_TO_64_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_65_TO_69_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_65_TO_69_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_70_TO_74_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_70_TO_74_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_75_TO_79_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_75_TO_79_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_80_TO_84_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_80_TO_84_FEMALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_85_OVER_MALE:
                            case DatasetAreaAgePopulationCSVTitleNumber::AGE_85_OVER_FEMALE:
                                $titleCount += 1;
                                break;
                            default:
                                break;
                        }
                    }
                    if ($titleCount < 41) {
                        // データ不備のため、データセットリストデータの更新を行う。
                        $this->updateDatasetList($code);

                        // 必須列タイトルが足りない為、スキップ
                        $message = DatasetCSVTitleName::AREA_AGE_POPULATION." : {$dirName}-> format no match!";
                        \Log::error($message);
                        return;
                    }
                }

                // 列タイトルと列番号の対応表を作成
                for ($j = 0; $j < count($line); $j++) {
                    $csvTitleTable[$line[$j]] = $j;
                }
            } else {
                try {
                    // データ行を処理(チェック)
                    if (count($line) < count($csvTitleTable)) {
                        // データ読込エラー
                        throw new \Exception(DatasetCSVTitleName::AREA_AGE_POPULATION." : {$dirName}-> {$lineNumber} th line's data broken!", 1);
                    }
                    $column_check = Arr::first($line, function ($value, $key) {
                        return !empty($value);
                    }, false);
                    if ($column_check === false) {
                        // 空行(カラムはあるが値が無い)の為、スキップ
                        \Log::info(DatasetCSVTitleName::AREA_AGE_POPULATION." : {$dirName}-> {$lineNumber} th line's data skip!");
                        $lineNumber += 1;
                        continue;
                    }

                    // データ行を処理(登録)
                    $record = new DatasetAreaAgePopulation();

                    // 各列のデータを取得
                    $record->code = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::CODE, '')); // 都道府県コード又は市区町村コード
                    if (empty($record->code) || (strlen($record->code) < 6)) {
                        $record->code = $code; // 都道府県コード又は市区町村コード
                    }
                    $record->area_code = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::AREA_CODE, '')); // 地域コード
                    $record->prefecture_name = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::PREFECTURE_NAME, '')); // 都道府県名
                    $record->municipality_name = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::MUNICIPALITY_NAME, '')); // 市区町村名
                    if (empty($record->municipality_name)) {
                        $record->municipality_name = $codeName; // 市区町村名
                    }
                    $record->research_date = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::RESEARCH_DATE]]; // 調査年月日
                    $record->area_name = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AREA_NAME]]; // 地域名
                    $record->total_population = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::TOTAL_POPULATION]]; // 総人口
                    $record->total_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::TOTAL_MALE]]; // 男性
                    $record->total_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::TOTAL_FEMALE]]; // 女性
                    $record->age_0_to_4_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_0_TO_4_MALE]]; // 0-4歳の男性
                    $record->age_0_to_4_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_0_TO_4_FEMALE]]; // 0-4歳の女性
                    $record->age_5_to_9_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_5_TO_9_MALE]]; // 5-9歳の男性
                    $record->age_5_to_9_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_5_TO_9_FEMALE]]; // 5-9歳の女性
                    $record->age_10_to_14_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_10_TO_14_MALE]]; // 10-14歳の男性
                    $record->age_10_to_14_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_10_TO_14_FEMALE]]; // 10-14歳の女性
                    $record->age_15_to_19_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_15_TO_19_MALE]]; // 15-19歳の男性
                    $record->age_15_to_19_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_15_TO_19_FEMALE]]; // 15-19歳の女性
                    $record->age_20_to_24_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_20_TO_24_MALE]]; // 20-24歳の男性
                    $record->age_20_to_24_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_20_TO_24_FEMALE]]; // 20-24歳の女性
                    $record->age_25_to_29_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_25_TO_29_MALE]]; // 25-29歳の男性
                    $record->age_25_to_29_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_25_TO_29_FEMALE]]; // 25-29歳の女性
                    $record->age_30_to_34_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_30_TO_34_MALE]]; // 30-34歳の男性
                    $record->age_30_to_34_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_30_TO_34_FEMALE]]; // 30-34歳の女性
                    $record->age_35_to_39_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_35_TO_39_MALE]]; // 35-39歳の男性
                    $record->age_35_to_39_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_35_TO_39_FEMALE]]; // 35-39歳の女性
                    $record->age_40_to_44_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_40_TO_44_MALE]]; // 40-44歳の男性
                    $record->age_40_to_44_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_40_TO_44_FEMALE]]; // 40-44歳の女性
                    $record->age_45_to_49_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_45_TO_49_MALE]]; // 45-49歳の男性
                    $record->age_45_to_49_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_45_TO_49_FEMALE]]; // 45-49歳の女性
                    $record->age_50_to_54_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_50_TO_54_MALE]]; // 50-54歳の男性
                    $record->age_50_to_54_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_50_TO_54_FEMALE]]; // 50-54歳の女性
                    $record->age_55_to_59_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_55_TO_59_MALE]]; // 55-59歳の男性
                    $record->age_55_to_59_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_55_TO_59_FEMALE]]; // 55-59歳の女性
                    $record->age_60_to_64_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_60_TO_64_MALE]]; // 60-64歳の男性
                    $record->age_60_to_64_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_60_TO_64_FEMALE]]; // 60-64歳の女性
                    $record->age_65_to_69_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_65_TO_69_MALE]]; // 65-69歳の男性
                    $record->age_65_to_69_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_65_TO_69_FEMALE]]; // 65-69歳の女性
                    $record->age_70_to_74_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_70_TO_74_MALE]]; // 70-74歳の男性
                    $record->age_70_to_74_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_70_TO_74_FEMALE]]; // 70-74歳の女性
                    $record->age_75_to_79_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_75_TO_79_MALE]]; // 75-79歳の男性
                    $record->age_75_to_79_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_75_TO_79_FEMALE]]; // 75-79歳の女性
                    $record->age_80_to_84_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_80_TO_84_MALE]]; // 80-84歳の男性
                    $record->age_80_to_84_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_80_TO_84_FEMALE]]; // 80-84歳の女性
                    $record->age_85_over_male = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_85_OVER_MALE]]; // 85歳以上の男性
                    $record->age_85_over_female = $line[$csvTitleTable[DatasetAreaAgePopulationCSVTitleNumber::AGE_85_OVER_FEMALE]]; // 85歳以上の女性
                    $record->household_count = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::HOUSEHOLD_COUNT, '')); // 世帯数
                    $record->note = Arr::get($line, Arr::get($csvTitleTable, DatasetAreaAgePopulationCSVTitleNumber::NOTE, '')); // 備考

                    // 更新処理
                    $record->save();
                } catch (\Exception $e) {
                    if ($this->callbackInterface !== null) {
                        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
                        $this->callbackInterface->progressError(new CSVException(join(',', $line), $e));
                    } else {
                        // 更新通知処理用コールバックインターフェースが設定されていない場合は、画面とファイルに出力し、改めて例外を発生させる。
                        $message = "\n{$e->getMessage()} : [{$e->getLine()}]{$e->getFile()}\n";
                        $message .= "stack:\n{$e->getTraceAsString()}\n";
                        \Log::error($message);

                        throw new \Exception("UnknownError", 1, $e);
                    }

                    // データ不備のため、データセットリストデータの更新を行う。
                    $this->updateDatasetList($code);
                }
            }

            // 行カウントを更新
            $lineNumber += 1;

            // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
            if ($this->callbackInterface !== null) {
                // データの取込について、現在処理が完了した件数を通知
                $this->callbackInterface->progressUpdate($lineNumber);
            }
        }
    }

    /**
     * データセットリストデータの更新を行う。
     *
     * @param string $code 団体コード
     * @Exception 読込失敗時例外発生
     */
    private function updateDatasetList($code)
    {
        // データセット一覧テーブル更新
        $list = DataSetList::where('code', $code)->first();

        $list->dataset11 = '不';

        // 更新処理
        $list->save();
    }
}
