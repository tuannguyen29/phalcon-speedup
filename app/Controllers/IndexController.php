<?php

namespace App\Controllers;

use App\Controllers\ControllerBase;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        set_title('Homepage');
    }

    public function indexAction()
    {
    }
}
