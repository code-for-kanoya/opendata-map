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
 * オープンデータ一覧データCSV列名定義
 */
final class DatasetOpenDataCSVTitleNumber extends Enum
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
     * データ名称
     */
    const NAME = 'データ名称';

    /**
     * データ概要
     */
    const OVERVIEW = 'データ概要';

    /**
     * データ形式
     */
    const FORMAT = 'データ形式';

    /**
     * POIコード
     */
    const POI_CODE = 'POIコード';

    /**
     * 分類
     */
    const CLASSIFICATION = '分類';

    /**
     * 更新頻度
     */
    const UPDATE_FREQUENCY = '更新頻度';

    /**
     * URL
     */
    const URL = 'URL';

    /**
     * API対応有無
     */
    const EXISTENCE_API_SUPPORT = 'API対応有無';

    /**
     * ライセンス
     */
    const LICENSE = 'ライセンス';

    /**
     * 登録日
     */
    const REGIST_DATE = '登録日';

    /**
     * 最終更新日
     */
    const LAST_UPDATE_DATE = '最終更新日';

    /**
     * 備考
     */
    const NOTE = '備考';
}
