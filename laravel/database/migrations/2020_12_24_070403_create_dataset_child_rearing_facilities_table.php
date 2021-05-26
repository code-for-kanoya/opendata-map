<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetChildRearingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_child_rearing_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('名称');
            $table->string('name_kana')->nullable()->comment('名称_カナ');
            $table->string('type')->nullable()->comment('種別');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('how_to_access')->nullable()->comment('アクセス方法');
            $table->string('parking_infomation')->nullable()->comment('駐車場情報');
            $table->string('phone_number')->nullable()->comment('電話番号');
            $table->string('extension_number')->nullable()->comment('内線番号');
            $table->string('fax_number')->nullable()->comment('FAX番号');
            $table->string('corporate_number')->nullable()->comment('法人番号');
            $table->string('group_name')->nullable()->comment('団体名');
            $table->string('approval_date')->nullable()->comment('認可等年月日');
            $table->string('capacity')->nullable()->comment('収容定員');
            $table->string('acceptance_age')->nullable()->comment('受入年齢');
            $table->string('available_day')->nullable()->comment('利用可能曜日');
            $table->string('start_time')->nullable()->comment('開始時間');
            $table->string('end_time')->nullable()->comment('終了時間');
            $table->string('available_datetime_special_note')->nullable()->comment('利用可能日時特記事項');
            $table->string('existence_temporary_custody')->nullable()->comment('一時預かりの有無');
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
        Schema::dropIfExists('dataset_child_rearing_facilities');
    }
}
