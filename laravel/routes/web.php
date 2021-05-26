<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// トップページ
Route::get('/', 'TopController@index')->name('top');

// マップ
Route::group(['prefix' => 'map'], function () {
    // 都道府県
    Route::get('/', 'MapController@index')->name('map');
    // 市区町村
    Route::post('/municipality', 'MapController@postMunicipality')->name('postMunicipality');
    // データセット
    Route::group(['prefix' => 'datasetlist'], function () {
        // 一覧情報
        Route::post('/', 'MapController@postDatasetList')->name('postDatasetList');
        // 詳細情報
        Route::post('/{name}', 'MapController@postDatasetDetail')->name('postDatasetDetail');
    });
});
