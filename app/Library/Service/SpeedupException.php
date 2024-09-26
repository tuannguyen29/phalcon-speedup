<?php

namespace App\Library\Service;

use Phalcon\Di\Di;

/**
 * PhalconLogger report error, message
 *
 * @link <https://docs.phalcon.io/5.0/en/logger>
 * @author Tuan Nguyen <tuan.ngminh29@gmail.com>
 */
class SpeedupException
{
    public static function setLog($msg)
    {
        $logger = Di::getDefault()->getShared('logger');
        $logger->error($msg);
    }
}