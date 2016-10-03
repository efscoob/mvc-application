<?php
require __DIR__ . '/autoload.php';

use Application\Db;
use Application\Models\User;
use Application\Models\News;

$db = new Db();
/*
$sql = 'CREATE TABLE news (
          id SERIAL NOT NULL,
          title VARCHAR(255) NOT NULL,
          news TEXT NOT NULL
        )';
$db->execute($sql);
*/

$news = News::getLastNews();

include 'Templates/index.php';
