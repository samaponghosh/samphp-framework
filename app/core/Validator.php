<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Input Validator
 *
 * Provides static methods for common validation checks.
 *
 * Usage:
 *   if (!Validator::required($name)) { ... }
 *   if (!Validator::email($email))   { ... }
 *   if (!Validator::min($password, 8)) { ... }
 */

class Validator
{
    /**
     * Check that a value is not empty.
     *
     * @param string $value
     * @return bool
     */
    public static function required($value)
    {
        return !empty(trim($value));
    }

    /**
     * Validate an email address.
     *
     * @param string $value
     * @return bool
     */
    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Check minimum string length.
     *
     * @param string $value
     * @param int $length
     * @return bool
     */
    public static function min($value, $length)
    {
        return mb_strlen($value) >= $length;
    }

    /**
     * Check maximum string length.
     *
     * @param string $value
     * @param int $length
     * @return bool
     */
    public static function max($value, $length)
    {
        return mb_strlen($value) <= $length;
    }

    /**
     * Check if a value is numeric.
     *
     * @param mixed $value
     * @return bool
     */
    public static function numeric($value)
    {
        return is_numeric($value);
    }

    /**
     * Check if a value matches a regular expression.
     *
     * @param string $value
     * @param string $pattern
     * @return bool
     */
    public static function matches($value, $pattern)
    {
        return preg_match($pattern, $value) === 1;
    }

    /**
     * Check if a string is a valid URL.
     *
     * @param string $value
     * @return bool
     */
    public static function url($value)
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}