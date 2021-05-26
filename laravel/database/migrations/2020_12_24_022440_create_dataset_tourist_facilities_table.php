<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetTouristFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_tourist_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('name_english')->nullable()->comment('名称_英語');
            $table->string('poi_code')->nullable()->comment('POIコード');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('available_day')->nullable()->comment('利用可能曜日');
            $table->string('start_time')->nullable()->comment('開始時間');
            $table->string('end_time')->nullable()->comment('終了時間');
            $table->string('available_datetime_special_note')->nullable()->comment('利用可能日時特記事項');
            $table->string('fee_basic')->nullable()->comment('料金（基本）');
            $table->string('fee_detail')->nullable()->comment('料金（詳細）');
            $table->string('explanation', 4096)->nullable()->comment('説明');
            $table->string('explanation_english')->nullable()->comment('説明_英語');
            $table->string('how_to_access')->nullable()->comment('アクセス方法');
            $table->string('parking_infomation')->nullable()->comment('駐車場情報');
            $table->string('barrier_free_infomation')->nullable()->comment('バリアフリー情報');
            $table->string('contact_name')->nullable()->comment('連絡先名称');
            $table->string('contact_phone_number')->nullable()->comment('連絡先電話番号');
            $table->string('contact_extension_number')->nullable()->comment('連絡先内線番号');
            $table->string('image')->nullable()->comment('画像');
            $table->string('image_license')->nullable()->comment('画像_ライセンス');
            $table->string('url')->nullable()->comment('URL');
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
        Schema::dropIfExists('dataset_tourist_facilities');
    }
}
