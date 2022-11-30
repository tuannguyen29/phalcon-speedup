<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use Phalcon\Mvc\Controller;

class MasterController extends Controller
{
    protected function initialize()
    {
        // Set prefix title.
        prepend_title(env('APP_NAME') . ' | ');

        // Set layout default.
        $this->view->setTemplateAfter('admin');
    }
}
