<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::checkLogin');
$routes->get('/', 'AuthController::login');


$routes->group('client', ['filter' => 'role:client'], function($routes) {
    $routes->get('home','ClientController::getHome');
    $routes->post('depot','ClientController::processDepot');
    $routes->post('retrait','ClientController::processRetrait');
    $routes->post('transfert', 'ClientController::processTransfert');
    $routes->get('historique', 'ClientController::historique');

});

$routes->get('operateur/login', 'OperateurController::login');

$routes->group('operateur', ['filter' => 'role:operateur'], function ($routes) {
    $routes->get('/', 'OperateurController::index');
    $routes->get('/gain', 'OperateurController::gain');
    $routes->post('addPrefixe', 'OperateurController::createPrefixe');
});
