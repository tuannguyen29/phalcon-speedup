<?php

declare(strict_types=1);

use Phalcon\Di\Di;
use Phalcon\Mvc\View;
use Phalcon\Session\Bag;
use Phalcon\Html\Escaper;
use Phalcon\Logger\Logger;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Logger\Adapter\Stream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Session\Manager as SessionManager;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Stream as SessionAdapter;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;

/**
 * Shared configuration service
 */
foreach (array_diff(scandir(CONFIG_PATH), ['.', '..']) as $value) {
    $configPath = CONFIG_PATH . '/' . $value;

    if (is_dir($configPath)) {
        $files = array_diff(scandir($configPath), ['.', '..']);

        if (is_array($files)) {
            foreach ($files as $filename) {
                $filepath = $configPath . '/' . $filename;

                if (!file_exists($filepath)) {
                    throw new Exception("The file $filepath does not exist");
                }

                $di->setShared(basename($filename, '.php'), function () use ($filepath) {
                    return include $filepath;
                });
            }
        }
    } else {
        if (!file_exists($configPath)) {
            throw new Exception("The file $configPath does not exist");
        }

        $di->setShared(basename($configPath, '.php'), function () use ($configPath) {
            return include $configPath;
        });
    }
}

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = Di::getDefault()->getShared('app');

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = Di::getDefault()->getShared('app');

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) use ($config) {
            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'path'      => $config->application->cacheDir,
                'separator' => '_'
            ]);

            return $volt;
        },
        '.phtml' => PhpEngine::class
    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = Di::getDefault()->getShared('database');

    $class  = 'Phalcon\Db\Adapter\Pdo\\' . $config->connections->adapter;
    $params = [
        'host'     => $config->connections->host,
        'port'     => $config->connections->port,
        'username' => $config->connections->username,
        'password' => $config->connections->password,
        'dbname'   => $config->connections->dbname,
        'charset'  => $config->connections->charset
    ];

    if ($config->connections->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    return new $class($params);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    $escaper = new Escaper();
    $flash   = new Flash($escaper);
    $flash->setImplicitFlush(false);
    $flash->setAutomaticHtml(false);
    $flash->setAutoescape(false);

    return $flash;
});

/**
 * Set up the flash session service
 */
$di->set(
    'flashSession',
    function () {
        $flashSession   = new FlashSession();
        $flashSession->setAutomaticHtml(false);
        $flashSession->setAutoescape(false);

        return $flashSession;
    }
);

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    session_name(strtolower(str_replace(' ', '_', env('APP_NAME', 'Phalcon'))) . '_session');

    // Set the max lifetime of a session with 'ini_set()' to one hour
    ini_set('session.gc_maxlifetime', env('SESSION_LIFETIME', 120));
    session_set_cookie_params((int) env('SESSION_LIFETIME', 120));

    switch (env('SESSION_DRIVER')) {
        case 'database':
            # code...
            break;

        default:
            $files = new SessionAdapter([
                'savePath' => STORAGE_PATH .  '/sessions',
            ]);

            $session = new SessionManager();
            $session->setAdapter($files);
            $session->start();

            break;
    }

    return $session;
});


$di->setShared('sessionBag', function () {
    $session = Di::getDefault()->getShared('session');

    return new Bag($session, 'bag');
});

$di->set(
    'logger',
    function () {
        $filename = 'phalcon';

        $formatter = new Line();
        $formatter->setFormat('[%date%] ' . env('APP_ENV') . '.%level%: %message%');
        $formatter->setDateFormat('Y-m-d H:i:s');

        switch (env('LOG_CHANNEL', 'single')) {
            case 'daily':
                $datetimeFormat = date('Y-m-d');
                $filepath       = STORAGE_PATH . "/logs/{$filename}-{$datetimeFormat}.log";

                break;
            default:
                $filepath = STORAGE_PATH . "/logs/{$filename}.log";

                break;
        }

        $adapter = new Stream($filepath);
        $adapter->setFormatter($formatter);

        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        return $logger;
    }
);
