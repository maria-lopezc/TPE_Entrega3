<?php
require_once './libs/Router.php';
require_once './app/controller/vuelo.controller.php';

$router=new Router();

//tabla de ruteo
$router->addRoute('vuelos', 'GET', 'VueloController', 'getAll');
$router->addRoute('vuelos', 'POST', 'VueloController', 'create');
$router->addRoute('vuelos', 'PUT', 'VueloController', 'update');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);