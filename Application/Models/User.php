<?php

namespace Application\Models;

use Application\Db;

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