<?php
use Phalcon\Mvc\Model;

class User extends Model
{
    public function initialize()
    {
        $this->setSource('users');
    }
}