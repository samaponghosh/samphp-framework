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

// =============================================
// Application Settings
// =============================================

define('APP_NAME', 'SamPHP Application');

// Base URL — Set this to your project's public directory URL (no trailing slash)
// Examples:
//   http://localhost/your-project-name/public
//   https://yourdomain.com
define('BASE_URL', 'http://localhost/your-project-name/public');

// Application root path (auto-detected, usually no change needed)
define('APPROOT', dirname(__DIR__) . '/app');

// =============================================
// Database Settings
// =============================================

// Base URL — Set this to your project's public directory URL (no trailing slash)
define('BASE_URL', 'http://localhost/your-project-name/public');

// Application root path (auto-detected, usually no change needed)
define('APPROOT', dirname(__DIR__) . '/app');

// Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'root');
define('DB_PASS', '');

// =============================================
// Environment Settings
// =============================================

// Timezone — See: https://www.php.net/manual/en/timezones.php
date_default_timezone_set('UTC');

// Error Reporting — Set to 0 and display_errors to 0 in production!
error_reporting(E_ALL);
ini_set('display_errors', 1);