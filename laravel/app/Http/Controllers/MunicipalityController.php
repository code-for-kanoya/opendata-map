<?php

namespace App\Http\Controllers;

use App\Models\Municipalities;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use illuminate\Http\Request;
use illuminate\Support\Facades\DB;

class MunicipalityController extends Controller
{
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
}
