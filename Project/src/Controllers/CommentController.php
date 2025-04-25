<?php
namespace src\Controllers;

use src\View\View;
use src\Models\Comments\Comment;
use src\Models\Articles\Article;

class CommentController
{
    private $view;

    public function __construct() // Создается экземпляр класса View
    {
        $this->view = new View(dirname(dirname(__DIR__)).'/templates');
    }

    public function store(int $articleId)
    {
        $comment = new Comment(); // создаем новый объект модели Comment
        $comment->setText($_POST['text']);
        $comment->setAuthorId(1); 
        $comment->setArticleId($articleId);
        $comment->save(); // сохраняем комментарий вызовом метода save() котрый реализован в ARE.php
        $bUrl = dirname($_SERVER['SCRIPT_NAME']); 
        header("Location: {$bUrl}/article/{$articleId}#comment{$comment->getId()}"); // редирект
    }

    public function edit(int $id)
    {
        $comment = Comment::getById($id); // тут получаем коммент по id
        if (!$comment) {
            throw new \Exception();
        }
        $this->view->renderHtml3('comment/edit.php', [
            'comment' => $comment,
            'error' => null
        ]);
    }

    public function update(int $id)
    {
        $comment = Comment::getById($id); 
        $comment->setText($_POST['text']);
        $comment->save();
        $rUrl = dirname($_SERVER['SCRIPT_NAME']).'/article/'.$comment->getArticleId().'#comment'.$comment->getId();
        header("Location: $rUrl");
    }
}