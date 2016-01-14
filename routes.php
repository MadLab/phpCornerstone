<?php

use League\Route\RouteCollection;

$router = new RouteCollection();
$router->get('/', 'MadLab\Controller\IndexController::getIndex');
$router->get('/test/{id}', 'MadLab\Controller\IndexController::getIndex');
$dispatcher = $router->getDispatcher();

$cornerstone->setDispatcher($dispatcher);