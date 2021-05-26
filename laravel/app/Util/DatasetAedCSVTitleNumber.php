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
 * AED設置箇所一覧データCSV列名定義
 */
final class DatasetAedCSVTitleNumber extends Enum
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
     * 設置位置
     */
    const INSTALLATION_POSITION = '設置位置';

    /**
     * 電話番号
     */
    const PHONE_NUMBER = '電話番号';

    /**
     * 内線番号
     */
    const EXTENSION_NUMBER = '内線番号';

    /**
     * 法人番号
     */
    const CORPORATE_NUMBER = '法人番号';

    /**
     * 団体名
     */
    const GROUP_NAME = '団体名';

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
     * 小児対応設備の有無
     */
    const EXISTENCE_EQUIPMENT_CHILDREN = '小児対応設備の有無';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
