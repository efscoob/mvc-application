<?php

namespace Application\Controllers;


use Application\View;

class News
{
    protected $view;
    
    function __construct() {
        $this->view = new View();
    }
    
    public function action($method) {
        $method = 'action' . $method;
        $this->$method();
    }
    
    protected function actionAll() {
        $this->view->news = \Application\Models\News::getLastNews();
        $this->view->display(__DIR__ . '/../Templates/news.php');
    }
    
    protected function actionOne() {
        $id = (int) $_GET['id'];
        $this->view->article = \Application\Models\News::findById($id);
        $this->view->display(__DIR__ . '/../Templates/article.php');
    }

}