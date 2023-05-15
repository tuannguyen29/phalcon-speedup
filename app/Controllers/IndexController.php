<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController
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
