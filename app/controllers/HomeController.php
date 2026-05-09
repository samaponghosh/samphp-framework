<?php

namespace App\Controllers;

use SamPHP\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Welcome to SamPHP',
            'description' => 'Your framework is successfully installed and running!'
        ];

        $this->view('home/index', $data);
    }
}
