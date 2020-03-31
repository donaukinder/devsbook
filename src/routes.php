<?php

use core\Router;

$router = new Router;

$router->get('/', 'HomeController@index');

/* Login */
$router->get('/login', 'LoginController@signin');
$router->post('/login', 'LoginController@signinDo');

$router->get('/cadastro', 'LoginController@signup');
$router->post('/cadastro', 'LoginController@signupDo');