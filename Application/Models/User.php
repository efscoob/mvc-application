<?php

namespace Application\Models;

class User
    extends Model
    implements \Countable
{
    const TABLE = 'users';
    public $name;
    public $email;
    protected $data = [];

    public function count()
    {
        return count($this->data);
    }
}