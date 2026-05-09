<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Security Utilities
 *
 * Provides static methods for common security operations:
 * CSRF protection, XSS sanitization, and password hashing.
 *
 * Usage:
 *   $token = Security::csrfToken();       // Generate/get CSRF token
 *   Security::verifyCsrf($token);         // Verify CSRF token
 *   $clean = Security::sanitize($input);  // Sanitize user input
 */

class Security
{
    /**
     * Sanitize a string to prevent XSS attacks.
     *
     * @param string $data Raw user input
     * @return string Sanitized string
     */
    public static function sanitize($data)
    {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get (or generate) a CSRF token for the current session.
     *
     * @return string The CSRF token
     */
    public static function csrfToken()
    {
        Session::start();

        if (!Session::has('csrf_token')) {
            Session::set('csrf_token', bin2hex(random_bytes(32)));
        }

        return Session::get('csrf_token');
    }

    /**
     * Verify a submitted CSRF token against the session token.
     *
     * @param string $token The token from the form submission
     * @return bool True if valid
     */
    public static function verifyCsrf($token)
    {
        Session::start();

        if (!Session::has('csrf_token') || empty($token)) {
            return false;
        }

        return hash_equals(Session::get('csrf_token'), $token);
    }

    /**
     * Hash a password using bcrypt.
     *
     * @param string $password Plain text password
     * @return string Hashed password
     */
    public static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Verify a password against a bcrypt hash.
     *
     * @param string $password Plain text password
     * @param string $hash The bcrypt hash
     * @return bool True if the password matches
     */
    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}