<?php

/**
 * SamPHP Framework — Session Management
 *
 * Provides static methods for session operations.
 *
 * Usage:
 *   Session::start();
 *   Session::set('user', $userData);
 *   $user = Session::get('user');
 *   Session::destroy();
 */

class Session
{
    /**
     * Start the session if not already started.
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session value.
     *
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Check if a session key exists.
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Destroy the entire session.
     */
    public static function destroy()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Regenerate the session ID (call after login for security).
     */
    public static function regenerate()
    {
        session_regenerate_id(true);
    }

    /**
     * Set a flash message (available only for the next request).
     *
     * @param string $key
     * @param string $message
     */
    public static function flash($key, $message)
    {
        $_SESSION['_flash'][$key] = $message;
    }

    /**
     * Get and remove a flash message.
     *
     * @param string $key
     * @return string|null
     */
    public static function getFlash($key)
    {
        $message = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $message;
    }
}