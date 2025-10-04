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

// Rute untuk MELIHAT daftar komponen gaji (butuh login, semua role boleh)
$routes->get('/komponen-gaji', 'KomponenGajiController::index', ['filter' => 'login']);

// Grup rute untuk MENGELOLA komponen gaji (hanya admin yang boleh)
$routes->group('komponen-gaji', ['filter' => 'admin'], static function ($routes) {
    $routes->get('create', 'KomponenGajiController::create');
    $routes->post('store', 'KomponenGajiController::store');
    $routes->get('edit/(:num)', 'KomponenGajiController::edit/$1');
    $routes->post('update/(:num)', 'KomponenGajiController::update/$1');
    // Rute update & delete akan kita letakkan di sini nanti
});