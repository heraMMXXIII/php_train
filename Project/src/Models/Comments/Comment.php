<?php

namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Services\Db;
use DateTime;

class Comment extends ActiveRecordEntity
{
    protected $text;
    protected $authorId;
    protected $articleId;
    protected $createdAt;

    public function getText(): string
    {
        return htmlspecialchars($this->text);
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId); // возвращение объекта User 
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    public function getCreatedAt(): string
    {
        $date = new DateTime($this->createdAt);
        return $date->format('d.m.Y H:i');
    }

    public function setText(string $text): void
    {
        $this->text = trim($text); // обрезка пробелов в начале и конце строки 
    }

    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public static function findAllByArticleId(int $articleId): array //тут получаем все комментарии к статье
    {
        $db = Db::getInstance(); // подключение к БД посредством синглтона 
        $sql = 'SELECT * FROM `'.static::getTableName().'` 
                WHERE `article_id` = :article_id 
                ORDER BY `created_at` DESC';
        $result = $db->query($sql, [':article_id' => $articleId], static::class); // тут преобразуем резульат в объект класса Comment
        return $result ?: [];
    }

    protected static function getTableName(): string // здесь мы указываем, с какой таблицей работает модель 
    {
        return 'comments';
    }
}