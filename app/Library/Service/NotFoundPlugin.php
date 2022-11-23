<?php

/**
 * This file is part of the Invo.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Library\Service;

use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFoundPlugin extends Injectable
{
    /**
     * This action is executed before perform any action in the application
     *
     * @param Event         $event
     * @param MvcDispatcher $dispatcher
     * @param Exception     $exception
     *
     * @return bool
     */
    public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception)
    {
        SpeedupException::setLog($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
                case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'controller' => 'error',
                        'action'     => 'show404',
                        'namespace'  => 'App\Controllers',
                    ]);

                    return false;
            }
        }

        if ($dispatcher->getControllerName() !== 'errors' && env('APP_ENV') === 'production') {
            $dispatcher->forward([
                'namespace'  => 'App\Controllers',
                'controller' => 'error',
                'action'     => 'show500',
            ]);

            return false;
        } else {
            print_message_exception($exception);
        }

        return !$event->isStopped();
    }
}
