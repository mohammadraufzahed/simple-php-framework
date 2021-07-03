<?php

namespace SimplePHPFramework\controllers;

use SimplePHPFramework\kernel\View;

require __DIR__ . "/../vendor/autoload.php";


class MainController
{
    private View $viewEngine;
    public function __construct()
    {
        // Initialize the viewEngine
        $this->viewEngine = new View;
    }
    public function index()
    {
        // Render the template
        return $this->viewEngine->render("index.pug", ["title" => "Simple PHP Framework"]);
    }
}
