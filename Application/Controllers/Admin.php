<?php

namespace Application\Controllers;


use Application\Models\Author;

class Admin
{
    use TController;

    protected function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['author']);
            if (empty($author = \Application\Models\Author::findByName($name))) {
                $author = new \Application\Models\Author();
                $author->name = $name;
                $author->save();
            }
            $article = new \Application\Models\News();
            $article->author_id = $author->id;
            $article->title = trim($_POST['title']);
            $article->lead = trim($_POST['lead']);
            $article->save();
            header("Location: /webapp/news/all");
            die();
        }
        $this->view->display(__DIR__ . '/../Templates/addnews.php');
    }

    protected function actionEdit(array $params = [])
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $news = \Application\Models\News::findById($params['id']);
            $news->title = trim($_POST['title']);
            $news->lead = trim($_POST['lead']);
            $news->update();
            header("Location: /webapp/news/all");
            die();
        }
        $this->view->article = \Application\Models\News::findById($params['id']);
        $this->view->display(__DIR__ . '/../Templates/editnews.php');
    }
    
    protected function actionDelete(array $params = [])
    {
        $news = \Application\Models\News::findById($params['id']);
        $news->delete();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }

}