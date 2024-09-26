<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Library\Service\Facebook;

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

    public function fbAction()
    {
        $accessToken = $this->request->getQuery('accessToken');

        $facebook = new Facebook([
            'app_id'       => '783772599918930',
            'app_secret'   => 'a9ab5d593d900f2faece4af47ad5e5cf',
            'redirect_url' => '',
            'default_graph_version' => 'v17.0'
        ]);

        $facebook->setAccessToken($accessToken);

        // default response type e.g. object, json, array
        $facebook->setResponseType('array');

        // getting facebook user information
        var_dump($facebook->getUser());
        die;
    }
}
