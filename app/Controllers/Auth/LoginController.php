<?php

namespace App\Controllers\Auth;

use User;
use App\Forms\Auth\LoginForm;
use App\Traits\AuthenticatesUsers;
use App\Controllers\BaseController;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    public function indexAction()
    {
        $this->hasLogin();
        $this->showLoginForm();
        set_title('Login');
    }

    public function showLoginForm()
    {
        $form             = new LoginForm();
        $this->view->form = $form;

        if ($this->request->isPost()) {
            $this->validateLogin($form);
        }

        $this->view->pick('auth/login');
    }

    public function validateLogin($form)
    {
        if ($this->security->checkToken('csrf')) {
            // validation of post data against form definition
            if ($form->isValid($this->request->getPost()) != false) {
                $email    = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $this->checkLogin($email, $password);
                $this->setLogin($email);

                return;
            } else {
                // if validation fails write messages to flash service
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->message('error_msg', $message);
                }
            }
        } else {
            $this->flashSession->message('error_msg', '419 | Sorry, your session has expired. <br>Please refresh and try again.');
        }
    }

    protected function checkLogin($email, $password)
    {
        $user = $this->findUser($email);

        if (false !== $user) {
            $check = $this->security->checkHash($password, $user->password);

            if (true === $check) {
                $this->flashSession->message('success_msg', 'Login success!');
                $this->response->redirect('/');
            }
        } else {
            $this->flashSession->message('error_msg', 'Email or password is wrong! Please try again!');
        }
    }

    public function findUser($email)
    {
        $user = User::findFirst([
            'conditions' => 'email = :email:',
            'bind'       => [
                'email' => $email,
            ],
        ]);

        if ($user) {
            return $user;
        }

        return false;
    }

    public function logoutAction()
    {
        $this->logout();
    }
}
