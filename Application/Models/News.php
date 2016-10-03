<?php
/**
 * Created by PhpStorm.
 * User: Люба
 * Date: 01.10.2016
 * Time: 15:18
 */

namespace Application\Models;


use Application\Db;

class News
{
    const TABLE = 'news';

    public $id;
    public $title;
    public $news;

    public function __construct() {
    }

    public static function getLastNews() {
        $db = new Db();
        if ($res = $db->query('SELECT count(*) as count FROM ' . static::TABLE)) {
            $cnt = $res[0]->count;
            $cnt = ($cnt > 4) ? $cnt -= 4 : $cnt = 1;
            $news = $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id >= ' . $cnt, static::class);
            return $news;
        }
        return false;
    }
}