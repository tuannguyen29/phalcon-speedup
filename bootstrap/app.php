<?php

use Phalcon\Di\Di;

$loader = new \Phalcon\Autoload\Loader();

$config = Di::getDefault()->getShared('app');

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->setDirectories(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
);

$loader->setNamespaces(
    [
        // 'App\Controllers'      => APP_PATH . '/controllers/',
        // 'App\Controllers\Auth' => APP_PATH . '/controllers/auth',
        // 'App\Forms\Auth'       => APP_PATH . '/forms/auth',
        // 'App\Library\Service'  => APP_PATH . '/library/service',
        // 'App\Traits'           => APP_PATH . '/traits/',
        // 'App\Providers'        => APP_PATH . '/providers/',
    ]
);

$loader->register();

/**
 * Handle the request
 */
$application = new \Phalcon\Mvc\Application($di);
