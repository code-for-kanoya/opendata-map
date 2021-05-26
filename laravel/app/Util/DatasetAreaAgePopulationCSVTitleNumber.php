<?php

/**
 * ユーティリティ名前空間(ApplicationDataManagement)
 */
namespace App\Util;

/**
 * ENUM定義用仮想クラス
 */
use App\Util\Enum;

/**
 * 地域・年齢別人口データCSV列名定義
 */
final class DatasetAreaAgePopulationCSVTitleNumber extends Enum
{
    /**
     * 都道府県コード又は市区町村コード
     */
    const CODE = '都道府県コード又は市区町村コード';

    /**
     * 地域コード
     */
    const AREA_CODE = '地域コード';

    /**
     * 都道府県名
     */
    const PREFECTURE_NAME = '都道府県名';

    /**
     * 市区町村名
     */
    const MUNICIPALITY_NAME = '市区町村名';

    /**
     * 調査年月日
     */
    const RESEARCH_DATE = '調査年月日';

    /**
     * 地域名
     */
    const AREA_NAME = '地域名';

    /**
     * 総人口
     */
    const TOTAL_POPULATION = '総人口';

    /**
     * 男性
     */
    const TOTAL_MALE = '男性';

    /**
     * 女性
     */
    const TOTAL_FEMALE = '女性';

    /**
     * 0-4歳の男性
     */
    const AGE_0_TO_4_MALE = '0-4歳の男性';

    /**
     * 0-4歳の女性
     */
    const AGE_0_TO_4_FEMALE = '0-4歳の女性';

    /**
     * 5-9歳の男性
     */
    const AGE_5_TO_9_MALE = '5-9歳の男性';

    /**
     * 5-9歳の女性
     */
    const AGE_5_TO_9_FEMALE = '5-9歳の女性';

    /**
     * 10-14歳の男性
     */
    const AGE_10_TO_14_MALE = '10-14歳の男性';

    /**
     * 10-14歳の女性
     */
    const AGE_10_TO_14_FEMALE = '10-14歳の女性';

    /**
     * 15-19歳の男性
     */
    const AGE_15_TO_19_MALE = '15-19歳の男性';

    /**
     * 15-19歳の女性
     */
    const AGE_15_TO_19_FEMALE = '15-19歳の女性';

    /**
     * 20-24歳の男性
     */
    const AGE_20_TO_24_MALE = '20-24歳の男性';

    /**
     * 20-24歳の女性
     */
    const AGE_20_TO_24_FEMALE = '20-24歳の女性';

    /**
     * 25-29歳の男性
     */
    const AGE_25_TO_29_MALE = '25-29歳の男性';

    /**
     * 25-29歳の女性
     */
    const AGE_25_TO_29_FEMALE = '25-29歳の女性';

    /**
     * 30-34歳の男性
     */
    const AGE_30_TO_34_MALE = '30-34歳の男性';

    /**
     * 30-34歳の女性
     */
    const AGE_30_TO_34_FEMALE = '30-34歳の女性';

    /**
     * 35-39歳の男性
     */
    const AGE_35_TO_39_MALE = '35-39歳の男性';

    /**
     * 35-39歳の女性
     */
    const AGE_35_TO_39_FEMALE = '35-39歳の女性';

    /**
     * 40-44歳の男性
     */
    const AGE_40_TO_44_MALE = '40-44歳の男性';

    /**
     * 40-44歳の女性
     */
    const AGE_40_TO_44_FEMALE = '40-44歳の女性';

    /**
     * 45-49歳の男性
     */
    const AGE_45_TO_49_MALE = '45-49歳の男性';

    /**
     * 45-49歳の女性
     */
    const AGE_45_TO_49_FEMALE = '45-49歳の女性';

    /**
     * 50-54歳の男性
     */
    const AGE_50_TO_54_MALE = '50-54歳の男性';

    /**
     * 50-54歳の女性
     */
    const AGE_50_TO_54_FEMALE = '50-54歳の女性';

    /**
     * 55-59歳の男性
     */
    const AGE_55_TO_59_MALE = '55-59歳の男性';

    /**
     * 55-59歳の女性
     */
    const AGE_55_TO_59_FEMALE = '55-59歳の女性';

    /**
     * 60-64歳の男性
     */
    const AGE_60_TO_64_MALE = '60-64歳の男性';

    /**
     * 60-64歳の女性
     */
    const AGE_60_TO_64_FEMALE = '60-64歳の女性';

    /**
     * 65-69歳の男性
     */
    const AGE_65_TO_69_MALE = '65-69歳の男性';

    /**
     * 65-69歳の女性
     */
    const AGE_65_TO_69_FEMALE = '65-69歳の女性';

    /**
     * 70-74歳の男性
     */
    const AGE_70_TO_74_MALE = '70-74歳の男性';

    /**
     * 70-74歳の女性
     */
    const AGE_70_TO_74_FEMALE = '70-74歳の女性';

    /**
     * 75-79歳の男性
     */
    const AGE_75_TO_79_MALE = '75-79歳の男性';

    /**
     * 75-79歳の女性
     */
    const AGE_75_TO_79_FEMALE = '75-79歳の女性';

    /**
     * 80-84歳の男性
     */
    const AGE_80_TO_84_MALE = '80-84歳の男性';

    /**
     * 80-84歳の女性
     */
    const AGE_80_TO_84_FEMALE = '80-84歳の女性';

    /**
     * 85歳以上の男性
     */
    const AGE_85_OVER_MALE = '85歳以上の男性';

    /**
     * 85歳以上の女性
     */
    const AGE_85_OVER_FEMALE = '85歳以上の女性';

    /**
     * 世帯数
     */
    const HOUSEHOLD_COUNT = '世帯数';

    /**
     * 備考
     */
    const NOTE = '備考';
}
