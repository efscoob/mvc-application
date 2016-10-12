<?php

namespace Application\Models;


use Application\Db;

class News extends Model
{
    const TABLE = 'news';

    public $title;
    public $lead;
    public $author_id;

    function __get($k)
    {
        switch ($k) {
            case 'author':
                if (!empty($this->author_id)) {
                    return Author::findById($this->author_id);
                } else {
                    return null;
                }
                break;
            case 'id':
                return $this->id;
            default:
                return null;
        }
    }

    function __isset($prop)
    {
        switch ($prop) {
            case 'author':
                return true;
                //return (!empty($this->author));
                break;
            default: return false;
        }
    }

    public static function getLastNews() {
        $db = Db::getInstance();
        if ($res = $db->query('SELECT count(*) as count FROM ' . static::TABLE)) {
            $cnt = $res[0]->count;
            $cnt = ($cnt > 4) ? $cnt -= 4 : $cnt = 1;
            $news = $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id >= ' . $cnt, static::class);
            return $news;
        }
        return false;
    }
}