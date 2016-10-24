<?php

namespace Application\Controllers;


use Application\Exceptions\MultiException;

class Admin
{
    use TController;

    protected function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $author = \Application\Models\Author::findByName($_POST['author'])[0];
            if (empty($author) && !empty($_POST['author'])) {
                $author = new \Application\Models\Author();
                try {
                    $author->fill($_POST);
                    $author->save();
                } catch (MultiException $e) {
                    $this->view->errors[] = $e;
                }
            }
            $article = new \Application\Models\News();
            if (empty($article->author_id = $author->id)) {
                $article->author_id = NULL;
            }
            try {
                $article->fill($_POST);
                $article->save();
                header("Location: /webapp/news/all");
                die();
            } catch (MultiException $e) {
                (new \Application\Logger('admin'))->info('Сработало мультиисключение');
                //var_dump($e);
                $this->view->errors[] = $e;
            }
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