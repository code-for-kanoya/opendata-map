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
 * 観光施設一覧データDBモデルクラス
 */
use App\Models\DataSetTouristFacilities;

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
class DatasetTouristFacilitiesCSVImporter
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
        $sheetData = $sheet->toArray('', true, true, false);

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
        $record = DataSetTouristFacilities::where('code', $code)->delete();

        // データを1行ずつ処理する
        foreach ($data as $line) {
            // 各列の情報を取得
            if ($lineNumber === 0) {
                if ($extension !== 'csv') {
                    // 必須列タイトルチェック
                    $titleCount = 0;
                    for ($j = 0; $j < count($line); $j++) {
                        switch ($line[$j]) {
                            case DatasetTouristFacilitiesCSVTitleNumber::NAME:
                            case DatasetTouristFacilitiesCSVTitleNumber::NAME_KANA:
                            case DatasetTouristFacilitiesCSVTitleNumber::ADDRESS:
                            case DatasetTouristFacilitiesCSVTitleNumber::EXPLANATION:
                                $titleCount += 1;
                                break;
                            default:
                                break;
                        }
                    }
                    if ($titleCount < 4) {
                        // データ不備のため、データセットリストデータの更新を行う。
                        $this->updateDatasetList($code);

                        // 必須列タイトルが足りない為、スキップ
                        $message = DatasetCSVTitleName::TOURIST_FACILITIES." : {$dirName}-> format no match!";
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
                        throw new \Exception(DatasetCSVTitleName::TOURIST_FACILITIES." : {$dirName}-> {$lineNumber} th line's data broken!", 1);
                    }
                    $column_check = Arr::first($line, function ($value, $key) {
                        return !empty($value);
                    }, false);
                    if ($column_check === false) {
                        // 空行(カラムはあるが値が無い)の為、スキップ
                        \Log::info(DatasetCSVTitleName::TOURIST_FACILITIES." : {$dirName}-> {$lineNumber} th line's data skip!");
                        $lineNumber += 1;
                        continue;
                    }

                    // データ行を処理(登録)
                    $record = new DataSetTouristFacilities();

                    // 各列のデータを取得
                    $record->code = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::CODE, '')); // 都道府県コード又は市区町村コード
                    if (empty($record->code) || (strlen($record->code) < 6)) {
                        $record->code = $code; // 都道府県コード又は市区町村コード
                    }
                    $record->no = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::NUMBER, '')); // NO
                    $record->prefecture_name = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::PREFECTURE_NAME, '')); // 都道府県名
                    $record->municipality_name = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::MUNICIPALITY_NAME, '')); // 市区町村名
                    if (empty($record->municipality_name)) {
                        $record->municipality_name = $codeName; // 市区町村名
                    }
                    $record->name = $line[$csvTitleTable[DatasetTouristFacilitiesCSVTitleNumber::NAME]]; // 名称
                    $record->name_kana = $line[$csvTitleTable[DatasetTouristFacilitiesCSVTitleNumber::NAME_KANA]]; // 名称_カナ
                    $record->name_english = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::NAME_ENGLISH, '')); // 名称_英語
                    $record->poi_code = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::POI_CODE, '')); // POIコード
                    $record->address = $line[$csvTitleTable[DatasetTouristFacilitiesCSVTitleNumber::ADDRESS]]; // 住所
                    $record->address_detail = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::ADDRESS_DETAIL, '')); // 方書
                    $record->latitude = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::LATITUDE, '')); // 緯度
                    if (empty($record->latitude) || !is_numeric($record->latitude)) {
                        $record->latitude = 0; // 緯度
                    }
                    $record->longitude = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::LONGITUDE, '')); // 経度
                    if (empty($record->longitude) || !is_numeric($record->longitude)) {
                        $record->longitude = 0; // 経度
                    }
                    $record->available_day = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::AVAILABLE_DAY, '')); // 利用可能曜日
                    $record->start_time = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::START_TIME, '')); // 開始時間
                    $record->end_time = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::END_TIME, '')); // 終了時間
                    $record->available_datetime_special_note = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::AVAILABLE_DATETIME_SPECIAL_NOTE, '')); // 利用可能日時特記事項
                    $record->fee_basic = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::FEE_BASIC, '')); // 料金(基本)
                    $record->fee_detail = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::FEE_DETAIL, '')); // 料金(詳細)
                    $record->explanation = $line[$csvTitleTable[DatasetTouristFacilitiesCSVTitleNumber::EXPLANATION]]; // 説明
                    $record->explanation_english = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::EXPLANATION_ENGLISH, '')); // 説明_英語
                    $record->how_to_access = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::HOW_TO_ACCESS, '')); // アクセス方法
                    $record->parking_infomation = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::PARKING_INFOMATION, '')); // 駐車場情報
                    $record->barrier_free_infomation = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::BARRIER_FREE_INFOMATION, '')); // バリアフリー情報
                    $record->contact_name = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::CONTACT_NAME, '')); // 連絡先名称
                    $record->contact_phone_number = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::CONTACT_PHONE_NUMBER, '')); // 連絡先電話番号
                    $record->contact_extension_number = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::CONTACT_EXTENSION_NUMBER, '')); // 連絡先内線番号
                    $record->image = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::IMAGE, '')); // 画像
                    $record->image_license = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::IMAGE_LICENSE, '')); // 画像_ライセンス
                    $record->url = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::URL, '')); // URL
                    $record->note = Arr::get($line, Arr::get($csvTitleTable, DatasetTouristFacilitiesCSVTitleNumber::NOTE, '')); // 備考

                    if (($record->latitude === 0) || ($record->longitude === 0)) {
                        // マップにプロットできないため、データセットリストデータの更新を行う。
                        $this->updateDatasetList($code);
                    }

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

        $list->dataset05 = '不';

        // 更新処理
        $list->save();
    }
}
