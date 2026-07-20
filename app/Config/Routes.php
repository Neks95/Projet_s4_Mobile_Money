<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::checkLogin');


$routes->group('client', ['filter' => 'role:client'], function($routes) {
    $routes->get('home','ClientController::getHome');
    $routes->post('depot','ClientController::processDepot');
});


