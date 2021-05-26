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
 * 公衆トイレ一覧データCSV列名定義
 */
final class DatasetPublicToiletCSVTitleNumber extends Enum
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
     * 住所
     */
    const ADDRESS = '住所';

    /**
     * 方書
     */
    const ADDRESS_DETAIL = '方書';

    /**
     * 設置位置
     */
    const INSTALLATION_POSITION = '設置位置';

    /**
     * 緯度
     */
    const LATITUDE = '緯度';

    /**
     * 経度
     */
    const LONGITUDE = '経度';

    /**
     * 男性トイレ総数
     */
    const MALE_TOILET_TOTAL_COUNT = '男性トイレ総数';

    /**
     * 男性トイレ数（小便器）
     */
    const MALE_TOILET_URINAL_COUNT = '男性トイレ数（小便器）';

    /**
     * 男性トイレ数（和式）
     */
    const MALE_TOILET_JAPANESE_COUNT = '男性トイレ数（和式）';

    /**
     * 男性トイレ数（洋式）
     */
    const MALE_TOILET_WESTERN_COUNT = '男性トイレ数（洋式）';

    /**
     * 女性トイレ総数
     */
    const FEMALE_TOILET_TOTAL_COUNT = '女性トイレ総数';

    /**
     * 女性トイレ数（和式）
     */
    const FEMALE_TOILET_JAPANESE_COUNT = '女性トイレ数（和式）';

    /**
     * 女性トイレ数（洋式）
     */
    const FEMALE_TOILET_WESTERN_COUNT = '女性トイレ数（洋式）';

    /**
     * 男女共用トイレ総数
     */
    const UNISEX_TOILET_TOTAL_COUNT = '男女共用トイレ総数';

    /**
     * 男女共用トイレ数（和式）
     */
    const UNISEX_TOILET_JAPANESE_COUNT = '男女共用トイレ数（和式）';

    /**
     * 男女共用トイレ数（洋式）
     */
    const UNISEX_TOILET_WESTERN_COUNT = '男女共用トイレ数（洋式）';

    /**
     * 多機能トイレ数
     */
    const MULTIFUNCTIONAL_TOILET_COUNT = '多機能トイレ数';

    /**
     * 車椅子使用者用トイレ有無
     */
    const EXISTENCE_TOILET_WHEELCHAIR = '車椅子使用者用トイレ有無';

    /**
     * 乳幼児用設備設置トイレ有無
     */
    const EXISTENCE_TOILET_EQUIPMENT_INFANT = '乳幼児用設備設置トイレ有無';

    /**
     * オストメイト設置トイレ有無
     */
    const EXISTENCE_TOILET_OSTOMATE = 'オストメイト設置トイレ有無';

    /**
     * 利用開始時間
     */
    const START_TIME = '利用開始時間';

    /**
     * 利用終了時間
     */
    const END_TIME = '利用終了時間';

    /**
     * 利用可能時間特記事項
     */
    const AVAILABLE_TIME_SPECIAL_NOTE = '利用可能時間特記事項';

    /**
     * 画像
     */
    const IMAGE = '画像';

    /**
     * 画像_ライセンス
     */
    const IMAGE_LICENSE = '画像_ライセンス';

    /**
     * 備考
     */
    const NOTE = '備考';
}
