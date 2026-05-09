<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Base Model
 *
 * All application models should extend this class.
 * Provides a shared PDO database connection via the Database class.
 *
 * Usage:
 *   class Product extends Model {
 *       public function getAll() {
 *           $stmt = $this->db->query("SELECT * FROM products");
 *           return $stmt->fetchAll();
 *       }
 *   }
 */

class Model
{
    /** @var PDO Database connection instance */
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
}