<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('no')->nullable()->comment('NO');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('name')->nullable()->comment('イベント名');
            $table->string('name_kana')->nullable()->comment('イベント名_カナ');
            $table->string('name_english')->nullable()->comment('イベント名_英語');
            $table->string('start_date')->nullable()->comment('開始日');
            $table->string('end_date')->nullable()->comment('終了日');
            $table->string('start_time')->nullable()->comment('開始時間');
            $table->string('end_time')->nullable()->comment('終了時間');
            $table->string('start_datetime_special_note')->nullable()->comment('開始日時特記事項');
            $table->string('explanation', 4096)->nullable()->comment('説明');
            $table->string('fee_basic')->nullable()->comment('料金（基本）');
            $table->string('fee_detail')->nullable()->comment('料金（詳細）');
            $table->string('contact_name')->nullable()->comment('連絡先名称');
            $table->string('contact_phone_number')->nullable()->comment('連絡先電話番号');
            $table->string('contact_extension_number')->nullable()->comment('連絡先内線番号');
            $table->string('organizer')->nullable()->comment('主催者');
            $table->string('place_name')->nullable()->comment('場所名称');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address_detail')->nullable()->comment('方書');
            $table->double('latitude', 9, 6)->nullable()->comment('緯度');
            $table->double('longitude', 9, 6)->nullable()->comment('経度');
            $table->string('how_to_access')->nullable()->comment('アクセス方法');
            $table->string('parking_infomation')->nullable()->comment('駐車場情報');
            $table->string('capacity')->nullable()->comment('定員');
            $table->string('apply_participation_end_date')->nullable()->comment('参加申込終了日');
            $table->string('apply_participation_end_time')->nullable()->comment('参加申込終了時間');
            $table->string('how_to_apply_participation')->nullable()->comment('参加申込方法');
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
        Schema::dropIfExists('dataset_events');
    }
}
