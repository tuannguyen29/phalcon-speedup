<?php

namespace App\Controllers;

class ErrorsController extends BaseController
{
    public function show401Action()
    {
        set_title('401 Authorization');
    }

    public function show404Action()
    {
        set_title('404 Page Not Found');
    }

    public function show500Action()
    {
        set_title('500 Internal Server Error');
    }
}
