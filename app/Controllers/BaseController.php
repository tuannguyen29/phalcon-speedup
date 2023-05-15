<?php

declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller as PhalconController;

class BaseController extends PhalconController
{
    protected function initialize()
    {
        // Set prefix title.
        prepend_title(env('APP_NAME') . ' | ');

        // Set layout default.
        $this->view->setTemplateAfter('base');
    }
}