<?php

use Carbon\Carbon;
use Phalcon\Mvc\Model;

class BaseModel extends Model
{
    public function initialize()
    {
    }

    public function beforeValidationOnCreate()
    {
    }
}