<?php
/**
 * Created by PhpStorm.
 * User: Люба
 * Date: 04.10.2016
 * Time: 20:04
 */

namespace Application;


class Config
{
    const CONFIG_PATH = 'C:\OpenServer\domains\localhost\webapp\data.ini';
    static private $_instance;
    public $data = [];

    private function __construct() {
        $this->data = parse_ini_file(static::CONFIG_PATH);
    }

    static public function getInstance() {
        if (null == self::$_instance) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}