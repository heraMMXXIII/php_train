<?php

namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use InvalidArgumentException;
use DateTimeImmutable;
use src\Services\Db;

class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $createdAt;

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->createdAt);
    }

    public function setName(string $name): void
    {
        if (empty(trim($name))) {
            throw new InvalidArgumentException('Название статьи не может быть пустым');
        }

        if (mb_strlen($name) > 255) {
            throw new InvalidArgumentException('Название статьи не может быть длиннее 255 символов');
        }

        $this->name = $name;
    }

    public function setText(string $text): void
    {
        if (empty(trim($text))) {
            throw new InvalidArgumentException('Текст статьи не может быть пустым');
        }

        $this->text = $text;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public static function createFromArray(array $fields, User $author): self
    {
        if (empty($fields['name'])) {
            throw new InvalidArgumentException('Не передано название статьи');
        }

        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст статьи');
        }

        $article = new self();
        $article->setName($fields['name']);
        $article->setText($fields['text']);
        $article->setAuthor($author);

        return $article;
    }

    public function updateFromArray(array $fields): void
    {
        if (!empty($fields['name'])) {
            $this->setName($fields['name']);
        }

        if (!empty($fields['text'])) {
            $this->setText($fields['text']);
        }
    }

    protected static function getTableName(): string
    {
        return 'articles';
    }
    public function getComments(): array
    {
        $db = \src\Services\Db::getInstance(); // Явное указание пространства имен
        $sql = 'SELECT * FROM `comments` WHERE `article_id` = :article_id ORDER BY `created_at` DESC';
        $result = $db->query($sql, [':article_id' => $this->id], 'src\Models\Comments\Comment');

        return $result ?: [];
    }
}