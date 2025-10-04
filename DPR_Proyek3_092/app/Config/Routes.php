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

$routes->get('/anggota', 'AnggotaController::index', ['filter' => 'login']);

$routes->group('anggota', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'AnggotaController::index');
    $routes->get('create', 'AnggotaController::create'); // Menampilkan form
    $routes->post('store', 'AnggotaController::store'); // Menyimpan data
    $routes->get('edit/(:num)', 'AnggotaController::edit/$1');
    $routes->post('update/(:num)', 'AnggotaController::update/$1');
    $routes->get('delete/(:num)', 'AnggotaController::delete/$1');
});

// Routes untuk Komponen Gaji (hanya admin)
$routes->group('komponen-gaji', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', 'KomponenGajiController::index');
    $routes->get('create', 'KomponenGajiController::create');
    $routes->post('store', 'KomponenGajiController::store');
});