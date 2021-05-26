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
 * イベント一覧データCSV列名定義
 */
final class DatasetEventsCSVTitleNumber extends Enum
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
     * イベント名
     */
    const NAME = 'イベント名';

    /**
     * イベント名_カナ
     */
    const NAME_KANA = 'イベント名_カナ';

    /**
     * イベント名_英語
     */
    const NAME_ENGLISH = 'イベント名_英語';

    /**
     * 開始日
     */
    const START_DATE = '開始日';

    /**
     * 終了日
     */
    const END_DATE = '終了日';

    /**
     * 開始時間
     */
    const START_TIME = '開始時間';

    /**
     * 終了時間
     */
    const END_TIME = '終了時間';

    /**
     * 開始日時特記事項
     */
    const START_DATETIME_SPECIAL_NOTE = '開始日時特記事項';

    /**
     * 説明
     */
    const EXPLANATION = '説明';

    /**
     * 料金（基本）
     */
    const FEE_BASIC = '料金(基本)';

    /**
     * 料金（詳細）
     */
    const FEE_DETAIL = '料金(詳細)';

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
     * 主催者
     */
    const ORGANIZER = '主催者';

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
     * アクセス方法
     */
    const HOW_TO_ACCESS = 'アクセス方法';

    /**
     * 駐車場情報
     */
    const PARKING_INFOMATION = '駐車場情報';

    /**
     * 定員
     */
    const CAPACITY = '定員';

    /**
     * 参加申込終了日
     */
    const APPLY_PARTICIPATION_END_DATE = '参加申込終了日';

    /**
     * 参加申込終了時間
     */
    const APPLY_PARTICIPATION_END_TIME = '参加申込終了時間';

    /**
     * 参加申込方法
     */
    const HOW_TO_APPLY_PARTICIPATION = '参加申込方法';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * 備考
     */
    const NOTE = '備考';
}
