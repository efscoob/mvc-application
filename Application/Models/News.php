<?php

namespace Application\Models;


use Application\Exceptions\Core;
use Application\Exceptions\MultiException;

class News extends Model
{
    const TABLE = 'news';

    public $title;
    public $lead;
    public $author_id;

    /**
     * Функция для получения массива из объектов новостей.
     *
     * Число новостей может быть переданно пользователем. Новости в массиве возврешеются в порядке убывания по полю id в таблице news.
     * @param int $cntNews Число последних новостей, которые необходимо получить из базы
     * @throws \Application\Exceptions\Core Выбрасывается в случае, если запрос в базу для подсчета записей в таблице news вернул базовый объект
     * со значением свойства $count == 0
     * @return array $news Массив из объектов класса \Application\Models\News, полученных из таблицы news
     */
    public static function getLastNews(int $cntNews = 4)
    {
        $db = \Application\Db::getInstance();
        $res = $db->query('SELECT count(*) as count FROM ' . static::TABLE);
        $cnt = $res[0]->count;
        if ($cnt == 0) {
            throw new Core('Новостей не найдено');
        }
        if ($cnt > $cntNews) {
            $cnt -= $cntNews;
        } else {
            $cnt = 0;
        }
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id > :id ORDER BY id DESC';
        $news = $db->query($sql, static::class, [':id' => $cnt]);
        return $news;
    }

    function fill(array $data = [])
    {
        $e = new MultiException();
        $this->title = trim($data['title']);
        if (empty($this->title)) {
            $e[] = new \Exception('Ошибка заголовка');
        }
        $this->lead = trim(htmlspecialchars($data['lead']));
        if (empty($this->lead)) {
            $e[] = new \Exception('Не верный текст новости');
        }
        if ($e[0]) {
            throw $e;
        }
    }

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
            default:
                return false;
        }
    }
}