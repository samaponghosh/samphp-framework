<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Error and Exception Handler
 *
 * Catches all uncaught exceptions and fatal errors.
 * Logs them to a file and presents a clean error page in production.
 */
class ErrorHandler
{
    /**
     * Register the error and exception handlers.
     */
    public static function register()
    {
        error_reporting(E_ALL);
        
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleFatalError']);
    }

    /**
     * Convert PHP errors to ErrorExceptions
     */
    public static function handleError($level, $message, $file = '', $line = 0)
    {
        if (error_reporting() & $level) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Handle uncaught exceptions
     */
    public static function handleException(\Throwable $exception)
    {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        $logMessage = "[" . date('Y-m-d H:i:s') . "] Uncaught Exception: '" . get_class($exception) . "'\n"
                    . "Message: '" . $exception->getMessage() . "'\n"
                    . "Stack trace: " . $exception->getTraceAsString() . "\n"
                    . "Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "\n";
        
        // Log the error
        error_log($logMessage, 3, LOG_PATH . 'error.log');

        // Check if we are in development mode
        $env = defined('ENVIRONMENT') ? ENVIRONMENT : 'production';
        
        if ($env === 'development') {
            echo "<h1>Fatal Error</h1>";
            echo "<p><b>Uncaught Exception:</b> '" . get_class($exception) . "'</p>";
            echo "<p><b>Message:</b> '" . $exception->getMessage() . "'</p>";
            echo "<p><b>Stack trace:</b><br><pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p><b>Thrown in:</b> '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            $errorFile = ROOTPATH . "/public/errors/{$code}.html";
            if (file_exists($errorFile)) {
                require_once $errorFile;
            } else {
                echo "<h1>" . ($code == 404 ? "404 Not Found" : "500 Internal Server Error") . "</h1>";
                echo "<p>An unexpected error occurred. Please try again later.</p>";
            }
        }
        exit;
    }

    /**
     * Handle fatal errors (like parse errors or out of memory)
     */
    public static function handleFatalError()
    {
        $error = error_get_last();
        if ($error !== null && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
            self::handleException(new \ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']));
        }
    }
}
