<?php

require_once "../app/core/Session.php";

class RoleMiddleware
{
    public static function handle($allowedRoles = [])
    {
        $user = Session::get('user');

        if (!$user) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }

        $roleName = self::getRoleName($user['role_id']);

        if (!in_array($roleName, $allowedRoles)) {

            if (
                isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
            ) {
                http_response_code(403);
                header('Content-Type: application/json');
                echo json_encode([
                    'status' => 'error',
                    'message' => 'You do not have permission to access this resource'
                ]);
                exit;
            }

            header("Location: " . BASE_URL . "/dashboard");
            exit;
        }
    }

    public static function getRoleName($roleId)
    {
        $roles = [
            1 => 'SuperAdmin',
            2 => 'CA',
            3 => 'Accountant'
        ];

        return $roles[$roleId] ?? null;
    }
}