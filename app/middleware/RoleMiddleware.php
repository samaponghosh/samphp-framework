<?php

namespace App\Middleware;

use SamPHP\Core\Session;

/**
 * SamPHP Framework — Role Middleware
 *
 * Restricts access based on user roles.
 * Handles both regular HTTP and AJAX requests gracefully.
 *
 * Usage in a controller:
 *   RoleMiddleware::handle(['admin', 'editor']);
 *
 * Customize the $roles array in getRoleName() to match your
 * application's role IDs from the database.
 */

/**
 * RoleMiddleware — Restricts access based on user roles.
 *
 * Usage in a controller:
 *   RoleMiddleware::handle(['admin', 'editor']);
 *
 * Customize the $roles array in getRoleName() to match your application's
 * role IDs from the database.
 */
class RoleMiddleware
{
    /**
     * Check if the current user has one of the allowed roles.
     *
     * @param array $allowedRoles Array of role name strings
     */
    public static function handle($allowedRoles = [])
    {
        $user = Session::get('user');

        if (!$user) {
            header('Location: ' . BASE_URL . '/auth/login');
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

            header('Location: ' . BASE_URL . '/dashboard');
            exit;
        }
    }

    /**
     * Map role IDs to role names.
     * Customize this method to match your database role structure.
     *
     * @param int $roleId
     * @return string|null
     */
    public static function getRoleName($roleId)
    {
        $roles = [
            1 => 'admin',
            2 => 'editor',
            3 => 'user'
        ];

        return $roles[$roleId] ?? null;
    }
}