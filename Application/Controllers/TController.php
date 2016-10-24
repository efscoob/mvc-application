<?php

namespace Application\Controllers;


trait TController
{
    protected $view;

    function __construct()
    {
        $this->view = new \Application\View();
    }

    public function action(string $method, array $params = [])
    {
        $method = 'action' . $method;
        $this->$method($params);
    }
}