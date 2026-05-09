<?php

class Validator
{
    public static function required($value)
    {
        return !empty(trim($value));
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function min($value, $length)
    {
        return strlen($value) >= $length;
    }

    public static function max($value, $length)
    {
        return strlen($value) <= $length;
    }

    public static function numeric($value)
    {
        return is_numeric($value);
    }
}