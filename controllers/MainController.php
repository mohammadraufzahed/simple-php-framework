<?php

namespace SimplePHPFramework\controllers;

use Exception;
use SimplePHPFramework\kernel\View;
use SimplePHPFramework\kernel\Database;

require __DIR__ . "/../vendor/autoload.php";


class MainController
{
    private View $viewEngine;
    private Database $db;
    public function __construct()
    {
        // Initialize the viewEngine
        $this->viewEngine = new View;
        try {
            $this->db = new Database();
        } catch (Exception $e) {
            throw new Exception("Faild to initilize the controller");
        }
    }
    public function index()
    {
        // Render the template
        return $this->viewEngine->render("index.pug", ["title" => "Simple PHP Framework"]);
    }
}
