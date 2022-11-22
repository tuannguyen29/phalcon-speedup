<?php

namespace App\Library\Common;

use Phalcon\Di\Di;
use Phalcon\Di\FactoryDefault;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_PATH);
        $dotenv->load();

        return empty($_ENV[$key]) ? (empty($default) ? null : $default) : $_ENV[$key];
    }
}

function dump($data)
{
    $trace  = debug_backtrace();
    $caller = array_shift($trace);
    echo '<pre style="color: rgba(155, 220, 100, 1); background-color: #202020;padding: 10px;white-space: pre-wrap;">';
    echo 'called by [' . $caller['file'] . '] line: ' . $caller['line'] . "\n";
    var_dump($data);
}

function dd($data)
{
    $trace  = debug_backtrace();
    $caller = array_shift($trace);
    echo '<pre style="color: rgba(155, 220, 100, 1); background-color: #202020;padding: 10px;white-space: pre-wrap;">';
    echo 'called by [' . $caller['file'] . '] line: ' . $caller['line'] . "\n";
    var_dump($data);
    die();
}

if (! function_exists('print_message_exception')) {
    /**
     * @param object $e
     *
     * @return string
     */
    function print_message_exception($e)
    {
        print "<div style='text-align: center;'>";
        print "<h2 style='color: rgb(190, 50, 50);'>Exception Occured:</h2>";
        print "<table style='width: 800px; display: inline-block;padding:10px'>";
        print "<tr style='background-color:rgb(230,230,230);'><th style='width: 80px;'>Type</th><td>" . get_class($e) . "</td></tr>";
        print "<tr style='background-color:rgb(240,240,240);'><th>Message</th><td>{$e->getMessage()}</td></tr>";
        print "<tr style='background-color:rgb(230,230,230);'><th>File</th><td>{$e->getFile()}</td></tr>";
        print "<tr style='background-color:rgb(240,240,240);'><th>Line</th><td>{$e->getLine()}</td></tr>";
        print "<tr style='background-color:rgb(240,240,240);'><th>Stack Trace</th><td>{$e}</td></tr>";
        print "</table></div>";
        exit();
    }
}

function old($key, $default = null)
{
    return empty($_POST[$key]) ? (empty($default) ? '' : $default) : $_POST[$key];
}

function auth($key)
{
    $session = Di::getDefault()->getShared('session');

    return empty($session->get($key)) ? null : $session->get($key);
}