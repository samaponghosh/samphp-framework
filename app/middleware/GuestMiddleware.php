<?php

require_once "../app/core/Session.php";

class GuestMiddleware
{
    public static function handle()
    {
        Session::start();

        if (Session::has('user')) {
            header("Location: " . BASE_URL . "/dashboard/index");
            exit;
        }
    }
}