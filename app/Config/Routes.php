<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Users;
use App\Controllers\Books;

$routes->group('', ['filter' => 'authGuard'], function(RouteCollection $routes) {
    $routes->get('books', [Books::class, 'index']);
    $routes->get('books/new', [Books::class, 'new']); // Add this line
    $routes->post('books', [Books::class, 'create']);           // Add this line
    $routes->get('books/edit/(:any)','Books::edit/$1'); 
    $routes->post('books/update','Books::update'); 
    $routes->get('books/delete/(:any)','Books::delete/$1'); 
    $routes->get('books/(:segment)', [Books::class, 'show']);

});


// Logged in profil user
$routes->group('', ['filter' => 'authFilter'], function(RouteCollection $routes) {
    $routes->get('/', 'Users::index');
    $routes->post('login', [Users::class, 'login']); 
    $routes->post('signup', [Users::class, 'signup']);
});

$routes->get('logout', 'Users::logout');


// // Logged in dashboard
// $routes->group('', ['filter' => 'auth'], function(RouteCollection $routes) {
//     $routes->get('/', 'Users::index');
// });