<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetMedicalInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_medical_institutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('type')->nullable()->comment('医療機関の種類');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('extension_number')->nullable()->comment('内線番号');
            $table->string('fax_number')->nullable()->comment('FAX番号');
            $table->string('corporate_number')->nullable()->comment('法人番号');
            $table->string('corporate_name')->nullable()->comment('法人の名称');
            $table->string('medical_institution_code')->nullable()->comment('医療機関コード');
            $table->string('medical_treatment_day')->nullable()->comment('診療曜日');
            $table->string('start_time')->nullable()->comment('診療開始時間');
            $table->string('end_time')->nullable()->comment('診療終了時間');
            $table->string('medical_treatment_datetime_special_note')->nullable()->comment('診療日時特記事項');
            $table->string('overtime_support')->nullable()->comment('時間外における対応');
            $table->string('clinical_department')->nullable()->comment('診療科目');
            $table->string('bed_count')->nullable()->comment('病床数');
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
        Schema::dropIfExists('dataset_medical_institutions');
    }
}
