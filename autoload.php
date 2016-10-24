<?php
/**
 * Функция автозагрузки классов
 *
 * @param string $class Полное имя класса
 */
function __autoload($class) {
    include __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
}