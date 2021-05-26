<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->comment('団体コード');
            $table->string('existsite')->comment('サイトの有無');
            $table->string('dataset01')->comment('01.AED設置箇所一覧');
            $table->string('dataset02')->comment('02.介護サービス事業所一覧');
            $table->string('dataset03')->comment('03.医療機関一覧');
            $table->string('dataset04')->comment('04.文化財一覧');
            $table->string('dataset05')->comment('05.観光施設一覧');
            $table->string('dataset06')->comment('06.イベント一覧');
            $table->string('dataset07')->comment('07.公衆無線LANアクセスポイント一覧');
            $table->string('dataset08')->comment('08.公衆トイレ一覧');
            $table->string('dataset09')->comment('09.消防水利施設一覧');
            $table->string('dataset10')->comment('10.指定緊急避難場所一覧');
            $table->string('dataset11')->comment('11.地域・年齢別人口');
            $table->string('dataset12')->comment('12.公共施設一覧');
            $table->string('dataset13')->comment('13.子育て施設一覧');
            $table->string('dataset14')->comment('14.オープンデータ一覧');
            $table->string('url')->comment('BODIKオープンデータカタログサイトURL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataset_list');
    }
}
