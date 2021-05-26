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
 * 文化財一覧データCSV列名定義
 */
final class DataSetCulturalPropertiesCSVTitleNumber extends Enum
{
    /**
     * 都道府県コード又は市区町村コード
     */
    const CODE = '都道府県コード又は市区町村コード';

    /**
     * NO
     */
    const NUMBER = 'NO';

    /**
     * 都道府県名
     */
    const PREFECTURE_NAME = '都道府県名';

    /**
     * 市区町村名
     */
    const MUNICIPALITY_NAME = '市区町村名';

    /**
     * 名称
     */
    const NAME = '名称';

    /**
     * 名称_カナ
     */
    const NAME_KANA = '名称_カナ';

    /**
     * 名称_通称
     */
    const NAME_COMMON = '名称_通称';

    /**
     * 名称_英語
     */
    const NAME_ENGLISH = '名称_英語';

    /**
     * 文化財分類
     */
    const CLASSIFICATION = '文化財分類';

    /**
     * 種類
     */
    const TYPE = '種類';

    /**
     * 場所名称
     */
    const PLACE_NAME = '場所名称';

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
     * 電話番号
     */
    const PHONE_NUMBER = '電話番号';

    /**
     * 内線番号
     */
    const EXTENSION_NUMBER = '内線番号';

    /**
     * 員数（数）
     */
    const MEMBER_NUMBER = '員数（数）';

    /**
     * 員数（単位）
     */
    const MEMBER_UNIT = '員数（単位）';

    /**
     * 法人番号
     */
    const CORPORATE_NUMBER = '法人番号';

    /**
     * 所有者等
     */
    const OWNER = '所有者等';

    /**
     * 文化財指定日
     */
    const DESIGNATED_DATE = '文化財指定日';

    /**
     * 利用可能曜日
     */
    const AVAILABLE_DAY = '利用可能曜日';

    /**
     * 開始時間
     */
    const START_TIME = '開始時間';

    /**
     * 終了時間
     */
    const END_TIME = '終了時間';

    /**
     * 利用可能日時特記事項
     */
    const AVAILABLE_DATETIME_SPECIAL_NOTE = '利用可能日時特記事項';

    /**
     * 画像
     */
    const IMAGE = '画像';

    /**
     * 画像_ライセンス
     */
    const IMAGE_LICENSE = '画像_ライセンス';

    /**
     * 概要
     */
    const OVERVIEW = '概要';

    /**
     * 概要_英語
     */
    const OVERVIEW_ENGLISH = '概要_英語';

    /**
     * 説明
     */
    const EXPLANATION = '説明';

    /**
     * 説明_英語
     */
    const EXPLANATION_ENGLISH = '説明_英語';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
