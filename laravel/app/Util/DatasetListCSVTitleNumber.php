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
 * 推奨データセット収集結果データCSV列名定義
 */
final class DatasetListCSVTitleNumber extends Enum
{
    /**
     * 団体コード
     */
    const CODE = '団体コード';

    /**
     * サイトの有無
     */
    const EXISTSITE = 'サイト有無';

    /**
     * 01.AED設置箇所一覧
     */
    const DATASET01 = '01';

    /**
     * 02.介護サービス事業所一覧
     */
    const DATASET02 = '02';

    /**
     * 03.医療機関一覧
     */
    const DATASET03 = '03';

    /**
     * 04.文化財一覧
     */
    const DATASET04 = '04';

    /**
     * 05.観光施設一覧
     */
    const DATASET05 = '05';

    /**
     * 06.イベント一覧
     */
    const DATASET06 = '06';

    /**
     * 07.公衆無線LANアクセスポイント一覧
     */
    const DATASET07 = '07';

    /**
     * 08.公衆トイレ一覧
     */
    const DATASET08 = '08';

    /**
     * 09.消防水利施設一覧
     */
    const DATASET09 = '09';

    /**
     * 10.指定緊急避難場所一覧
     */
    const DATASET10 = '10';

    /**
     * 11.地域・年齢別人口
     */
    const DATASET11 = '11';

    /**
     * 12.公共施設一覧
     */
    const DATASET12 = '12';

    /**
     * 13.子育て施設一覧
     */
    const DATASET13 = '13';

    /**
     * 14.オープンデータ一覧
     */
    const DATASET14 = '14';
}
