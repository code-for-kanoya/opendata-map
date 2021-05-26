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
 * CSV列名定義
 */
final class DatasetCSVTitleName extends Enum
{
    /**
     * 推奨データセット収集結果
     */
    const DATASET_LIST = '推奨データセット収集結果';

    /**
     * AED設置箇所一覧
     */
    const AED = 'AED設置箇所一覧';

    /**
     * 介護サービス事業所一覧
     */
    const CARE_SERVICE = '介護サービス事業所一覧';

    /**
     * 医療機関一覧
     */
    const MEDICAL_INSTITUTIONS = '医療機関一覧';

    /**
     * 文化財一覧
     */
    const CULTURAL_PROPERTIES = '文化財一覧';

    /**
     * 観光施設一覧
     */
    const TOURIST_FACILITIES = '観光施設一覧';

    /**
     * イベント一覧
     */
    const EVENTS = 'イベント一覧';

    /**
     * 公衆無線LANアクセスポイント一覧
     */
    const PUBLIC_WIRELESS_LAN = '公衆無線LANアクセスポイント一覧';

    /**
     * 公衆トイレ一覧
     */
    const PUBLIC_TOILET = '公衆トイレ一覧';

    /**
     * 消防水利施設一覧
     */
    const FIRE_IRRIGATION_FACILITIES = '消防水利施設一覧';

    /**
     * 指定緊急避難場所一覧
     */
    const DESIGNATED_EMERGENCY_EVACUATION_SITE = '指定緊急避難場所一覧';

    /**
     * 地域・年齢別人口
     */
    const AREA_AGE_POPULATION = '地域・年齢別人口';

    /**
     * 公共施設一覧
     */
    const PUBLIC_FACILITIES = '公共施設一覧';

    /**
     * 子育て施設一覧
     */
    const CHILD_REARING_FACILITIES = '子育て施設一覧';

    /**
     * オープンデータ一覧
     */
    const OPEN_DATA = 'オープンデータ一覧';
}
