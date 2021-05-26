<?php

/**
 * ユーティリティ名前空間
 */
namespace Facades\App\Util;

/**
 * ファサード基本クラス
 */
use Illuminate\Support\Facades\Facade;

/**
 * カスタムユーティリティ
 */
class CustomUtility extends Facade
{
    /**
     * コンポーネントの登録名を取得する
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Util\CustomUtility';
    }
}
