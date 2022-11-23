<?php

namespace App\Traits;

use User;

trait AuthenticatesUsers
{
    protected $redirecTo = '/';

    public function hasLogin()
    {
        if (auth()) {
            $this->response->redirect($this->redirecTo);
        }
    }

    public function setLogin($email)
    {
        $user = User::findFirstByEmail($email);

        if (!$user) {
            return false;
        }

        $this->session->set('auth', $user);
    }

    public function logout()
    {
        if (empty(auth())) {
            $this->response->redirect($this->redirecTo);
        }

        $this->session->destroy();
        $this->response->redirect($this->redirecTo);
    }
}
