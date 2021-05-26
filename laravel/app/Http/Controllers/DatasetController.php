<?php

namespace App\Http\Controllers;

use App\Models\DataSetList;
use App\Models\DataSetAed;
use App\Models\DataSetCareService;
use App\Models\DataSetMedicalInstitutions;
use App\Models\DataSetCulturalProperties;
use App\Models\DataSetTouristFacilities;
use App\Models\DataSetEvents;
use App\Models\DataSetPublicWirelessLan;
use App\Models\DataSetPublicToilet;
use App\Models\DataSetFireIrrigationFacilities;
use App\Models\DataSetDesignatedEmergencyEvacuationSite;
use App\Models\DatasetAreaAgePopulation;
use App\Models\DataSetPublicFacilities;
use App\Models\DatasetChildRearingFacilities;
use App\Models\DataSetOpenData;

use Illuminate\Http\Request;

class DatasetController extends Controller
{
    public $select = '';
    public $distance = 20;
    public $municipalityCode = '';

    // データセット一覧データ取得
    public function postDatasetList(Request $request)
    {
        // 都道府県IDをもとに、データセット一覧情報データを取得する
        $prefId = $_POST['prefId'];
        $datasetlistdata = DataSetList::whereRaw('SUBSTRING(code, 1, 2) = :searchId', ['searchId' => $prefId])
                                      ->get();

        // 取得したデータセット一覧情報データ
        return $datasetlistdata;
    }

    // データセット詳細情報取得
    public function postDatasetDetail(Request $request)
    {
        $datasetCode = $_POST['datasetCode'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $this->municipalityCode = $_POST['municipalityCode'];

        $data = null;

        // 各カラム、画面の中央座標からの距離
        $this->select = '*,
                        (6371 *
                          acos(cos(radians('.$lat.')) *
                            cos(radians(latitude)) *
                            cos(radians(longitude) - radians('.$lng.')) +
                            sin(radians('.$lat.')) *
                            sin(radians(latitude))
                          )
                        ) AS distance';

        switch ($datasetCode) {
            case 1:
                // AED設置箇所一覧
                $data = $this->getAed($request);
                break;
            case 2:
                // 介護サービス事業所一覧
                $data = $this->getCareService($request);
                break;
            case 3:
                // 医療機関一覧
                $data = $this->getMedicalInstitutions($request);
                break;
            case 4:
                // 文化財一覧
                $data = $this->getCulturalProperties($request);
                break;
            case 5:
                // 観光施設一覧
                $data = $this->getTouristFacilities($request);
                break;
            case 6:
                // イベント一覧
                $data = $this->getEvents($request);
                break;
            case 7:
                // 公衆無線LANアクセスポイント一覧
                $data = $this->getPublicWirelessLan($request);
                break;
            case 8:
                // 公衆トイレ一覧
                $data = $this->getPublicToilet($request);
                break;
            case 9:
                // 消防水利施設一覧
                $data = $this->getFireIrrigationFacilities($request);
                break;
            case 10:
                // 指定緊急避難場所一覧
                $data = $this->getDesignatedEmergencyEvacuationSite($request);
                break;
            case 11:
                // 地域・年齢別人口
                $data = $this->getAreaAgePopulation($request);
                break;
            case 12:
                // 公共施設一覧
                $data = $this->getPublicFacilities($request);
                break;
            case 13:
                // 子育て施設一覧
                $data = $this->getChildRearingFacilities($request);
                break;
            case 14:
                // オープンデータ一覧
                $data = $this->getOpenData($request);
                break;
        }

        // 取得したデータセット詳細情報データ
        return $data;
    }

    // AED設置箇所一覧情報取得
    public function getAed(Request $request)
    {
        // $data = DataSetAed::selectRaw($this->select)
        //                   ->having('distance', '<=', $this->distance)
        //                   ->get();
        $data = DataSetAed::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 介護サービス事業所一覧情報取得
    public function getCareService(Request $request)
    {
        // $data = DataSetCareService::selectRaw($this->select)
        //                           ->having('distance', '<=', $this->distance)
        //                           ->get();
        $data = DataSetCareService::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 医療機関一覧情報取得
    public function getMedicalInstitutions(Request $request)
    {
        // $data = DataSetMedicalInstitutions::selectRaw($this->select)
        //                                   ->having('distance', '<=', $this->distance)
        //                                   ->get();
        $data = DataSetMedicalInstitutions::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 文化財一覧情報取得
    public function getCulturalProperties(Request $request)
    {
        // $data = DataSetCulturalProperties::selectRaw($this->select)
        //                                   ->having('distance', '<=', $this->distance)
        //                                   ->get();
        $data = DataSetCulturalProperties::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 観光施設一覧情報取得
    public function getTouristFacilities(Request $request)
    {
        // $data = DataSetTouristFacilities::selectRaw($this->select)
        //                                 ->having('distance', '<=', $this->distance)
        //                                 ->get();
        $data = DataSetTouristFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // イベント一覧情報取得
    public function getEvents(Request $request)
    {
        // $data = DataSetEvents::selectRaw($this->select)
        //                       ->having('distance', '<=', $this->distance)
        //                       ->get();
        $data = DataSetEvents::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公衆無線LANアクセスポイント一覧情報取得
    public function getPublicWirelessLan(Request $request)
    {
        // $data = DataSetPublicWirelessLan::selectRaw($this->select)
        //                                 ->having('distance', '<=', $this->distance)
        //                                 ->get();
        $data = DataSetPublicWirelessLan::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公衆トイレ一覧情報取得
    public function getPublicToilet(Request $request)
    {
        // $data = DataSetPublicToilet::selectRaw($this->select)
        //                             ->having('distance', '<=', $this->distance)
        //                             ->get();
        $data = DataSetPublicToilet::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 消防水利施設一覧情報取得
    public function getFireIrrigationFacilities(Request $request)
    {
        // $data = DataSetFireIrrigationFacilities::selectRaw($this->select)
        //                                         ->having('distance', '<=', $this->distance)
        //                                         ->get();
        $data = DataSetFireIrrigationFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 指定緊急避難場所一覧情報取得
    public function getDesignatedEmergencyEvacuationSite(Request $request)
    {
        // $data = DataSetDesignatedEmergencyEvacuationSite::selectRaw($this->select)
        //                                                 ->having('distance', '<=', $this->distance)
        //                                                 ->get();
        $data = DataSetDesignatedEmergencyEvacuationSite::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 地域・年齢別人口情報取得
    public function getAreaAgePopulation(Request $request)
    {
        // $data = DatasetAreaAgePopulation::selectRaw($this->select)
        //                                 ->having('distance', '<=', $this->distance)
        //                                 ->get();
        $data = DatasetAreaAgePopulation::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公共施設一覧情報取得
    public function getPublicFacilities(Request $request)
    {
        // $data = DataSetPublicFacilities::selectRaw($this->select)
        //                                ->having('distance', '<=', $this->distance)
        //                                ->get();
        $data = DataSetPublicFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 子育て施設一覧情報取得
    public function getChildRearingFacilities(Request $request)
    {
        // $data = DatasetChildRearingFacilities::selectRaw($this->select)
        //                                      ->having('distance', '<=', $this->distance)
        //                                      ->get();
        $data = DatasetChildRearingFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // オープンデータ一覧情報取得
    public function getOpenData(Request $request)
    {
        // $data = DataSetDesignatedEmergencyEvacuationSite::selectRaw($this->select)
        //                                                 ->having('distance', '<=', $this->distance)
        //                                                 ->get();
        $data = DataSetOpenData::where('code', $this->municipalityCode)->get();
        return $data;
    }
}
