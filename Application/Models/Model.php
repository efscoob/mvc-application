<?php

namespace Application\Models;


abstract class Model
{
    const TABLE = '';
    abstract public static function findAll();
    abstract public static function findById(int $id);
    abstract public function insert();
    abstract public function update();
    abstract public function save();
    abstract public function delete();
}