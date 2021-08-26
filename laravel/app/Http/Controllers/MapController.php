<?php

namespace App\Http\Controllers;

use App\Models\Prefectures;
use App\Models\Municipalities;
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

class MapController extends Controller
{
    private $prefsdata;
    private $municipalityCode = '';

    public function __construct(Request $request)
    {
        //九州地方の都道府県を取得し、Vueファイルで配列のように扱えるようにする
        $id = 8;
        $this->prefsdata = json_encode(Prefectures::with('region')->where('region_id', $id)->get(), JSON_UNESCAPED_UNICODE);
    }

    // マップ表示
    public function index($id = null, $code = null)
    {
        $params = [
            'prefsData' => $this->prefsdata,
            'id' => $id,
            'code' => $code,
        ];
        return view('map', $params);
    }

    // 都道府県データ取得
    public function getPrefecture(Request $request)
    {
        $id = 8;
        $prefectureData = json_encode(
            Prefectures::with('region')
                            ->where('region_id', $id)
                            ->get(),
            JSON_UNESCAPED_UNICODE
        );

        return $prefectureData;
    }

    // 自治体データ取得
    public function postMunicipality(Request $request)
    {
        // 都道府県IDをもとに、自治体情報データを取得する
        $prefId = $_POST['prefId'];
        $municipalitiesdata = Municipalities::with('prefecture')
                                ->where('prefecture_id', $prefId)
                                ->get();

        // 取得した自治体情報データ
        return $municipalitiesdata;
    }

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
        $this->municipalityCode = $_POST['municipalityCode'];

        $data = null;

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
        $data = DataSetAed::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 介護サービス事業所一覧情報取得
    public function getCareService(Request $request)
    {
        $data = DataSetCareService::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 医療機関一覧情報取得
    public function getMedicalInstitutions(Request $request)
    {
        $data = DataSetMedicalInstitutions::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 文化財一覧情報取得
    public function getCulturalProperties(Request $request)
    {
        $data = DataSetCulturalProperties::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 観光施設一覧情報取得
    public function getTouristFacilities(Request $request)
    {
        $data = DataSetTouristFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // イベント一覧情報取得
    public function getEvents(Request $request)
    {
        $data = DataSetEvents::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公衆無線LANアクセスポイント一覧情報取得
    public function getPublicWirelessLan(Request $request)
    {
        $data = DataSetPublicWirelessLan::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公衆トイレ一覧情報取得
    public function getPublicToilet(Request $request)
    {
        $data = DataSetPublicToilet::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 消防水利施設一覧情報取得
    public function getFireIrrigationFacilities(Request $request)
    {
        $data = DataSetFireIrrigationFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 指定緊急避難場所一覧情報取得
    public function getDesignatedEmergencyEvacuationSite(Request $request)
    {
        $data = DataSetDesignatedEmergencyEvacuationSite::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 地域・年齢別人口情報取得
    public function getAreaAgePopulation(Request $request)
    {
        $data = DatasetAreaAgePopulation::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 公共施設一覧情報取得
    public function getPublicFacilities(Request $request)
    {
        $data = DataSetPublicFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // 子育て施設一覧情報取得
    public function getChildRearingFacilities(Request $request)
    {
        $data = DatasetChildRearingFacilities::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // オープンデータ一覧情報取得
    public function getOpenData(Request $request)
    {
        $data = DataSetOpenData::where('code', $this->municipalityCode)->get();
        return $data;
    }

    // データセット一覧全情報取得
    public function postRanking(Request $request)
    {
        // データセット一覧情報より、全情報を取得する
        $data = DataSetList::all();

        $scores = $this->calcDatasetListScore($data);
        $result = $this->sortScore($scores);

        // 取得したデータセット
        return $result;
    }

    // データセット一覧情報スコア計算
    private function calcDatasetListScore($lists)
    {
        $i = 0;
        $scores = [];

        foreach ($lists as $list) {
            $score = 0;

            // 市区町村名
            $municipality = Municipalities::where('code', $list->code)->first();
            $municipalityName = $municipality->name;

            // 都道府県名
            $prefecture = Prefectures::where('id', $municipality->prefecture_id)->first();
            $prefectureName = $prefecture->name;

            // スコア計算
            // サイト有無
            if ($list->existsite === '〇' || $list->existsite === '○') {
                $score = $score + 6;
            }
            // AED設置箇所一覧
            if ($list->dataset01 === '〇' || $list->dataset01 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset01 === '異' || $list->dataset01 === '複' || $list->dataset01 === '不') {
                $score = $score + 3;
            }
            // 介護サービス事業所一覧
            if ($list->dataset02 === '〇' || $list->dataset02 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset02 === '異' || $list->dataset02 === '複' || $list->dataset02 === '不') {
                $score = $score + 3;
            }
            // 医療機関一覧
            if ($list->dataset03 === '〇' || $list->dataset03 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset03 === '異' || $list->dataset03 === '複' || $list->dataset03 === '不') {
                $score = $score + 3;
            }
            // 文化財一覧
            if ($list->dataset04 === '〇' || $list->dataset04 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset04 === '異' || $list->dataset04 === '複' || $list->dataset04 === '不') {
                $score = $score + 3;
            }
            // 観光施設一覧
            if ($list->dataset05 === '〇' || $list->dataset05 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset05 === '異' || $list->dataset05 === '複' || $list->dataset05 === '不') {
                $score = $score + 3;
            }
            // イベント一覧
            if ($list->dataset06 === '〇' || $list->dataset06 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset06 === '異' || $list->dataset06 === '複' || $list->dataset06 === '不') {
                $score = $score + 3;
            }
            // 公衆無線LANアクセスポイント一覧
            if ($list->dataset07 === '〇' || $list->dataset07 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset07 === '異' || $list->dataset07 === '複' || $list->dataset07 === '不') {
                $score = $score + 3;
            }
            // 公衆トイレ一覧
            if ($list->dataset08 === '〇' || $list->dataset08 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset08 === '異' || $list->dataset08 === '複' || $list->dataset08 === '不') {
                $score = $score + 3;
            }
            // 消防水利施設一覧
            if ($list->dataset09 === '〇' || $list->dataset09 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset09 === '異' || $list->dataset09 === '複' || $list->dataset09 === '不') {
                $score = $score + 3;
            }
            // 指定緊急避難場所一覧
            if ($list->dataset10 === '〇' || $list->dataset10 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset10 === '異' || $list->dataset10 === '複' || $list->dataset10 === '不') {
                $score = $score + 3;
            }
            // 地域・年齢別人口
            if ($list->dataset11 === '〇' || $list->dataset11 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset11 === '異' || $list->dataset11 === '複' || $list->dataset11 === '不') {
                $score = $score + 3;
            }
            // 公共施設一覧
            if ($list->dataset12 === '〇' || $list->dataset12 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset12 === '異' || $list->dataset12 === '複' || $list->dataset12 === '不') {
                $score = $score + 3;
            }
            // 子育て施設一覧
            if ($list->dataset13 === '〇' || $list->dataset13 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset13 === '異' || $list->dataset13 === '複' || $list->dataset13 === '不') {
                $score = $score + 3;
            }
            // オープンデータ一覧
            if ($list->dataset14 === '〇' || $list->dataset14 === '○') {
                $score = $score + 6;
            } elseif ($list->dataset14 === '異' || $list->dataset14 === '複' || $list->dataset14 === '不') {
                $score = $score + 3;
            }

            // ボーナス点加算
            switch (true) {
                case $score === 90:
                    $score = $score + 10;
                    break;
                case 50 <= $score:
                    $score = $score + 5;
                    break;
            }

            $scores[$i]['rank'] = 0;
            $scores[$i]['prefectureCode'] = $prefecture->id;
            $scores[$i]['prefectureName'] = $prefectureName;
            $scores[$i]['municipalityCode'] = $municipality->code;
            $scores[$i]['municipalityName'] = $municipalityName;
            $scores[$i]['score'] = $score;

            $i += 1;
        }

        return $scores;
    }

    // データセット一覧情報スコア並べ替え
    private function sortScore($scores)
    {
        $rank = 1;
        $count = 1;
        $beforeScore = -1;

        foreach ($scores as $index => $score) {
            $sort[$index] = $score['score'];
        }

        array_multisort($sort, SORT_DESC, $scores);

        foreach ($scores as $index => $score) {
            if ($beforeScore !== $score['score']) {
                $rank = $count;
            }

            $score['rank'] = $rank;
            $result[$index] = $score;

            $beforeScore = $score['score'];
            $count += 1;
        }

        return $result;
    }
}
