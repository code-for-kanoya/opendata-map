<?php

/**
 * ユーティリティ名前空間
 */
namespace App\Util;

/**
 * 例外基底クラス
 */
use Exception;

/**
 * 更新通知処理用コールバックインターフェース
 */
interface ProgressCallbackInterface
{

    /**
     * 更新処理通知前処理
     *
     * @param $maxCount 処理件数全件。処理開始前に不明な場合は負の数値を返却する。
     */
    public function progressInit($maxCount);

    /**
     * 更新通知処理
     *
     * @param $count 現在処理が完了した件数
     */
    public function progressUpdate($count);

    /**
     * 更新完了通知
     */
    public function progressFinish();

    /**
     * エラー通知
     */
    public function progressError(Exception $e);
}
