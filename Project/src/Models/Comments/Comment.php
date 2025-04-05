<?php
namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Models\Articles\Article;
use InvalidArgumentException;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getArticle(): Article
    {
        return Article::getById($this->articleId);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        if (empty(trim($text))) {
            throw new InvalidArgumentException('Комментарий не может быть пустым');
        }
        $this->text = $text;
    }

    public static function createForArticle(int $articleId, array $fields, User $author): self
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Текст комментария обязателен');
        }

        $comment = new self();
        $comment->setText($fields['text']);
        $comment->articleId = $articleId;
        $comment->authorId = $author->getId();
        $comment->save();

        return $comment;
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }
}