<?php
require __DIR__ . '/autoload.php';

use Application\Models\User;
use Application\Models\News;
use Application\View;

$view = new View();
//$view->users = User::findAll();
//$view->display(__DIR__ . '/Application/Templates/users.php');

$view->news = News::findAll();
echo $view->news[0]->author->name;

/*
$news = News::getLastNews();
include 'Application/Templates/index.php';
*/