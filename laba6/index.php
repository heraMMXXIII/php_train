<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $_SESSION['country'] = $_POST['country'] ?? '';
    echo "Вы выбрали страну: " . htmlspecialchars($_SESSION['country']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Выбор страны</title>
</head>
<body>
    <h1>Укажите вашу страну</h1>
    <form method="post" action="index.php">
        <label for="country">Страна:</label>
        <input type="text" name="country" id="country" required>
        <button type="submit">Сохранить</button>
    </form>

    <p><a href="test.php">Перейти на test.php</a></p>
</body>
</html>
