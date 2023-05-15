<?php

use Carbon\Carbon;

class User extends BaseModel
{
    protected $created_at;
    protected $updated_at;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('users');
    }

    public function beforeCreate()
    {
        // Set the creation date
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function beforeUpdate()
    {
        // Set the modification date
        $this->updated_at = Carbon::now();
    }
}