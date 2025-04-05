<?php
namespace src\Controllers;

use src\Models\Comments\Comment;
use src\Models\Articles\Article;
use src\Exceptions\NotFoundException;
use src\View\View;

class CommentController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
    }

    public function add(int $articleId)
    {
        $article = Article::getById($articleId);
        if (!$article) {
            throw new NotFoundException('Статья не найдена');
        }

        // Получаем текущего пользователя (заглушка)
        $author = User::getById(1); // Замените на реального пользователя

        try {
            $comment = Comment::createForArticle($articleId, $_POST, $author);
            header("Location: /article/{$articleId}#comment-{$comment->getId()}");
            exit();
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('articles/show', [
                'article' => $article,
                'error' => $e->getMessage(),
                'comments' => $article->getComments()
            ]);
        }
    }

    public function edit(int $commentId)
    {
        $comment = Comment::getById($commentId);
        if (!$comment) {
            throw new NotFoundException('Комментарий не найден');
        }

        // Здесь будет логика редактирования
        $this->view->renderHtml('comments/edit', ['comment' => $comment]);
    }
    public function update()
{
    $comment = Comment::getById($_POST['id']);
    if (!$comment) {
        throw new NotFoundException();
    }

    try {
        $comment->setText($_POST['text']);
        $comment->save();
        
        header("Location: /article/{$comment->getArticle()->getId()}#comment-{$comment->getId()}");
        exit();
    } catch (InvalidArgumentException $e) {
        $this->view->renderHtml('comments/edit', [
            'comment' => $comment,
            'error' => $e->getMessage()
        ]);
    }
}
}