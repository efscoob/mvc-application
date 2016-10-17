<?php
require __DIR__ . '/autoload.php';

$url = trim($_GET['url'], '/');
$route = explode('/', $url);
$route[0] = 'Application\Controllers\\' . ucfirst($route[0]);

$controller = new $route[0]();
$action = ucfirst($route[1]);

if (isset($route[2]) && isset($route[3])) {
    $controller->action($action, [$route[2] => $route[3]]);
} else {
    $controller->action($action);
}


/*
$controller = new \Application\Controllers\News();
$action = ($_GET['id']) ? 'One' : 'All';
$controller->action($action);
*/

