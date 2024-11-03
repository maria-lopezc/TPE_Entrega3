<?php
require_once './libs/Router.php';
require_once './app/controller/vuelo.controller.php';

$router=new Router();

//tabla de ruteo
$router->addRoute('vuelos', 'GET', 'VueloController', 'getVuelos');
$router->addRoute('vuelos/:ORDEN', 'GET', 'VueloController', 'getVuelosOrdenados');
$router->addRoute('vuelos', 'PUT', 'VueloController', 'AddVuelo');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);