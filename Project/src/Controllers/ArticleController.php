<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;

class ArticleController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)) . '/templates');
    }

    public function index()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main', ['articles' => $articles]);
    }


    public function show(int $id)
    {

        $article = Article::getById($id);
        if ($article == null) {
            $this->view->renderHtml('main/error', [], 404);
            return;
        }
        $author = $article->getAuthorId();
        $this->view->renderHtml('article/show', ['article' => $article, 'author' => $author]);
    }

}