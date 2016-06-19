<?php

namespace App\Traits;


trait TEnums
{

    public static function db()
    {
        return array_keys(self::$values);
    }

    public static function human_value($value)
    {
        return self::$values[$value];
    }

    public static function human_values()
    {
        return self::$values;
    }

    public static function default_value()
    {
        return self::$default;
    }
}