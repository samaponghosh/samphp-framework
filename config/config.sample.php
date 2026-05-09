<?php

define('APP_NAME', 'SamPHP Framework');

define('BASE_URL', 'http://localhost/YOUR_PROJECT_NAME/public');
define('APPROOT', dirname(dirname(__FILE__)) . '/app');

define('DB_HOST', 'localhost');
define('DB_NAME', 'YOUR_DB_NAME');
define('DB_USER', 'root');
define('DB_PASS', '');

date_default_timezone_set('Asia/Kolkata');

error_reporting(E_ALL);
ini_set('display_errors', 1);