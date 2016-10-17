<?php

namespace Application\Models;


class Author extends Model
{
    const TABLE = 'authors';

    public $name;

    public static function findByName(string $name)
    {
        $db = \Application\Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE name=' . $name;
        return $db->query($sql, static::class);
    }

}