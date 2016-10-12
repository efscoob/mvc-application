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
    //static private $instance;
    public $data = [];
    
    use Singletone;
    
    private function __construct() {
        $this->data = parse_ini_file(static::CONFIG_PATH);
    }
    
}