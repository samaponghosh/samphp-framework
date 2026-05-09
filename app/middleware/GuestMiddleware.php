<?php

/**
 * SamPHP Framework — Guest Middleware
 *
 * Redirects authenticated users away from guest-only pages
 * (e.g., login, register).
 *
 * Usage in a controller:
 *   GuestMiddleware::handle();
 */

class GuestMiddleware
{
    public static function handle()
    {
        Session::start();

        if (Session::has('user')) {
            header('Location: ' . BASE_URL . '/dashboard/index');
            exit;
        }
    }
}