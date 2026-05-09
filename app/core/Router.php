<?php

/**
 * SamPHP Framework — Router (Extensible)
 *
 * A placeholder router for future custom route definitions.
 * Currently, routing is handled automatically by the App class
 * via URL convention: /controller/method/params
 *
 * You can extend this class to add named routes, route groups,
 * or regex-based route patterns as your project grows.
 *
 * Usage (future):
 *   Router::get('/products', 'ProductController@index');
 *   Router::post('/products/store', 'ProductController@store');
 */

class Router
{
    /** @var array Registered GET routes */
    protected static $getRoutes = [];

    /** @var array Registered POST routes */
    protected static $postRoutes = [];

    /**
     * Register a GET route.
     *
     * @param string $route URL pattern
     * @param string $action Controller@method
     */
    public static function get($route, $action)
    {
        self::$getRoutes[$route] = $action;
    }

    /**
     * Register a POST route.
     *
     * @param string $route URL pattern
     * @param string $action Controller@method
     */
    public static function post($route, $action)
    {
        self::$postRoutes[$route] = $action;
    }

    /**
     * Get all registered routes (for debugging).
     *
     * @return array
     */
    public static function getRoutes()
    {
        return [
            'GET' => self::$getRoutes,
            'POST' => self::$postRoutes,
        ];
    }
}