<?php

namespace Application;


trait Magic
{
    protected $data = [];
    
    function __get($prop)
    {
        return $this->data[$prop];
    }

    function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    function __isset($prop)
    {
        return (!empty($this->data[$prop]));
    }
}