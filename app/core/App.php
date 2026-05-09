<?php

namespace SamPHP\Core;

/**
 * SamPHP Framework — Front Controller & URL Router
 *
 * Parses the URL and routes requests to the appropriate
 * controller, method, and parameters.
 *
 * URL pattern: /controller/method/param1/param2
 */

class App
{
    protected $controller = 'HomeController';
    protected $controllerInstance;
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (class_exists("App\\Controllers\\" . $controllerName)) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        $controllerClass = "App\\Controllers\\" . $this->controller;
        if (!class_exists($controllerClass)) {
            die('Controller not found: ' . htmlspecialchars($controllerClass));
        }
        $this->controllerInstance = new $controllerClass();

        if (isset($url[1])) {
            if (method_exists($this->controllerInstance, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controllerInstance, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}