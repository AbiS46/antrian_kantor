<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Users::index');
// $routes->get('/cgi-sys/defaultwebpage.cgi', 'Users::index');
$routes->get('/users', 'Users::index');

$routes->post('/users/authenticate', 'Users::authenticate');
$routes->get('/logout', 'Users::logout');
$routes->get('users/create', 'Users::create');
$routes->post('users/store', 'Users::store');
$routes->get('users/edit', 'Users::edit');
// $routes->post('users/update/(:num)', 'Users::update/$1');
$routes->post('users/change_password', 'Users::change_password');

$routes->get('/beranda', 'Beranda::index');

$routes->get('/sablon', 'Sablon::index');
$routes->get('/sablon/create', 'Sablon::create');
$routes->post('/sablon/simpan', 'Sablon::simpan');
$routes->get('/sablon/edit/(:num)', 'Sablon::edit/$1');
$routes->post('/sablon/update/(:num)', 'Sablon::update/$1');
$routes->post('sablon/update_status/(:num)', 'Sablon::update_status/$1');
$routes->get('/sablon/delete/(:num)', 'Sablon::delete/$1');

$routes->get('/bordir', 'Bordir::index');
$routes->get('/bordir/create', 'Bordir::create');
$routes->post('/bordir/simpan', 'Bordir::simpan');
$routes->get('/bordir/edit/(:num)', 'Bordir::edit/$1');
$routes->post('/bordir/update/(:num)', 'Bordir::update/$1');
$routes->post('/bordir/update_status/(:num)', 'Bordir::update_status/$1');
$routes->get('/bordir/delete/(:num)', 'Bordir::delete/$1');

// Rute untuk PO
$routes->get('/po', 'Po::index');
$routes->get('/po/create', 'Po::create');
$routes->post('/po/simpan', 'Po::simpan');
$routes->get('/po/edit/(:num)', 'Po::edit/$1');
$routes->post('/po/update/(:num)', 'Po::update/$1');
$routes->post('/po/update_status/(:num)', 'Po::update_status/$1');
$routes->get('/po/delete/(:num)', 'Po::delete/$1');

// Rute untuk Penjahit
$routes->get('/penjahit', 'Penjahit::index');
$routes->get('/penjahit/create', 'Penjahit::create');
$routes->post('/penjahit/simpan', 'Penjahit::simpan');
$routes->get('/penjahit/edit/(:num)', 'Penjahit::edit/$1');
$routes->post('/penjahit/update/(:num)', 'Penjahit::update/$1');
$routes->post('/penjahit/update_status/(:num)', 'Penjahit::update_status/$1');
$routes->get('/penjahit/delete/(:num)', 'Penjahit::delete/$1');

// Rute untuk Packing
$routes->get('/packing', 'Packing::index');
$routes->get('/packing/create', 'Packing::create');
$routes->post('/packing/simpan', 'Packing::simpan');
$routes->get('/packing/edit/(:num)', 'Packing::edit/$1');
$routes->post('/packing/update/(:num)', 'Packing::update/$1');
$routes->post('/packing/update_status/(:num)', 'Packing::update_status/$1');
$routes->get('/packing/delete/(:num)', 'Packing::delete/$1');

// Rute untuk Kirim
$routes->get('/kirim', 'Kirim::index');
$routes->get('/kirim/create', 'Kirim::create');
$routes->post('/kirim/simpan', 'Kirim::simpan');
$routes->get('/kirim/edit/(:num)', 'Kirim::edit/$1');
$routes->post('/kirim/update/(:num)', 'Kirim::update/$1');
$routes->post('/kirim/update_status/(:num)', 'Kirim::update_status/$1');
$routes->get('/kirim/delete/(:num)', 'Kirim::delete/$1');

// Rute untuk Galat
$routes->get('/galat', 'Galat::index');
$routes->get('/galat/create', 'Galat::create');
$routes->post('/galat/simpan', 'Galat::simpan');
$routes->get('/galat/edit/(:num)', 'Galat::edit/$1');
$routes->post('/galat/update/(:num)', 'Galat::update/$1');
$routes->post('/galat/update_status/(:num)', 'Galat::update_status/$1');
$routes->get('/galat/delete/(:num)', 'Galat::delete/$1');


// Rute untuk Selesai
$routes->get('/selesai', 'Selesai::index');
$routes->get('/selesai/create', 'Selesai::create');
$routes->post('/selesai/simpan', 'Selesai::simpan');
$routes->get('/selesai/edit/(:num)', 'Selesai::edit/$1');
$routes->post('/selesai/update/(:num)', 'Selesai::update/$1');
$routes->post('/selesai/update_status/(:num)', 'Selesai::update_status/$1');
$routes->get('/selesai/delete/(:num)', 'Selesai::delete/$1');


$routes->get('/move/(:any)/(:any)/(:num)', 'DataController::move/$1/$2/$3');
$routes->post('/move/(:any)/(:any)/(:num)', 'DataController::move/$1/$2/$3');
