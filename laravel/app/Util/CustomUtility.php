<?php

/**
 * ユーティリティ名前空間
 */
namespace App\Util;

define('UTF32_BIG_ENDIAN_BOM', chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define('UTF16_BIG_ENDIAN_BOM', chr(0xFE) . chr(0xFF));
define('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define('UTF8_BOM', chr(0xEF) . chr(0xBB) . chr(0xBF));

/**
 * ユーティリティクラス
 */
class CustomUtility
{
    /**
     * エンコーディングを検出する際の順序を定義
     */
    const ENCODING_DETECT_ORDER = 'ASCII,JIS,UTF-8,CP51932,SJIS-win,SJIS';

    /**
     * 指定文字列に対するエンコーディングを検出する関数
     *
     * @param $detectTarget エンコーディングを検出したい対象文字列
     * @return 検出されたエンコーディングを返却
     */
    public function detectEncoding($detectTarget)
    {
        return mb_detect_encoding($detectTarget, self::ENCODING_DETECT_ORDER);
    }

    /**
     * 指定文字列に対するエンコーディングを検出する関数
     *
     * @param $filename エンコーディングを検出したい対象ファイル名
     * @return 検出されたエンコーディングを返却
     */
    public function detect_utf_encoding($filename)
    {
        $text = file_get_contents($filename);
        $first2 = substr($text, 0, 2);
        $first3 = substr($text, 0, 3);
        $first4 = substr($text, 0, 3);

        if ($first3 == UTF8_BOM) {
            return 'UTF-8';
        } elseif ($first4 == UTF32_BIG_ENDIAN_BOM) {
            return 'UTF-32BE';
        } elseif ($first4 == UTF32_LITTLE_ENDIAN_BOM) {
            return 'UTF-32LE';
        } elseif ($first2 == UTF16_BIG_ENDIAN_BOM) {
            return 'UTF-16BE';
        } elseif ($first2 == UTF16_LITTLE_ENDIAN_BOM) {
            return 'UTF-16LE';
        }
    }
}
