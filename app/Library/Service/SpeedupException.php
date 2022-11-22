<?php

namespace App\Library\Service;

use Phalcon\Di\Di;

/**
 *
 * @link
 */
class SpeedupException
{
    public static function setLog($msg)
    {
        $logger = Di::getDefault()->getShared('logger');
        $logger->error($msg);
    }
}