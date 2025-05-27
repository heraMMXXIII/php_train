<?php
session_start(); 

$_SESSION['username'] = 'Вадим';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Страница 1</title>
</head>
<body>
    <h1>Страница 1</h1>
    <p>Имя пользователя сохранено в сессию: <?= $_SESSION['username'] ?></p>
    <a href="2_2.php">Перейти на страницу 2</a>
</body>
</html>
