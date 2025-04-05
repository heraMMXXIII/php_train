<?php

namespace src\Controllers;

use src\Exceptions\DbException;
use src\Exceptions\NotFoundException;
use src\View\View;
use src\Models\Articles\Article;
use InvalidArgumentException;

class ArticleController
{
    private $view;
    private $basePath;

    public function __construct()
    {
        // Указываем абсолютный путь к шаблонам
        $templatesPath = realpath(__DIR__ . '/../../templates');
        $this->view = new View($templatesPath);
        $this->basePath = defined('BASE_PATH') ? BASE_PATH : '';

        // Для отладки (временная проверка)
        if (!file_exists($templatesPath . '/articles/show.php')) {
            die("Show template not found at: " . $templatesPath . '/articles/show.php');
        }
    }
    public function index()
    {
        $articles = Article::findAll();
        $this->view->renderHtml('main/main', [
            'articles' => $articles,
            'basePath' => $this->basePath
        ]);
    }


    public function create()
    {
        $this->view->renderHtml('article/create', [
            'basePath' => $this->basePath
        ]);
    }

    public function store()
    {
        try {
            $article = new Article();
            $article->setName($_POST['name'] ?? '');
            $article->setText($_POST['text'] ?? '');
            $article->authorId = 1; // Временное решение, нужно добавить аутентификацию
            $article->save();

            header('Location: ' . $this->basePath . '/article/' . $article->getId());
            exit();
        } catch (InvalidArgumentException $e) {
            $this->view->renderHtml('article/create', [
                'error' => $e->getMessage(),
                'article' => $article ?? null,
                'basePath' => $this->basePath
            ]);
        }
    }

    public function edit(int $id)
    {
        $article = Article::getById($id);
        if ($article === null) {
            throw new NotFoundException();
        }

        $this->view->renderHtml('articles/edit', [
            'article' => $article,
            'basePath' => $this->basePath
        ]);
    }
    public function update(int $id)
    {
        try {
            $article = Article::getById($id);
            if ($article === null) {
                throw new NotFoundException('Статья не найдена');
            }

            // Валидация входных данных
            if (empty($_POST['title'])) {
                throw new InvalidArgumentException('Не заполнено название статьи');
            }

            if (empty($_POST['text'])) {
                throw new InvalidArgumentException('Не заполнен текст статьи');
            }

            // Подготовка данных
            $newTitle = htmlspecialchars(strip_tags($_POST['title']));
            $newText = htmlspecialchars(strip_tags($_POST['text']));

            // Проверка изменений
            if ($article->getName() === $newTitle && $article->getText() === $newText) {
                $_SESSION['info'] = 'Изменений не обнаружено';
                header('Location: ' . $this->basePath . "/" . "index.php");
                exit();
            }

            // Обновление статьи
            $article->setName($newTitle);
            $article->setText($newText);

            // Сохранение с проверкой
            if (!$article->save()) {
                throw new DbException('Ошибка при сохранении в базу данных');
            }

            $_SESSION['success'] = 'Статья успешно обновлена';
            header('Location: ' . $this->basePath . "/" . "index.php");
            exit();

        } catch (NotFoundException $e) {
            // Логирование ошибки "Не найдено"
            error_log('Not Found Error: ' . $e->getMessage());
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . $this->basePath . '/');
            exit();

        } catch (DbException $e) {
            // Логирование ошибки базы данных
            error_log('Database Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Произошла ошибка при сохранении данных';
            $_SESSION['db_error'] = $e->getMessage(); // Для отладки
            header('Location: ' . $this->basePath . '/article/' . $id . '/edit');
            exit();

        } catch (InvalidArgumentException $e) {
            // Обработка ошибок валидации
            $this->view->renderHtml('articles/edit', [
                'article' => $article ?? null,
                'error' => $e->getMessage(),
                'basePath' => $this->basePath
            ]);

        } catch (\RuntimeException $e) {
            // Логирование неожиданных runtime ошибок
            error_log('Runtime Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Произошла непредвиденная ошибка';
            header('Location: ' . $this->basePath . '/');
            exit();

        } catch (\Exception $e) {
            // Логирование всех остальных исключений
            error_log('System Error: ' . $e->getMessage());
            $_SESSION['error'] = 'Системная ошибка';
            header('Location: ' . $this->basePath . '/');
            exit();
        }
    }
    public function delete(int $id)
    {
        $article = Article::getById($id);
        if ($article === null) {
            throw new NotFoundException();
        }

        $article->delete();
        header('Location: ' . $this->basePath . '/');
        exit();
    }
    public function getCreatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->createdAt);
    }
    public function save(): bool
    {
        $db = Db::getInstance();

        try {
            if ($this->id === null) {
                // Логика создания новой записи
                $sql = 'INSERT INTO articles (name, text, author_id) VALUES (:name, :text, :author_id)';
                $params = [
                    ':name' => $this->name,
                    ':text' => $this->text,
                    ':author_id' => $this->authorId
                ];
            } else {
                // Логика обновления
                $sql = 'UPDATE articles SET name = :name, text = :text WHERE id = :id';
                $params = [
                    ':name' => $this->name,
                    ':text' => $this->text,
                    ':id' => $this->id
                ];
            }

            $stmt = $db->prepare($sql);
            $result = $stmt->execute($params);

            // Для INSERT запросов
            if ($this->id === null && $result) {
                $this->id = $db->lastInsertId();
            }

            // Проверка для UPDATE запросов
            if ($this->id !== null && $stmt->rowCount() === 0) {
                throw new RuntimeException('Ни одна запись не была обновлена');
            }

            return $result;

        } catch (PDOException $e) {
            error_log('PDO Error: ' . $e->getMessage());
            throw new RuntimeException('Ошибка при работе с базой данных');
        }
    }
    public function addComment(int $articleId)
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            throw new NotFoundException();
        }

        $comment = Comment::createFromArray(
            $_POST,
            $this->getUser(), // Предполагается, что у вас есть метод получения текущего пользователя
            $article
        );

        header('Location: /article/' . $articleId . '#comment' . $comment->getId());
        exit();

    }

    public function show(int $id)
    {
        $article = Article::getById($id);
        if (!$article) {
            throw new NotFoundException();
        }
    
        $comments = $article->getComments();
        
        $this->view->renderHtml('articles/show', [
            'article' => $article,
            'comments' => $comments,
            'basePath' => $this->basePath
        ]);
    }
}