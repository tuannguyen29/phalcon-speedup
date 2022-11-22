<?php

return new \Phalcon\Config\Config([
    'connections' => [
        'adapter'     => env('DB_CONNECTION', 'Mysql'),
        'host'        => env('DB_HOST', 'localhost'),
        'port'        => env('DB_PORT', '3306'),
        'username'    => env('DB_USERNAME', 'forge'),
        'password'    => env('DB_PASSWORD', ''),
        'dbname'      => env('DB_DATABASE', 'forge'),
        'charset'     => 'utf8',
    ],
]);
