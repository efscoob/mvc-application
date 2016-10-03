<?php
/**
 * @param $class
 */
function __autoload($class) {
        include __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
}