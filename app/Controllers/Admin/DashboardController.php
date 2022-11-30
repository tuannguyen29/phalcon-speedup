<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\MasterController;

class DashboardController extends MasterController
{
    public function initialize()
    {
        parent::initialize();
        set_title('Admin');
    }

    public function indexAction()
    {
        $this->view->pick('admin/dashboard/index');
    }
}
