<?php

namespace App\Traits;

trait AuthenticatesUsers
{
    protected $redirecTo = '/';

    public function hasLogin()
    {
        if (auth('hasLogin')) {
            $this->response->redirect($this->redirecTo);
        }
    }

    public function setLogin($params)
    {
        foreach ($params as $key => $value) {
            $this->session->set($key, $value);
        }
    }

    public function logout()
    {
        if (empty(auth('hasLogin'))) {
            $this->response->redirect($this->redirecTo);
        }

        $this->session->destroy();
        $this->response->redirect($this->redirecTo);
    }
}
