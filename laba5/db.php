<?php
$dsn = 'mysql:host=localhost;dbname=contacts_db;charset=utf8';
$username = 'root'; // Пользователь для подключения к БД
$password = ''; // Пароль пользователя

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>
