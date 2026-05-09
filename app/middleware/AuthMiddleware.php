<?php

require_once "../app/core/Session.php";

class AuthMiddleware
{
    public static function handle()
    {
        if (!Session::has('user')) {
            if (
                isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
            ) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Unauthorized access',
                    'redirect' => BASE_URL . '/auth/login'
                ]);
                exit;
            }

            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }
    }
}