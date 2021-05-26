<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetPublicToiletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_public_toilet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('name_english')->nullable()->comment('名称_英語');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->string('installation_position')->nullable()->comment('設置位置');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('male_toilet_total_count')->nullable()->comment('男性トイレ総数');
            $table->string('male_toilet_urinal_count')->nullable()->comment('男性トイレ数（小便器）');
            $table->string('male_toilet_japanese_count')->nullable()->comment('男性トイレ数（和式）');
            $table->string('male_toilet_western_count')->nullable()->comment('男性トイレ数（洋式）');
            $table->string('female_toilet_total_count')->nullable()->comment('女性トイレ総数');
            $table->string('female_toilet_japanese_count')->nullable()->comment('女性トイレ数（和式）');
            $table->string('female_toilet_western_count')->nullable()->comment('女性トイレ数（洋式）');
            $table->string('unisex_toilet_total_count')->nullable()->comment('男女共用トイレ総数');
            $table->string('unisex_toilet_japanese_count')->nullable()->comment('男女共用トイレ数（和式）');
            $table->string('unisex_toilet_western_count')->nullable()->comment('男女共用トイレ数（洋式）');
            $table->string('multifunctional_toilet_count')->nullable()->comment('多機能トイレ数');
            $table->string('existence_toilet_wheelchair')->nullable()->comment('車椅子使用者用トイレ有無');
            $table->string('existence_toilet_equipment_infant')->nullable()->comment('乳幼児用設備設置トイレ有無');
            $table->string('existence_toilet_ostomate')->nullable()->comment('オストメイト設置トイレ有無');
            $table->string('start_time')->nullable()->comment('利用開始時間');
            $table->string('end_time')->nullable()->comment('利用終了時間');
            $table->string('available_time_special_note')->nullable()->comment('利用可能時間特記事項');
            $table->string('image')->nullable()->comment('画像');
            $table->string('image_license')->nullable()->comment('画像_ライセンス');
            $table->string('note')->nullable()->comment('備考');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataset_public_toilet');
    }
}
