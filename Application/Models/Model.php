<?php

namespace Application\Models;


abstract class Model
{
    const TABLE = '';
    abstract public static function findAll();
    abstract public static function findById(int $id);
}