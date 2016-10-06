<?php
require __DIR__ . '/autoload.php';

use Application\Models\User;
use Application\Models\News;

/*
$db = new Db();
$sql = 'CREATE TABLE news (
          id SERIAL NOT NULL,
          title VARCHAR(255) NOT NULL,
          news TEXT NOT NULL
        )';
$db->execute($sql);
*/

$user = new User();
$user->name = 'Vika';
$user->email = 'vik@girl.ru';
$user->insert();
echo 'Пауза перед удалением!';
$user->delete();
echo 'Запись в БД удалена!';

/*
$news = News::getLastNews();
include 'Templates/index.php';
*/