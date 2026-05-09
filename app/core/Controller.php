<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Base Controller
 *
 * All application controllers should extend this class.
 * Provides helper methods for loading views, models,
 * redirects, and JSON responses.
 */

class Controller
{
    /**
     * Load a model class.
     *
     * @param string $model The model class name (e.g., 'Product')
     * @return object New instance of the model
     */
    public function model($model)
    {
        $modelClass = "App\\Models\\" . $model;
        if (class_exists($modelClass)) {
            return new $modelClass();
        }
        die('Model not found: ' . htmlspecialchars($modelClass));
    }

    /**
     * Render a view file.
     *
     * @param string $view Path relative to views/ (e.g., 'home/index')
     * @param array $data Associative array of data passed to the view
     */
    public function view($view, $data = [])
    {
        extract($data);

        $file = APPROOT . '/views/' . $view . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            http_response_code(404);
            die('View not found: ' . htmlspecialchars($view));
        }
    }

    /**
     * Redirect to a URL relative to BASE_URL.
     *
     * @param string $url The path to redirect to (e.g., '/dashboard')
     */
    public function redirect($url)
    {
        header('Location: ' . BASE_URL . $url);
        exit;
    }

    /**
     * Send a JSON response and exit.
     *
     * @param array $data Data to encode as JSON
     * @param int $statusCode HTTP status code
     */
    public function json($data = [], $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}