<?php

namespace App\Controllers\Admin;

class DashboardController extends AdminMasterController
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
