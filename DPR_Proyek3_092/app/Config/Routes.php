<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'AuthController::index');
$routes->post('/login/process', 'AuthController::processLogin');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin-area', 'DashboardController::adminPage', ['filter' => 'admin']);