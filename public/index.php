<?php
declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use App\Library\Service\SpeedupException;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('LIBRARY_PATH', APP_PATH . '/Library');
define('ROUTE_PATH', BASE_PATH . '/routes');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');
define('BOOTSTRAP_PATH', BASE_PATH . '/bootstrap');

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

include BASE_PATH . '/vendor/autoload.php';

try {
    /**
     * Load ENV variables
     */
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);
    $dotenv->load();

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include BASE_PATH . '/bootstrap/services.php';

    /**
     * Register Service Providers
     */
    $providers = BOOTSTRAP_PATH . '/providers.php';
    if (!file_exists($providers) || !is_readable($providers)) {
        throw new Exception('File providers.php does not exist or is not readable.');
    }

    /** @var array $providers */
    $providers = include_once $providers;
    foreach ($providers as $provider) {
        $di->register(new $provider());
    }

    /**
     * Auto-loader helpers function.
     */
    $files = glob(LIBRARY_PATH . '/helpers/*.php');
    foreach ($files as $file) {
        require $file;
    }

    /**
     * Handle routes
     */
    $files = glob(ROUTE_PATH . '/*.php');
    foreach ($files as $file) {
        require $file;
    }

    /**
     * Include Autoloader
     */
    include BASE_PATH . '/bootstrap/app.php';

    echo $application->handle($_SERVER['REQUEST_URI'])->getContent();

} catch (Exception $e) {
    SpeedupException::setLog($e);

    if (env('APP_ENV') != 'production') {
        print_message_exception($e);
    }
}
