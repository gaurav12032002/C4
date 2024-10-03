<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Users;
use App\Controllers\Books;

$routes->group('', ['filter' => 'authGuard'], function(RouteCollection $routes) {
    //Books route
    $routes->get('books', [Books::class, 'index']);
    $routes->get('books/new', [Books::class, 'new']); // Add this line
    $routes->post('books', [Books::class, 'create']);           // Add this line
    $routes->get('books/edit/(:any)','Books::edit/$1'); 
    $routes->post('books/update','Books::update'); 
    $routes->get('books/delete/(:any)','Books::delete/$1'); 
    $routes->get('books/(:segment)', [Books::class, 'show']);

    //users profile route
    $routes->get('users/edit','Users::edit'); 
    $routes->post('users/update','Users::update'); 
    $routes->get('users/edit_password','Users::edit_password'); 
    $routes->post('users/change_password','Users::change_password'); 
    $routes->get('users', [Users::class, 'profile']);


});


// Logged in profil user
$routes->group('', ['filter' => 'authFilter'], function(RouteCollection $routes) {
    //user login and signup route
    $routes->get('/', 'Users::index');
    $routes->post('login', [Users::class, 'login']); 
    $routes->post('signup', [Users::class, 'signup']);
    // $routes->post('users/update','Users::update'); 

});

$routes->get('logout', 'Users::logout');


// // Logged in dashboard
// $routes->group('', ['filter' => 'auth'], function(RouteCollection $routes) {
//     $routes->get('/', 'Users::index');
// });