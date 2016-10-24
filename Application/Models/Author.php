<?php

namespace Application\Models;


class Author extends Model
{
    const TABLE = 'authors';

    public $name;

    function fill(array $name)
    {
        $e = new \Application\Exceptions\MultiException();
        $this->name = trim(htmlspecialchars($name['author']));
        if (empty($this->name)) {
            $e[] = new \Exception('Недопустимое имя автора');
        }
        if ($e[0]) {
            throw $e;
        }
    }

    public static function findByName(string $name)
    {
        $db = \Application\Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE name=:name';
        return $db->query($sql, static::class, [':name' => $name]);
    }

}