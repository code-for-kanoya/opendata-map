<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetDesignatedEmergencyEvacuationSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_designated_emergency_evacuation_site', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('no')->nullable()->comment('NO');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('elevation')->nullable()->comment('標高');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('extension_number')->nullable()->comment('内線番号');
            $table->string('code')->nullable()->comment('団体コード');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('disaster_type_flood')->nullable()->comment('災害種別_洪水');
            $table->string('disaster_type_sediment')->nullable()->comment('災害種別_崖崩れ、土石流及び地滑り');
            $table->string('disaster_type_storm_surge')->nullable()->comment('災害種別_高潮');
            $table->string('disaster_type_earthquake')->nullable()->comment('災害種別_地震');
            $table->string('disaster_type_tsunami')->nullable()->comment('災害種別_津波');
            $table->string('disaster_type_fire')->nullable()->comment('災害種別_大規模な火事');
            $table->string('disaster_type_inland_water_flood')->nullable()->comment('災害種別_内水氾濫');
            $table->string('disaster_type_volcanic_phenomenon')->nullable()->comment('災害種別_火山現象');
            $table->string('duplicate_designated_shelter')->nullable()->comment('指定避難所との重複');
            $table->string('estimated_capacity')->nullable()->comment('想定収容人数');
            $table->string('target_resident_association')->nullable()->comment('対象となる町会・自治会');
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
        Schema::dropIfExists('dataset_designated_emergency_evacuation_site');
    }
}
