<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication Routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('processLogin', 'Auth::processLogin');
    $routes->get('logout', 'Auth::logout');
});


// Dashboard Routes (Protected)
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
});

// Anggota Routes
$routes->get('anggota/create', 'Anggota::create');
$routes->post('anggota/store', 'Anggota::store');
$routes->get('anggota', 'Anggota::index');