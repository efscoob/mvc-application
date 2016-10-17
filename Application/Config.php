<?php

namespace Application;


class Config
{
    const CONFIG_PATH = __DIR__ . '\..\data.ini';
    public $data = [];
    
    use TSingletone;
    
    private function __construct() {
        $this->data['db'] = parse_ini_file(static::CONFIG_PATH);
    }
    
}