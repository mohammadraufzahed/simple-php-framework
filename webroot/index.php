<?php

use SimplePHPFramework\kernel\Router;
use \SimplePHPFramework\controllers\ProductControllers;

require __DIR__ . "/../vendor/autoload.php";


$router = new Router();

// You must declare the routers in this place

$router->start();
