<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    '/auth/login',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'login',
        'action'     => 'index',
    ]
);

$router->add(
    '/auth/register',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'register',
        'action'     => 'index',
    ]
);

$router->add(
    '/auth/logout',
    [
        'namespace'  => 'App\Controllers\Auth',
        'controller' => 'login',
        'action'     => 'logout',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
