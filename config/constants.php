<?php

/**
 * SamPHP Framework — Path Constants
 *
 * These constants define absolute paths to commonly used directories.
 * They are auto-resolved from the project root — no manual changes needed.
 */

// Project root directory (parent of config/)
define('ROOTPATH', dirname(__DIR__));

// File upload directory
define('UPLOAD_PATH', ROOTPATH . '/public/uploads/');

// Log files directory
define('LOG_PATH', ROOTPATH . '/storage/logs/');

// Cache directory
define('CACHE_PATH', ROOTPATH . '/storage/cache/');

// Mail attachments directory
define('MAIL_ATTACHMENT_PATH', ROOTPATH . '/storage/mail_attachments/');