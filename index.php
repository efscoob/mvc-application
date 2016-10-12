<?php
require __DIR__ . '/autoload.php';

$controller = new \Application\Controllers\News();
$action = ($_GET['id']) ? 'One' : 'All';
$controller->action($action);