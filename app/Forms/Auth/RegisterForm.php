<?php

namespace App\Forms\Auth;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Filter\Validation\Validator\Email;
use Phalcon\Filter\Validation\Validator\PresenceOf;
use Phalcon\Filter\Validation\Validator\StringLength;

class RegisterForm extends Form
{
    public function initialize()
    {
        // CSRF
        $this->add(
            new Hidden(
                'csrf'
            )
        );

        // First name
        $firstName = new Text('first_name', [
            'placeholder' => 'Enter your first name',
            'class'       => 'form-control'
        ]);
        $firstName->setFilters([
            'trim',
            'striptags',
            'string',
            'alnum',
        ]);
        $this->add($firstName);

        // Last name
        $lastName = new Text('last_name', [
            'placeholder' => 'Enter your last name',
            'class'       => 'form-control'
        ]);
        $lastName->setFilters([
            'trim',
            'striptags',
            'string',
            'alnum',
        ]);
        $this->add($lastName);

        // Email
        $email = new Text('email', [
            'placeholder' => 'example@domain.com',
            'class'       => 'form-control'
        ]);
        $email->setFilters([
            'email',
            'string',
            'trim',
        ]);
        $email->addValidator(
            new Email([
                'message' => 'The email is format wrong <br>',
            ])
        );
        $email->addValidator(
            new PresenceOf([
                'message' => 'The email is required <br>',
            ])
        );
        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder'  => 'Enter your password',
            'class'        => 'form-control',
            'autocomplete' => 'on'
        ]);
        $password->setFilters(
            'trim',
        );
        $password->addValidator(
            new PresenceOf([
                'message' => 'The password is required <br>',
            ])
        );
        $password->addValidator(
            new StringLength([
                'min'            => 6,
                'messageMinimum' => 'The password is too short, at least 6 characters',
            ])
        );
        $this->add($password);

        // Button submit
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
