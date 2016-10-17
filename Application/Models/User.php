<?php

namespace Application\Models;

class User extends Model implements \Countable
{
    const TABLE = 'users';
    public $name;
    public $email;

    public function count()
    {
        return count($this->data);
    }
}