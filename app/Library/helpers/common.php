<?php

use Phalcon\Tag;
use Phalcon\Di\Di;

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
        return empty($_ENV[$key]) ? (empty($default) ? null : $default) : $_ENV[$key];
    }
}

function base_url()
{
    return protocol() . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
}

function protocol()
{
    $protocol = 'http';
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')) {
        $protocol .= 's';
    }

    return $protocol . '://';
}

/**
 * Overide function dump()
 *
 * @link https://symfony.com/doc/current/components/var_dumper.html
 * @param mixed $object
 * @return mixed
 */
function dump2($object)
{
    $trace  = debug_backtrace();
    $caller = array_shift($trace);
    echo '<pre>';
    echo '<span style="color: #FF8400; font-weight:bold">called by [' . $caller['file'] . '] line: ' . $caller['line'] . "</span>\n";
    dump($object);
}

function trace($object)
{
    dump2($object);
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

function auth()
{
    $session = Di::getDefault()->getShared('session');

    return empty($session->get('auth')) ? null : $session->get('auth');
}

function fullname()
{
    return !empty(auth()) ? auth()->first_name . ' ' . auth()->last_name : '';
}

function route($name)
{
    $url = Di::getDefault()->getShared('url');

    return $url->get(['for' => $name]);
}

function prepend_title($title)
{
    Tag::prependTitle($title);
}

/**
 * Function set title
 *
 * @param string $title
 * @return string
 * @link https://docs.phalcon.io/4.0/en/tag
 */
function set_title($title)
{
    Tag::setTitle($title);
}

function cache_asset($param = true)
{
    return true;
}