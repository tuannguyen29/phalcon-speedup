<?php

namespace App\Controllers\Auth;

use User;
use App\Forms\Auth\RegisterForm;
use App\Traits\AuthenticatesUsers;
use App\Controllers\ControllerBase;

class RegisterController extends ControllerBase
{
    use AuthenticatesUsers;

    public function indexAction()
    {
        $this->hasLogin();
        $this->showRegisterForm();
        set_title('Register');
    }

    public function showRegisterForm()
    {
        $form = new RegisterForm();
        $this->view->form = $form;

        if ($this->request->isPost()) {
            $this->validateLogin($form);
        }

        $this->view->pick('auth/register');
    }

    public function validateLogin($form)
    {
        if ($this->security->checkToken('csrf')) {
            // validation of post data against form definition
            if ($form->isValid($this->request->getPost()) != false) {

                $email = $form->getFilteredValue('email');
                $test = $this->checkExistUser($email);
                if ($test) {
                    return false;
                }

                $this->saveUser([
                    'first_name' => $form->getFilteredValue('first_name'),
                    'last_name'  => $form->getFilteredValue('last_name'),
                    'email'      => $email,
                    'password'   => $form->getFilteredValue('password'),
                ]);

                $this->setLogin($email);

                $this->flashSession->message('success_msg', 'successful');
                $this->response->redirect($this->redirecTo);

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

    protected function saveUser($params)
    {
        $user = new User();
        $user->first_name = $params['first_name'];
        $user->last_name  = $params['last_name'];
        $user->email      = $params['email'];
        $user->password   = $this->security->hash($params['password']);
        $user->save();
    }

    protected function findUser($email)
    {
        $user = User::findFirst(
            [
                'conditions' => 'email = :email:',
                'bind'       => [
                    'email' => $email,
                ],
            ]
        );

        if ($user) {
            return $user;
        }

        return false;
    }

    public function checkExistUser($email)
    {
        $user = $this->findUser($email);

        if (!empty($user)) {
            $this->flashSession->message('error_msg', "Opps! <br>{$email} is registered! Please choose another email!");

            return true;
        }

        return false;
    }
}
