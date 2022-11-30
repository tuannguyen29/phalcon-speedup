<?php

$router = $di->getRouter();
$adminPrefix = env('ADMIN_DIR', '/admin');

$router->add(
    $adminPrefix,
    [
        'namespace'  => 'App\Controllers\Admin',
        'controller' => 'dashboard',
        'action'     => 'index',
    ]
);

$router->removeExtraSlashes(true);
$router->handle($_SERVER['REQUEST_URI']);
