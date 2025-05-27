<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ваша страна</title>
</head>
<body>
    <h1>Информация из сессии</h1>

    <?php if (isset($_SESSION['country']) && $_SESSION['country'] !== ''): ?>
        <p>Вы указали страну: <?= htmlspecialchars($_SESSION['country']) ?></p>
    <?php else: ?>
        <p>Страна не указана. Сначала перейдите на <a href="index.php">index.php</a>.</p>
    <?php endif; ?>
</body>
</html>
