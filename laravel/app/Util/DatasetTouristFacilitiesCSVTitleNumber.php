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
 * 観光施設一覧データCSV列名定義
 */
final class DatasetTouristFacilitiesCSVTitleNumber extends Enum
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
     * 名称_英語
     */
    const NAME_ENGLISH = '名称_英語';

    /**
     * POIコード
     */
    const POI_CODE = 'POIコード';

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
     * 料金（基本）
     */
    const FEE_BASIC = '料金(基本)';

    /**
     * 料金（詳細）
     */
    const FEE_DETAIL = '料金(詳細)';

    /**
     * 説明
     */
    const EXPLANATION = '説明';

    /**
     * 説明_英語
     */
    const EXPLANATION_ENGLISH = '説明_英語';

    /**
     * アクセス方法
     */
    const HOW_TO_ACCESS = 'アクセス方法';

    /**
     * 駐車場情報
     */
    const PARKING_INFOMATION = '駐車場情報';

    /**
     * バリアフリー情報
     */
    const BARRIER_FREE_INFOMATION = 'バリアフリー情報';

    /**
     * 連絡先名称
     */
    const CONTACT_NAME = '連絡先名称';

    /**
     * 連絡先電話番号
     */
    const CONTACT_PHONE_NUMBER = '連絡先電話番号';

    /**
     * 連絡先内線番号
     */
    const CONTACT_EXTENSION_NUMBER = '連絡先内線番号';

    /**
     * 画像
     */
    const IMAGE = '画像';

    /**
     * 画像_ライセンス
     */
    const IMAGE_LICENSE = '画像_ライセンス';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
