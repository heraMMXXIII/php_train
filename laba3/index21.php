<?php

$monarchs = [
    "XVI" => "Иван Васильевич",
    "XVIII" => "Пётр Алексеевич",
    "XIX" => "Николай Павлович"
];


$century = isset($_POST['century']) ? trim(strtoupper($_POST['century'])) : '';

$result = '';
if (!empty($century)) {
    if (isset($monarchs[$century])) {
        $result = "В $century веке царствовал " . $monarchs[$century] . ".";
    } else {
        $result = "Царь для века $century не найден.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск царя по веку</title>
</head>
<body>
    <form method="POST">
        <label>Введите римскую цифру века (например, XVI, XVIII, XIX):</label><br>
        <input type="text" name="century" value="<?php echo htmlspecialchars($century); ?>"><br>
        <button type="submit">Найти правителя</button>
    </form>

    <?php if (!empty($result)): ?>
        <h3>Результат:</h3>
        <p><?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>
</body>
</html>
