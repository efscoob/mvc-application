<?php

namespace Application\Controllers;


class News
{
    use TController;

    protected function actionAll()
    {
        $this->view->news = \Application\Models\News::getLastNews();
        $this->view->display(__DIR__ . '/../Templates/news.php');
    }

    protected function actionOne(array $params)
    {
        $id = (int) $params['id'];
        $this->view->article = \Application\Models\News::findById($id);
        $this->view->display(__DIR__ . '/../Templates/article.php');
    }

}