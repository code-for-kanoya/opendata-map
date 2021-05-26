<?php

/**
 * ユーティリティ名前空間(ApplicationDataManagement)
 */
namespace App\Util;

use \SplFileObject;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * 推奨データセット収集結果データDBモデルクラス
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
class DatasetListCSVImporter
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
            }
            // 入力がUTF-8でない場合、UTF-8に変換を行う。
            $filter = "php://filter/read=convert.iconv.{$encoding}%2Futf-8/resource=";
        }

        // 読込を行うファイルを設定して、リソースパスを作成
        $this->resourcePath = $filter.$filePath;
    }

    /**
     * DBへのインポート処理
     *
     * @param string $dirName ファイル格納フォルダ名
     * @Exception 読込失敗時例外発生
     */
    public function importFile($dirName)
    {
        // 変数の初期化
        $lineNumber = 0; // ループ回数カウント
        $csvTitleTable = []; // CSVの列タイトルと列番号の対応表

        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // CSVからの取込は処理が完了するまで件数が不明の為、不定として(-1)を返却
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

        // 格納フォルダ名より団体コードと団体名を取得しておく
        $code = \Str::of($dirName)->before('_');
        $codeName = \Str::of($dirName)->afterLast('_');

        // 全件デリート
        $record = DataSetList::query()->delete();

        // CSVを1行ずつ処理する
        foreach ($fileObj as $line) {
            // 各列の情報を取得
            if ($lineNumber === 0) {
                // 列タイトルと列番号の対応表を作成
                for ($j = 0; $j < count($line); $j++) {
                    $csvTitleTable[$line[$j]] = $j;
                }
            } else {
                try {
                    // データ行を処理(チェック)
                    if (count($line) < count($csvTitleTable)) {
                        // データ読込エラー
                        throw new \Exception(DatasetCSVTitleName::DATASET_LIST." : {$dirName}-> {$lineNumber} th line's data broken!", 1);
                    }
                    $column_check = \Arr::first($line, function ($value, $key) {
                        return !empty($value);
                    }, false);
                    if ($column_check === false) {
                        // 空行(カラムはあるが値が無い)の為、スキップ
                        \Log::info(DatasetCSVTitleName::DATASET_LIST." : {$dirName}-> {$lineNumber} th line's data skip!");
                        continue;
                    }

                    // データ行を処理(登録)
                    $record = new DataSetList();

                    // 各列のデータを取得
                    $record->code = $line[$csvTitleTable[DatasetListCSVTitleNumber::CODE]]; // 団体コード
                    $record->existsite = $line[$csvTitleTable[DatasetListCSVTitleNumber::EXISTSITE]]; // サイトの有無
                    $record->dataset01 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET01]]; // 01.AED設置箇所一覧
                    $record->dataset02 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET02]]; // 02.介護サービス事業所一覧
                    $record->dataset03 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET03]]; // 03.医療機関一覧
                    $record->dataset04 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET04]]; // 04.文化財一覧
                    $record->dataset05 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET05]]; // 05.観光施設一覧
                    $record->dataset06 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET06]]; // 06.イベント一覧
                    $record->dataset07 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET07]]; // 07.公衆無線LANアクセスポイント一覧
                    $record->dataset08 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET08]]; // 08.公衆トイレ一覧
                    $record->dataset09 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET09]]; // 09.消防水利施設一覧
                    $record->dataset10 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET10]]; // 10.指定緊急避難場所一覧
                    $record->dataset11 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET11]]; // 11.地域・年齢別人口
                    $record->dataset12 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET12]]; // 12.公共施設一覧
                    $record->dataset13 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET13]]; // 13.子育て施設一覧
                    $record->dataset14 = $line[$csvTitleTable[DatasetListCSVTitleNumber::DATASET14]]; // 14.オープンデータ一覧
                    if ($line[$csvTitleTable[DatasetListCSVTitleNumber::EXISTSITE]] === '○') {
                        $record->url = 'https://odcs.bodik.jp/' . $line[$csvTitleTable[DatasetListCSVTitleNumber::CODE]] . '/'; // BODIKオープンデータカタログサイトURL
                    } else {
                        $record->url = ''; // BODIKオープンデータカタログサイトURL
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
                }
            }

            // 行カウントを更新
            $lineNumber += 1;

            // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
            if ($this->callbackInterface !== null) {
                // CSVからの取込について、現在処理が完了した件数を通知
                $this->callbackInterface->progressUpdate($lineNumber);
            }
        }

        // 更新通知処理用コールバックインターフェースが設定されている場合は、処理を移譲する。
        if ($this->callbackInterface !== null) {
            // 更新完了通知
            $this->callbackInterface->progressFinish();
        }
    }
}
