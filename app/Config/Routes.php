<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================
// AUTH
// ========================
$routes->get('/auth', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::loginPost');
$routes->post('/register', 'Auth::registerPost');
$routes->get('/logout', 'Auth::logout');
$routes->post('/logout', 'Auth::logout');

// ========================
// HOMEPAGE
// ========================
$routes->get('/', 'Index::index');
$routes->get('/search', 'Product::search');

// ========================
// ABOUT
// ========================
$routes->get('/about', 'Index::about');

// ========================
// CONTACT
// ========================
$routes->get('/contact', 'Index::contact');
$routes->post('/contact/send', 'Index::sendContact');

// ========================
// PRODUK - USER
// ========================
$routes->get('/product', 'Product::index'); // redirect ke /product/my
$routes->get('/product/my', 'Product::my');
$routes->get('/product/create', 'Product::create');
$routes->post('/product/store', 'Product::store');
$routes->get('/product/edit/(:num)', 'Product::edit/$1');
$routes->post('/product/update/(:num)', 'Product::update/$1');
$routes->post('/product/delete/(:num)', 'Product::delete/$1');
$routes->get('/user/create', 'Product::create');


// ========================
// PRODUK - KATALOG UMUM
// ========================
$routes->get('/katalog', 'Product::katalog');
$routes->get('/kategori/(:segment)', 'Product::kategori/$1');

// ========================
// ADMIN PANEL
// ========================
$routes->group('admin', ['filter' => 'adminOnly'], function ($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('users', 'Admin::users');
    $routes->get('products', 'Admin::products');
    $routes->get('orders', 'Admin::orders');
    $routes->post('orders/status/(:num)', 'Admin::updateStatus/$1');
    $routes->get('messages', 'Admin::messages');

    // Kategori manajemen
    $routes->get('categories', 'Category::index');
    $routes->post('add-category', 'Category::addCategory');
    $routes->post('delete-category/(:num)', 'Category::deleteCategory/$1');
});

// ========================
// CHECKOUT & PESANAN
// ========================

// Aksi checkout produk dari katalog
$routes->get('/keranjang/tambah/(:num)', 'Checkout::tambah/$1');
$routes->get('/checkout', 'Checkout::index'); // redirect ke home
$routes->get('/checkout/(:num)', 'Checkout::tambah/$1'); // alias langsung ke produk
$routes->post('/checkout/proses', 'Checkout::proses');

// Riwayat & detail pesanan user
$routes->get('/pesanan', 'Checkout::pesanan');                   // views/checkout/pesanan.php
$routes->get('/pesanan/detail/(:num)', 'Checkout::detail/$1');   // views/checkout/checkout_detail.php

// profile
$routes->get('/profile', 'Profile::index');

$routes->get('/penjualan', 'Profile::penjualan');
$routes->post('/profile/update', 'Profile::update');

