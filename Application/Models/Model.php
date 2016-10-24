<?php

namespace Application\Models;

use Application\Db;

abstract class Model
{
    const TABLE = '';
    public $id;

    public static function findAll() {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM ' . static::TABLE, static::class);
    }

    public static function findById(int $id)
    {
        $db = Db::getInstance();
        $user =  $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id=' . $id, static::class);
        if ($user) {
            return $user[0];
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
        }
        $sql = 'INSERT INTO ' . static::TABLE . '(' . implode(',', $cols) . ') VALUES(' . implode(',', array_keys($vals)) . ')';
        $db->execute($sql, $vals);

        $this->id = $db->lastInsertId();
    }

    public function update() {
        if ($this->isNew()) {
            return;
        }
        foreach($this as $k => $v) {
            if ($k == 'id') {
                $vals[':' . $k] = $v;
                continue;
            }
            $vals[':' . $k] = $v;
            $impl[] = $k . '=:' . $k;
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
            $this->insert();
        } else {
            $this->update();
        }
    }
}