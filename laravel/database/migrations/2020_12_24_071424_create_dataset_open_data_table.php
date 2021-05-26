<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetOpenDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_open_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('データ名称');
            $table->string('overview')->nullable()->comment('データ概要');
            $table->string('format')->nullable()->comment('データ形式');
            $table->string('classification')->nullable()->comment('分類');
            $table->string('update_frequency')->nullable()->comment('更新頻度');
            $table->string('url')->nullable()->comment('URL');
            $table->string('existence_api_support')->nullable()->comment('API対応有無');
            $table->string('license')->nullable()->comment('ライセンス');
            $table->string('regist_date')->nullable()->comment('登録日');
            $table->string('last_update_date')->nullable()->comment('最終更新日');
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
        Schema::dropIfExists('dataset_open_data');
    }
}
