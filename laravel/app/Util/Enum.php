<?php

/**
 * ユーティリティ名前空間
 */
namespace App\Util;

use Illuminate\Support\Arr;

use ReflectionClass;
use ReflectionObject;
use InvalidArgumentException;

/**
 * ENUM定義用仮想クラス
 */
abstract class Enum
{
    /**
     * ドメイン情報キャッシュ
     */
    public static $cachedDomain = [];

    /**
     * 定義値格納
     */
    private $scalar;

    public function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $consts = $ref->getConstants();
        if (! in_array($value, $consts, true)) {
            throw new InvalidArgumentException("Invalid Argument : {$value}");
        }

        $this->scalar = $value;
    }

    final public static function __callStatic($label, $args)
    {
        $class = get_called_class();
        $const = constant("$class::$label");
        return new $class($const);
    }

    /**
     * 定義域を列挙して返却する。
     */
    final public static function getEnumDomain()
    {
        $class = get_called_class();
        $domain = Arr::get(self::$cachedDomain, $class, null);
        if ($domain === null) {
            $ref = new ReflectionClass($class);
            $consts = $ref->getConstants();

            $domain = [];
            foreach ($consts as $index => $const) {
                $domain[] = new $class($const);
            }
            self::$cachedDomain[$class] = $domain;
        }

        return $domain;
    }

    /**
     * 元の値を取り出すメソッド
     *
     * @return Any
     */
    final public function valueOf()
    {
        return $this->scalar;
    }

    /**
     * 定義名を取り出すメソッド
     *
     * @return string
     */
    final public function __toString()
    {
        return (string)$this->scalar;
    }
}
