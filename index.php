<?php
require __DIR__ . '/autoload.php';

$url = trim($_GET['url'], '/');
$route = explode('/', $url);
$route[0] = 'Application\Controllers\\' . ucfirst($route[0]);

try {
    $controller = new $route[0]();
    $action = ucfirst($route[1]);

    if (isset($route[2]) && isset($route[3])) {
        $controller->action($action, [$route[2] => $route[3]]);
    } else {
        $controller->action($action);
    }
} catch (\Application\Exceptions\Core $e) {
    echo 'Не удалось найти в базе запрашиваемую запись';
} catch (\Application\Exceptions\Db $e) {
    echo 'Ошибка при работе с базой данных';
} catch (\Error $e) {

} catch (\Throwable $e) {

}


