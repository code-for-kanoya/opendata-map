<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetCulturalPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_cultural_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('name_common')->nullable()->comment('名称_通称');
            $table->string('name_english')->nullable()->comment('名称_英語');
            $table->string('classification')->nullable()->comment('文化財分類');
            $table->string('type')->nullable()->comment('種類');
            $table->string('place_name')->nullable()->comment('場所名称');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('extension_number')->nullable()->comment('内線番号');
            $table->string('member_number')->nullable()->comment('員数（数）');
            $table->string('member_unit')->nullable()->comment('員数（単位）');
            $table->string('corporate_number')->nullable()->comment('法人番号');
            $table->string('owner')->nullable()->comment('所有者等');
            $table->string('designated_date')->nullable()->comment('文化財指定日');
            $table->string('available_day')->nullable()->comment('利用可能曜日');
            $table->string('start_time')->nullable()->comment('開始時間');
            $table->string('end_time')->nullable()->comment('終了時間');
            $table->string('available_datetime_special_note')->nullable()->comment('利用可能日時特記事項');
            $table->string('image')->nullable()->comment('画像');
            $table->string('image_license')->nullable()->comment('画像_ライセンス');
            $table->string('overview')->nullable()->comment('概要');
            $table->string('overview_english')->nullable()->comment('概要_英語');
            $table->string('explanation', 4096)->nullable()->comment('説明');
            $table->string('explanation_english')->nullable()->comment('説明_英語');
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
        Schema::dropIfExists('dataset_cultural_properties');
    }
}
