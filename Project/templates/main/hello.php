<?php
$uri_tek = $_SERVER['REQUEST_URI']; // тек.путь
$title = "Мой блог"; // заголовок дефолтный
if (strpos($uri_tek, '/hello/') !== false) {
    $title = "Страница приветствия"; // Заголовок для страницы /hello/
    require dirname(__DIR__) . '/header.php';
}
?>
<h5>Hello, <?= htmlspecialchars($name); ?>!</h5>
<?php require dirname(__DIR__) . '/footer.php'; ?>