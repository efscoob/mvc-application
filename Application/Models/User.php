<?php

namespace Application\Models;

use Application\Db;

class User extends Model
{
    const TABLE = 'users';
    public $name;
    public $email;
    protected $id;
    
    public function __construct()
    {
    }
    
    public static function findAll() {
        $db = Db::getInstance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class);
    }

    public static function findById(int $id)
    {
        // TODO: Implement findById() method.
        $db = Db::getInstance();
        $user =  $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id=' . $id, static::class);
        if ($user) {
            return ['name' => $user->name, 'email' => $user->email];
        }
        return false;
    }
    
    public function isNew() {
        return (empty($this->id));
    }

    public function insert() {
        if (!$this->isNew()) {
            return;
        }
        $db = Db::getInstance();
        foreach ($this as $k => $v) {
            if ($k == 'id') {
                continue;
            }
            $cols[] = $k;
            $vals[':' . $k] = $v;
            $impl[] = $k . '=:' . $k;
        }
        $sql = 'INSERT INTO ' . static::TABLE . '(' . implode(',', $cols) . ') VALUES(' . implode(',', array_keys($vals)) . ')';
        $db->execute($sql, $vals);
        
        $this->id = $db->lastInsertId();
        echo $this->id;
    }

    public function update() {
        if ($this->isNew()) {
            return;
        }
        foreach($this as $k => $v) {
            if ($k == 'id') {
                continue;
            }
            $cols[] = $k;
            $vals[':' . $k] = $v;
            $impl[] = $k . ':=' . $k;
        }
        $db = Db::getInstance();
        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(',', $impl) . ' WHERE id=:id';
        $db->execute($sql, $vals);
    }

    public function delete() {
        if ($this->isNew()) {
            return;
        }
        $db = Db::getInstance();
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE id=:id';
        $db->execute($sql, [':id' => $this->id]);
        unset($this->id);
    }

    public function save() {
        if ($this->isNew()) {
            $this->inert();
        } else {
            $this->update();
        }
    }
}