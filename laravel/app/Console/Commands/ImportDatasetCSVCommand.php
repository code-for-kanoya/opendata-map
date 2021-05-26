<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * 標準ログ管理クラス
 */
use Log;

use App\Util\DatasetCSVTitleName;

/**
 * データセットデータ(CSV)インポート処理クラス
 */
use App\Util\DatasetListCSVImporter;
use App\Util\DatasetAedCSVImporter;
use App\Util\DatasetCareServiceCSVImporter;
use App\Util\DatasetMedicalInstitutionsCSVImporter;
use App\Util\DatasetCulturalPropertiesCSVImporter;
use App\Util\DatasetTouristFacilitiesCSVImporter;
use App\Util\DatasetEventsCSVImporter;
use App\Util\DatasetPublicWirelessLanCSVImporter;
use App\Util\DatasetPublicToiletCSVImporter;
use App\Util\DatasetFireIrrigationFacilitiesCSVImporter;
use App\Util\DatasetDesignatedEmergencyEvacuationSiteCSVImporter;
use App\Util\DatasetAreaAgePopulationCSVImporter;
use App\Util\DatasetPublicFacilitiesCSVImporter;
use App\Util\DatasetChildRearingFacilitiesCSVImporter;
use App\Util\DatasetOpenDataCSVImporter;

/**
 * 更新通知処理用コールバックインターフェース
 */
use App\Util\ProgressCallbackInterface;

/**
 * CSVインポートエラークラス
 */
use App\Exceptions\CSVException;
use App\Models\DataSetDesignatedEmergencyEvacuationSite;

class ImportDatasetCSVCommand extends Command implements ProgressCallbackInterface
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import_dataset_csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'importer for dataset datafile';

    /**
     * 処理のエラー件数をカウント
     */
    protected $errorCount = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // データセット格納パスの取得
        $storagePath = storage_path('app/output');
        $dirs = \File::directories($storagePath);

        // 推奨データセット収集結果
        if (!empty(\File::files(storage_path('app')))) {
            $datasetListFile = \File::files(storage_path('app'))[0];
            dump(DatasetCSVTitleName::DATASET_LIST);
            $importer = new DatasetListCSVImporter(storage_path('app/') . $datasetListFile->getfileName(), $this);
            // インポート処理を開始
            $importer->importFile('');
        }

        foreach ($dirs as $dir) {
            // 格納されている全ファイル取得
            $files = \File::files($dir);

            foreach ($files as $file) {
                $extension = \File::extension($file);

                // CSVインポートクラスを生成
                switch (\Str::of($file->getfileName())->before('.')) {
                    case DatasetCSVTitleName::AED:
                        // AED設置箇所一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::AED);
                        $importer = new DatasetAedCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::CARE_SERVICE:
                        // 介護サービス事業所一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::CARE_SERVICE);
                        $importer = new DatasetCareServiceCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::MEDICAL_INSTITUTIONS:
                        // 医療機関一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::MEDICAL_INSTITUTIONS);
                        $importer = new DatasetMedicalInstitutionsCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::CULTURAL_PROPERTIES:
                        // 文化財一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::CULTURAL_PROPERTIES);
                        $importer = new DatasetCulturalPropertiesCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::TOURIST_FACILITIES:
                        // 観光施設一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::TOURIST_FACILITIES);
                        $importer = new DatasetTouristFacilitiesCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::EVENTS:
                        // イベント一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::EVENTS);
                        $importer = new DatasetEventsCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::PUBLIC_WIRELESS_LAN:
                        // 公衆無線LANアクセスポイント一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::PUBLIC_WIRELESS_LAN);
                        $importer = new DatasetPublicWirelessLanCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::PUBLIC_TOILET:
                        // 公衆トイレ一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::PUBLIC_TOILET);
                        $importer = new DatasetPublicToiletCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::FIRE_IRRIGATION_FACILITIES:
                        // 消防水利施設一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::FIRE_IRRIGATION_FACILITIES);
                        $importer = new DatasetFireIrrigationFacilitiesCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::DESIGNATED_EMERGENCY_EVACUATION_SITE:
                        // 指定緊急避難場所一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::DESIGNATED_EMERGENCY_EVACUATION_SITE);
                        $importer = new DatasetDesignatedEmergencyEvacuationSiteCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::AREA_AGE_POPULATION:
                        // 地域・年齢別人口
                        dump(basename($dir).' -> '.DatasetCSVTitleName::AREA_AGE_POPULATION);
                        $importer = new DatasetAreaAgePopulationCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::PUBLIC_FACILITIES:
                        // 公共施設一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::PUBLIC_FACILITIES);
                        $importer = new DatasetPublicFacilitiesCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::CHILD_REARING_FACILITIES:
                        // 子育て施設一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::CHILD_REARING_FACILITIES);
                        $importer = new DatasetChildRearingFacilitiesCSVImporter($file->getpathName(), $this);
                        break;
                    case DatasetCSVTitleName::OPEN_DATA:
                        // オープンデータ一覧
                        dump(basename($dir).' -> '.DatasetCSVTitleName::OPEN_DATA);
                        $importer = new DatasetOpenDataCSVImporter($file->getpathName(), $this);
                        break;
                    default:
                        continue 2;
                }

                // エラー件数を初期化
                $this->errorCount = 0;

                // ファイル格納フォルダ名の取得
                $dirName = \Str::of($dir)->basename();

                // インポート処理を開始
                $importer->importFile($dirName, $extension, $file);
            }
        }
    }

    //========================================================================
    // ProgressCallbackInterfaceの実装
    //========================================================================

    /**
     * 更新処理通知前処理
     *
     * @param $maxCount 処理件数全件。処理開始前に不明な場合は負の数値を返却する。
     */
    public function progressInit($maxCount)
    {
        // CSVからの取込は処理が完了するまで件数が不明の為、最大件数は設定しない。
        $this->bar = $this->output->createProgressBar();
    }

    /**
     * 更新通知処理
     *
     * @param $count 現在処理が完了した件数
     */
    public function progressUpdate($count)
    {
        // 進捗状況を更新
        $this->bar->advance();
    }

    /**
     * 更新完了通知
     */
    public function progressFinish()
    {
        // プログレスバーを完了
        $this->bar->finish();

        // 画面に処理の終了を表示
        if ($this->errorCount > 0) {
            // エラーが発生した場合は、その件数を表示
            $message = " import process ended! but {$this->errorCount} error!";
        } else {
            // 処理の完了を表示
            $message = " import process succeeded!";
        }
        $this->line($message);
    }

    /**
     * エラー通知
     */
    public function progressError(\Exception $e)
    {
        // エラー内容をログに出力する。
        if ($e instanceof CSVException) {
            $message = "DataString[]: {$e->getDataString()}\n"
            . "Message : {$e->getMessage()}\n"
            . "At : [{$e->getLine()}]{$e->getFile()}\n{$e->getTraceAsString()}";
        } else {
            $message = "{$e->getMessage()} : [{$e->getLine()}]{$e->getFile()}";
        }

        \Log::error($message);

        // エラー件数をカウント
        $this->errorCount += 1;
    }
}
