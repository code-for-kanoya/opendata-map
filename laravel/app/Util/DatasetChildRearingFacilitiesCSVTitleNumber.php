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
 * 子育て施設一覧データCSV列名定義
 */
final class DatasetChildRearingFacilitiesCSVTitleNumber extends Enum
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
     * 種別
     */
    const TYPE = '種別';

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
     * アクセス方法
     */
    const HOW_TO_ACCESS = 'アクセス方法';

    /**
     * 駐車場情報
     */
    const PARKING_INFOMATION = '駐車場情報';

    /**
     * 電話番号
     */
    const PHONE_NUMBER = '電話番号';

    /**
     * 内線番号
     */
    const EXTENSION_NUMBER = '内線番号';

    /**
     * FAX番号
     */
    const FAX_NUMBER = 'FAX番号';

    /**
     * 法人番号
     */
    const CORPORATE_NUMBER = '法人番号';

    /**
     * 団体名
     */
    const GROUP_NAME = '団体名';

    /**
     * 認可等年月日
     */
    const APPROVAL_DATE = '認可等年月日';

    /**
     * 収容定員
     */
    const CAPACITY = '収容定員';

    /**
     * 受入年齢
     */
    const ACCEPTANCE_AGE = '受入年齢';

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
     * 一時預かりの有無
     */
    const EXISTENCE_TEMPORARY_CUSTODY = '一時預かりの有無';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
