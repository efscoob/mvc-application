<?php

namespace Application;


trait TSingletone
{

    protected static $instance;

    public static function getInstance() {
        if (null == self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}