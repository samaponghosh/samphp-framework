<?php

/**
 * SamPHP Framework — Application Entry Point
 *
 * This is the front controller. All HTTP requests are routed
 * through this file by the .htaccess rewrite rules.
 *
 * Point your web server's document root to this public/ directory.
 */

// Start session with secure defaults
session_start();

// Load configuration
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/constants.php';

// Load framework core
require_once __DIR__ . '/../app/core/Session.php';
require_once __DIR__ . '/../app/core/Security.php';
require_once __DIR__ . '/../app/core/Validator.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Mailer.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/App.php';

// Boot the application
$app = new App();