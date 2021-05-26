<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefectures', function (Blueprint $table) {
            $table->increments('id')->comment('都道府県ID');
            $table->integer('region_id')->unsigned()->comment('地方ID');
            $table->string('name')->comment('都道府県名');
            $table->double('latitude', 9, 6)->comment('緯度');
            $table->double('longitude', 9, 6)->comment('経度');
            $table->foreign('region_id')->references('id')->on('regions');  //外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefectures');
    }
}
