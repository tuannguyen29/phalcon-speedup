<?php

use Carbon\Carbon;
use Phalcon\Mvc\Model;

class BaseModel extends Model
{
    protected $created_at;

    public function initialize()
    {
        $this->created_at = Carbon::now();
    }
}