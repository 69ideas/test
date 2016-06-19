<?php
/**
 * Created by PhpStorm.
 * User: kseni
 * Date: 04.02.2016
 * Time: 23:32
 */

namespace App\Traits;


trait TEnum
{
    public static function HumanValues($valuesNeeded = null)
    {
        if ($valuesNeeded === null) {
            $valuesNeeded = self::DB();
        }

        return array_only(self::$values, $valuesNeeded);
    }

    public static function DB()
    {
        return array_keys(self::$values);
    }

    public static function HumanValue($key)
    {
        return isset(self::$values[$key]) ? self::$values[$key] : '';
    }

}