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
 * 医療機関一覧データCSV列名定義
 */
final class DatasetMedicalInstitutionsCSVTitleNumber extends Enum
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
     * 医療機関の種類
     */
    const TYPE = '医療機関の種類';

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
     * 医療機関コード
     */
    const MEDICAL_INSTITUTION_CODE = '医療機関コード';

    /**
     * 診療曜日
     */
    const MEDICAL_TREATMENT_DAY = '診療曜日';

    /**
     * 診療開始時間
     */
    const START_TIME = '診療開始時間';

    /**
     * 診療終了時間
     */
    const END_TIME = '診療終了時間';

    /**
     * 利用可能曜日
     */
    const AVAILABLE_DAY = '利用可能曜日';

    /**
     * 診療日時特記事項
     */
    const MEDICAL_TREATMENT_DATETIME_SPECIAL_NOTE = '診療日時特記事項';

    /**
     * 時間外における対応
     */
    const OVERTIME_SUPPORT = '時間外における対応';

    /**
     * 診療科目
     */
    const CLINICAL_DEPARTMENT = '診療科目';

    /**
     * 病床数
     */
    const BED_COUNT = '病床数';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
