<?php
namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name;
    protected $text;
    protected $author_id;


    public function getName(): string 
    {
        return $this->name;
    }

    public function getText(): string 
    {
        return $this->text;
    }

    public function getAuthorId(): int 
    {
        return $this->author_id;
    }
    
    public function getAuthor(): ?User 
    {
        if (!$this->author_id) {
            return null; 
        }
        return User::getById($this->author_id); //тут загружаем объект User через User::getById()
    }
    
   
    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    public function setText(string $text): void 
    {
        $this->text = $text;
    }

    public function setAuthorId(int $authorId): void 
    {
        $this->author_id = $authorId;
    }

    public static function getTableName(): string // здесь мы указываем, с какой таблицей работает модель 
    {
        return 'articles';
    }
}