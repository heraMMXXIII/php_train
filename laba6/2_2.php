<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Страница 2</title>
</head>
<body>
    <h1>Страница 2</h1>
    <p>Имя пользователя из сессии: <?= $_SESSION['username'] ?? 'Нет данных' ?></p>
    <a href="page1.php">Назад на страницу 1</a>
</body>
</html>
