<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id')->comment('自治体ID');
            $table->integer('prefecture_id')->unsigned()->comment('都道府県ID');
            $table->string('name')->comment('自治体名');
            $table->string('code')->comment('団体コード');
            $table->double('latitude', 9, 6)->comment('緯度');
            $table->double('longitude', 9, 6)->comment('経度');
            $table->foreign('prefecture_id')->references('id')->on('prefectures');  //外部キー制約
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipalities');
    }
}
