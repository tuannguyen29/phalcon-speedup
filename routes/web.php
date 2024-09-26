<?php

$router = $di->getRouter();

$router->add(
    '/fb',
    [
        'namespace'  => 'App\Controllers',
        'controller' => 'index',
        'action'     => 'fb',
    ]
)->setName('fb');

// Define your routes here
$router->add(
    '/auth/login',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'login',
        'action'     => 'index',
    ]
)->setName('login');

$router->add(
    '/auth/register',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'register',
        'action'     => 'index',
    ]
)->setName('register');

$router->add(
    '/auth/logout',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'login',
        'action'     => 'logout',
    ]
);

$router->removeExtraSlashes(true);
$router->handle($_SERVER['REQUEST_URI']);
