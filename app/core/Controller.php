<?php

class Controller
{
    public function model($model)
    {
        require_once "../app/models/" . $model . ".php";
        return new $model();
    }

    public function view($view, $data = [])
    {
        extract($data);

        $file = "../app/views/" . $view . ".php";

        if (file_exists($file)) {
            require_once $file;
        } else {
            die("View not found: " . $view);
        }
    }

    public function redirect($url)
    {
        header("Location: " . BASE_URL . $url);
        exit;
    }

    public function json($data = [], $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}