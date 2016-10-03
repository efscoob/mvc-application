<?php

namespace Application\Models;

use Application\Db;

class User extends Model
{
    const TABLE = 'users';
    public $name;
    public $email;
    
    public function __construct()
    {
    }
    
    public static function findAll() {
        $db = new Db();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class);
    }

    public static function findById(int $id)
    {
        // TODO: Implement findById() method.
        $db = new Db();
        $user =  $db->query("SELECT * FROM " . static::TABLE . ' WHERE id=' . $id, static::class);
        if ($user) {
            return ['name' => $user->name, 'email' => $user->email];
        }
        return false;
    }
}