<?php

/**
 * SamPHP Framework — Application Entry Point
 *
 * This is the front controller. All HTTP requests are routed
 * through this file by the .htaccess rewrite rules.
 *
 * Point your web server's document root to this public/ directory.
 */


// Load configuration
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/constants.php';
require_once __DIR__ . '/../vendor/autoload.php';

use SamPHP\Core\App;
use SamPHP\Core\Session;
use SamPHP\Core\ErrorHandler;

// Register global error handler
ErrorHandler::register();

// Start session securely
Session::start();

// Boot the application
$app = new App();