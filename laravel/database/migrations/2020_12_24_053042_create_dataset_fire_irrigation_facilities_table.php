<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetFireIrrigationFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_fire_irrigation_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('type')->nullable()->comment('種別');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('caliber')->nullable()->comment('口径');
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
        Schema::dropIfExists('dataset_fire_irrigation_facilities');
    }
}
