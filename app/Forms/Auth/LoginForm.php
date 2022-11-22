<?php

namespace App\Forms\Auth;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $this->add(
            new Hidden(
                'csrf'
            )
        );

        $email = new Text('email', [
            'placeholder' => 'example@domain.com',
            'class'       => 'form-control'
        ]);
        $email->setFilters(
            [
                'email',
                'string',
                'trim',
            ]
        );
        $email->addValidator(
            new Email(
                [
                    'message' => 'The email is format wrong <br>',
                ]
            )
        );
        $email->addValidator(
            new PresenceOf(
                [
                    'message' => 'The email is required <br>',
                ]
            )
        );
        $this->add($email);

        $password = new Password('password', [
            'placeholder'  => 'Enter your password',
            'class'        => 'form-control',
            'autocomplete' => 'on'
        ]);
        $password->setFilters(
            'trim'
        );
        $password->addValidator(
            new PresenceOf(
                [
                    'message' => 'The password is required <br>',
                ]
            )
        );
        $this->add($password);

        $submit = new Submit('submit', [
            'class' => 'btn btn-primary',
            'value' => 'Login',
        ]);
        $this->add($submit);
    }

    public function getCsrf()
    {
        return $this->security->getToken();
    }
}
