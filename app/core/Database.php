<?php

/**
 * SamPHP Framework — Database Connection
 *
 * Provides a static PDO connection to MySQL/MariaDB.
 * Uses constants defined in config/config.php.
 *
 * Usage:
 *   $pdo = Database::connect();
 *   $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
 */

class Database
{
    private static $instance = null;

    /**
     * Get a PDO database connection.
     * Uses singleton pattern to reuse connections.
     *
     * @return PDO
     */
    public static function connect()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
                    DB_USER,
                    DB_PASS
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                http_response_code(500);
                die('Database connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}