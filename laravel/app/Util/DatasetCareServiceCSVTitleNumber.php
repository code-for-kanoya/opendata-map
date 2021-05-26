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
 * 介護サービス事業所一覧データCSV列名定義
 */
final class DatasetCareServiceCSVTitleNumber extends Enum
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
     * 介護サービス事業所名称
     */
    const NAME = '介護サービス事業所名称';

    /**
     * 介護サービス事業所名称_カナ
     */
    const NAME_KANA = '介護サービス事業所名称_カナ';

    /**
     * 実施サービス
     */
    const IMPLEMENTATION_SERVICE = '実施サービス';

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
     * FAX番号
     */
    const FAX_NUMBER = 'FAX番号';

    /**
     * 法人番号
     */
    const CORPORATE_NUMBER = '法人番号';

    /**
     * 法人の名称
     */
    const CORPORATE_NAME = '法人の名称';

    /**
     * 事業所番号
     */
    const OFFICE_NUMBER = '事業所番号';

    /**
     * 利用可能曜日
     */
    const AVAILABLE_DAY = '利用可能曜日';

    /**
     * 利用可能曜日特記事項
     */
    const AVAILABLE_DAY_WEEK_SPECIAL_NOTE = '利用可能曜日特記事項';

    /**
     * 定員
     */
    const CAPACITY = '定員';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
