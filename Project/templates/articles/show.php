<?php
/** @var \src\Models\Articles\Article $article */
/** @var string $basePath */
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article->getName()) ?> - Мой блог</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .article-meta {
            color: #666;
            font-size: 0.9em;
            margin-bottom: 20px;
        }

        .article-content {
            margin-top: 20px;
        }

        .edit-link {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .edit-link:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <article>
        <h1><?= htmlspecialchars($article->getName()) ?></h1>

        <div class="article-meta">
            Опубликовано: <?= $article->getCreatedAt()->format('d.m.Y H:i') ?>
        </div>

        <div class="article-content">
            <?= nl2br(htmlspecialchars($article->getText())) ?>
        </div>

        <a href="<?= $basePath ?>/article/<?= $article->getId() ?>/edit" class="edit-link">
            Редактировать статью
        </a>
    </article>
 <!-- После вывода статьи -->
<div class="comments-section">
    <h3>Комментарии</h3>
    
    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form action="<?= $basePath ?>/articles/<?= $article->getId() ?>/comments" method="post">
    <textarea name="text" required></textarea>
    <button type="submit">Отправить комментарий</button>
</form>

    <div class="comments-list">
        <?php foreach ($comments as $comment): ?>
        <div class="comment" id="comment-<?= $comment->getId() ?>">
            <div class="comment-text"><?= htmlspecialchars($comment->getText()) ?></div>
            <div class="comment-meta">
                <span class="comment-author"><?= htmlspecialchars($comment->getAuthor()->getName()) ?></span>
                <span class="comment-date"><?= $comment->getCreatedAt()->format('d.m.Y H:i') ?></span>
                <a href="/comment/<?= $comment->getId() ?>/edit" class="comment-edit">Редактировать</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>

</html>