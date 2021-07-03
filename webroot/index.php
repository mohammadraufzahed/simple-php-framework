<?php

use JsPhpize\Nodes\Main;
use SimplePHPFramework\controllers\MainController;
use SimplePHPFramework\kernel\Router;

require __DIR__ . "/../vendor/autoload.php";


$router = new Router();

// You must declare the routers in this place
$router->get('/', [new MainController, "index"]);

$router->start();
