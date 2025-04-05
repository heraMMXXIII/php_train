<?php
/** @var Article $article */
/** @var string $basePath */
/** @var string|null $error */
$error = $error ?? null;
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование статьи</title>
    <style>
        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border: 1px solid #6c757d;
        }
    </style>
</head>

<body>
    <h1>Редактирование статьи</h1>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif ?>
    <form method="post" action="<?= $basePath ?>/article/<?= $article->getId() ?>/update">
        <div class="form-group">
            <label for="title">Название:</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($article->getName()) ?>"
                class="form-control" required>
        </div>

        <div class="form-group">
            <label for="text">Текст статьи:</label>
            <textarea id="text" name="text" class="form-control" rows="10" required><?=
                htmlspecialchars($article->getText())
                ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?= $basePath ?>/article/<?= $article->getId() ?>" class="btn btn-secondary">Отмена</a>
    </form>
</body>

</html>