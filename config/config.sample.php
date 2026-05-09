<?php

/**
 * SamPHP Framework — Application Configuration
 *
 * Copy this file to config.php and update the values below.
 * NEVER commit config.php to version control.
 *
 * Usage: composer create-project samphp/framework your-project-name
 *        This file is auto-copied to config.php on installation.
 */

// Application
define('APP_NAME', 'SamPHP Application');

// Base URL — Set this to your project's public directory URL (no trailing slash)
define('BASE_URL', 'http://localhost/your-project-name/public');

// Application root path (auto-detected, usually no change needed)
define('APPROOT', dirname(__DIR__) . '/app');

// Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'root');
define('DB_PASS', '');

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Error Reporting — Set to 0 in production
error_reporting(E_ALL);
ini_set('display_errors', 1);