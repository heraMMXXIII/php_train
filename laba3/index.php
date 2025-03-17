<?php

function transformWords(&$words) {
    foreach ($words as $index => &$word) {
        if (($index + 1) % 2 == 0) { 
            $word = mb_strtoupper($word, 'UTF-8'); 
        }
    }
}


$text = isset($_POST['text']) ? trim($_POST['text']) : '';

if (!empty($text)) {
    $words = preg_split('/\s+/', $text); 
    transformWords($words); 
    $result = implode(' ', $words); 
} else {
    $result = '';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Жесткая ссылка</title>
</head>
<body>
    <form method="POST">
        <label>Введите текст:</label><br>
        <textarea name="text" rows="4" cols="50"><?php echo htmlspecialchars($text); ?></textarea><br>
        <button type="submit">Преобразовать</button>
    </form>

    <?php if (!empty($result)): ?>
        <h3>Результат:</h3>
        <p><?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>
</body>
</html>
