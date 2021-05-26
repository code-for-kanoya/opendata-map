<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatasetAreaAgePopulationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataset_area_age_population', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable()->comment('団体コード');
            $table->string('area_code')->nullable()->comment('地域コード');
            $table->string('prefecture_name')->nullable()->comment('都道府県名');
            $table->string('municipality_name')->nullable()->comment('市区町村名');
            $table->string('research_date')->nullable()->comment('調査年月日');
            $table->string('area_name')->nullable()->comment('地域名');
            $table->string('total_population')->nullable()->comment('総人口');
            $table->string('total_male')->nullable()->comment('男性');
            $table->string('total_female')->nullable()->comment('女性');
            $table->string('age_0_to_4_male')->nullable()->comment('0-4歳の男性');
            $table->string('age_0_to_4_female')->nullable()->comment('0-4歳の女性');
            $table->string('age_5_to_9_male')->nullable()->comment('5-9歳の男性');
            $table->string('age_5_to_9_female')->nullable()->comment('5-9歳の女性');
            $table->string('age_10_to_14_male')->nullable()->comment('10-14歳の男性');
            $table->string('age_10_to_14_female')->nullable()->comment('10-14歳の女性');
            $table->string('age_15_to_19_male')->nullable()->comment('15-19歳の男性');
            $table->string('age_15_to_19_female')->nullable()->comment('15-19歳の女性');
            $table->string('age_20_to_24_male')->nullable()->comment('20-24歳の男性');
            $table->string('age_20_to_24_female')->nullable()->comment('20-24歳の女性');
            $table->string('age_25_to_29_male')->nullable()->comment('25-29歳の男性');
            $table->string('age_25_to_29_female')->nullable()->comment('25-29歳の女性');
            $table->string('age_30_to_34_male')->nullable()->comment('30-34歳の男性');
            $table->string('age_30_to_34_female')->nullable()->comment('30-34歳の女性');
            $table->string('age_35_to_39_male')->nullable()->comment('35-39歳の男性');
            $table->string('age_35_to_39_female')->nullable()->comment('35-39歳の女性');
            $table->string('age_40_to_44_male')->nullable()->comment('40-44歳の男性');
            $table->string('age_40_to_44_female')->nullable()->comment('40-44歳の女性');
            $table->string('age_45_to_49_male')->nullable()->comment('45-49歳の男性');
            $table->string('age_45_to_49_female')->nullable()->comment('45-49歳の女性');
            $table->string('age_50_to_54_male')->nullable()->comment('50-54歳の男性');
            $table->string('age_50_to_54_female')->nullable()->comment('50-54歳の女性');
            $table->string('age_55_to_59_male')->nullable()->comment('55-59歳の男性');
            $table->string('age_55_to_59_female')->nullable()->comment('55-59歳の女性');
            $table->string('age_60_to_64_male')->nullable()->comment('60-64歳の男性');
            $table->string('age_60_to_64_female')->nullable()->comment('60-64歳の女性');
            $table->string('age_65_to_69_male')->nullable()->comment('65-69歳の男性');
            $table->string('age_65_to_69_female')->nullable()->comment('65-69歳の女性');
            $table->string('age_70_to_74_male')->nullable()->comment('70-74歳の男性');
            $table->string('age_70_to_74_female')->nullable()->comment('70-74歳の女性');
            $table->string('age_75_to_79_male')->nullable()->comment('75-79歳の男性');
            $table->string('age_75_to_79_female')->nullable()->comment('75-79歳の女性');
            $table->string('age_80_to_84_male')->nullable()->comment('80-84歳の男性');
            $table->string('age_80_to_84_female')->nullable()->comment('80-84歳の女性');
            $table->string('age_85_over_male')->nullable()->comment('85歳以上の男性');
            $table->string('age_85_over_female')->nullable()->comment('85歳以上の女性');
            $table->string('household_count')->nullable()->comment('世帯数');
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
        Schema::dropIfExists('dataset_area_age_population');
    }
}
