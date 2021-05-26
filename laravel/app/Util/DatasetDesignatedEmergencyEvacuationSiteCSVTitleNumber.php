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
 * 指定緊急避難場所一覧データCSV列名定義
 */
final class DatasetDesignatedEmergencyEvacuationSiteCSVTitleNumber extends Enum
{
    /**
     * NO
     */
    const NUMBER = 'NO';

    /**
     * 名称
     */
    const NAME = '名称';

    /**
     * 名称_カナ
     */
    const NAME_KANA = '名称_カナ';

    /**
     * 住所
     */
    const ADDRESS = '住所';

    /**
     * 方書
     */
    const ADDRESS_DETAIL = '方書';

    /**
     * 緯度
     */
    const LATITUDE = '緯度';

    /**
     * 経度
     */
    const LONGITUDE = '経度';

    /**
     * 標高
     */
    const ELEVATION = '標高';

    /**
     * 電話番号
     */
    const PHONE_NUMBER = '電話番号';

    /**
     * 内線番号
     */
    const EXTENSION_NUMBER = '内線番号';

    /**
     * 都道府県コード又は市区町村コード
     */
    const CODE = '市区町村コード';

    /**
     * 都道府県名
     */
    const PREFECTURE_NAME = '都道府県名';

    /**
     * 市区町村名
     */
    const MUNICIPALITY_NAME = '市区町村名';

    /**
     * 災害種別_洪水
     */
    const DISASTER_TYPE_FLOOD = '災害種別_洪水';

    /**
     * 災害種別_崖崩れ、土石流及び地滑り
     */
    const DISASTER_TYPE_SEDIMENT = '災害種別_崖崩れ、土石流及び地滑り';

    /**
     * 災害種別_高潮
     */
    const DISASTER_TYPE_STORM_SURGE = '災害種別_高潮';

    /**
     * 災害種別_地震
     */
    const DISASTER_TYPE_EARTHQUAKE = '災害種別_地震';

    /**
     * 災害種別_津波
     */
    const DISASTER_TYPE_TSUNAMI = '災害種別_津波';

    /**
     * 災害種別_大規模な火事
     */
    const DISASTER_TYPE_FIRE = '災害種別_大規模な火事';

    /**
     * 災害種別_内水氾濫
     */
    const DISASTER_TYPE_INLAND_WATER_FLOOD = '災害種別_内水氾濫';

    /**
     * 災害種別_火山現象
     */
    const DISASTER_TYPE_VOLCANIC_PHENOMENON = '災害種別_火山現象';

    /**
     * 指定避難所との重複
     */
    const DUPLICATE_DESIGNATED_SHELTER = '指定避難所との重複';

    /**
     * 想定収容人数
     */
    const ESTIMATED_CAPACITY = '想定収容人数';

    /**
     * 対象となる町会・自治会
     */
    const TARGET_RESIDENT_ASSOCIATION = '対象となる町会・自治会';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
