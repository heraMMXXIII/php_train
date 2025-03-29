<?php
session_start();
require_once 'menu.php';
require_once 'db.php';

// Определяем активный пункт меню
$page = $_GET['page'] ?? 'view';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <?= getMenu($page); ?>
    </header>
    <main>
        <?php
        // Показываем только список контактов на главной странице
        if ($page == 'view') {
            require 'viewer.php'; // Страница для отображения списка всех контактов
        }
        ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y'); ?> Записная книжка</p>
    </footer>
</body>
</html>
