<?php
require_once "autoload.php";
use Core\Router;
$uri =  $_SERVER["REQUEST_URI"];
$method =  $_SERVER["REQUEST_METHOD"];
$router = new Router();
$router->load('web.php');
$router->load('api.php');
$router->route($uri,$method);