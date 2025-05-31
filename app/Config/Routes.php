<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// AUTH
$routes->get('/auth', 'Auth::index');                 // Form login/register
$routes->get('/login', 'Auth::index');                // Redirect agar kompatibel
$routes->post('/login', 'Auth::loginPost');           // Proses login
$routes->post('/register', 'Auth::registerPost');     // Proses register
$routes->get('/logout', 'Auth::logout');              // Logout
$routes->post('/logout', 'Auth::logout');


// HOMEPAGE
$routes->get('/', 'Index::index');                      // Halaman utama

// PRODUK
$routes->get('/produk', 'Product::index');
$routes->get('/produk/create', 'Product::create');
$routes->post('/produk/store', 'Product::store');
$routes->get('/produk/edit/(:num)', 'Product::edit/$1');
$routes->post('/produk/update/(:num)', 'Product::update/$1');
$routes->post('/produk/delete/(:num)', 'Product::delete/$1');

// SELLER DASHBOARD
$routes->get('/seller/dashboard', 'SellerController::dashboard');
