<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetCareServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_care_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('介護サービス事業所名称');
            $table->string('name_kana')->nullable()->comment('介護サービス事業所名称_カナ');
            $table->string('implementation_service')->nullable()->comment('実施サービス');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('extension_number')->nullable()->comment('内線番号');
            $table->string('fax_number')->nullable()->comment('FAX番号');
            $table->string('corporate_number')->nullable()->comment('法人番号');
            $table->string('corporate_name')->nullable()->comment('法人の名称');
            $table->string('office_number')->nullable()->comment('事業所番号');
            $table->string('available_day')->nullable()->comment('利用可能曜日');
            $table->string('available_day_week_special_note')->nullable()->comment('利用可能曜日特記事項');
            $table->string('capacity')->nullable()->comment('定員');
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
        Schema::dropIfExists('dataset_care_service');
    }
}
