<?php

use Dotenv\Dotenv;

Dotenv::createUnsafeImmutable(__DIR__)->load();

/*
 * Modified: prepend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */

return new \Phalcon\Config\Config([
    'database' => [
        'adapter'     => getenv('DB_CONNECTION', 'Mysql'),
        'host'        => getenv('DB_HOST', 'localhost'),
        'port'        => getenv('DB_PORT', '3306'),
        'username'    => getenv('DB_USERNAME', 'forge'),
        'password'    => getenv('DB_PASSWORD', ''),
        'dbname'      => getenv('DB_DATABASE', 'forge'),
        'charset'     => 'utf8',
    ],

    'application' => [
        /**
         * Migration settings.
         */
        'logInDb'              => true,
        'migrationsTsBased'    => false, # true - Use TIMESTAMP as version name (ex: 1668771552963256), false - use versions (ex: 1.0.0)
        'migrationsDir'        => 'databases/migrations/',
        'exportDataFromTables' => [
            'users',
        ],
    ]
]);
