<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Users;
use App\Controllers\Books;
use App\Controllers\Api;

$routes->group('api',['filter' => 'apiAuth'], function($routes) {
    $routes->get('getBooks', [Api::class, 'getBooks']);
    $routes->get('viewBook/(:num)', [Api::class, 'viewBook']);
    $routes->post('createBook', [Api::class, 'createBook']);
    $routes->post('updateBook', [Api::class, 'updateBook']);
    $routes->get('deleteBook/(:num)',[Api::class,'deleteBook']); 
    $routes->post('userSignup', [Api::class, 'userSignup']);
    $routes->post('updateUser', [Api::class, 'updateUser']);
    $routes->post('changeUserPassword',[Api::class,'changeUserPassword']); 
    $routes->post('userLogin', [Api::class, 'userLogin']); 
});


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
    $routes->get('/forget_password', 'Users::forget_password');
    $routes->post('users/reset_password', [Users::class, 'reset_password']);

    // $routes->post('users/update','Users::update'); 

});

$routes->get('logout', 'Users::logout');

