<?php  

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/dashboard', 'Home::dashboard');  

$routes->get('/login', 'Auth::login');
$routes->get('/auth/dologin', 'Auth::login'); 
$routes->post('/auth/dologin', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');

// Grup route warga 
$routes->group('warga', ['filter' => 'auth'], function(RouteCollection $routes) {
    $routes->get('', 'Warga::index');
    $routes->match(['get', 'post'], 'create', 'Warga::create');
    $routes->post('store', 'Warga::store');
    $routes->match(['get', 'post'], 'edit/(:num)', 'Warga::edit/$1');
    $routes->post('update/(:num)', 'Warga::update/$1');
    $routes->get('delete/(:num)', 'Warga::delete/$1');
});

// Grup route iuran 
$routes->group('iuran', ['filter' => 'auth'], function(RouteCollection $routes) {
    $routes->get('', 'Iuran::index');
    $routes->match(['get', 'post'], 'create', 'Iuran::create');
    $routes->post('store', 'Iuran::store'); 

    // Tambahan route edit dan update untuk iuran
    $routes->match(['get', 'post'], 'edit/(:num)', 'Iuran::edit/$1');
    $routes->post('update/(:num)', 'Iuran::update/$1');

    $routes->get('delete/(:num)', 'Iuran::delete/$1');
});

// Grup route laporan 
$routes->group('laporan', ['filter' => 'auth'], function(RouteCollection $routes) {
    $routes->get('', 'Laporan::index');
    $routes->get('pdf', 'Laporan::pdf');
});

// Grup route permohonan kas
$routes->group('permohonan_kas', ['filter' => 'auth'], function(RouteCollection $routes) {
    $routes->get('', 'PermohonanKas::index');
    $routes->match(['get', 'post'], 'create', 'PermohonanKas::create');
    $routes->post('store', 'PermohonanKas::store');
    $routes->match(['get', 'post'], 'edit/(:num)', 'PermohonanKas::edit/$1');
    $routes->post('update/(:num)', 'PermohonanKas::update/$1');
    $routes->get('delete/(:num)', 'PermohonanKas::delete/$1');
});
