<?php

namespace App\Http\Controllers;

use App\Models\Prefectures;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use illuminate\Http\Request;

class PrefecturesController extends Controller
{
    private $prefsdata;

    public function __construct(Request $request)
    {
        //九州地方の都道府県を取得し、Vueファイルで配列のように扱えるようにする
        $id = 8;
        $this->prefsdata = json_encode(Prefectures::with('region')->where('region_id', $id)->get(), JSON_UNESCAPED_UNICODE);
    }

    //都道府県選択マップ表示
    public function index()
    {
        return view('prefectures.index', ['prefsData' => $this->prefsdata]);
    }
}
