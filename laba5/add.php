<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'db.php';

    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];


    $stmt = $pdo->prepare("INSERT INTO contacts (surname, name, phone) VALUES (?, ?, ?)");
    $stmt->execute([$surname, $name, $phone]);

    echo "<p class='success'>Запись успешно добавлена!</p>";
}
?>

<form method="POST">
    <label for="surname">Фамилия:</label><br>
    <input type="text" id="surname" name="surname" required><br><br>

    <label for="name">Имя:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="phone">Телефон:</label><br>
    <input type="text" id="phone" name="phone" required><br><br>

    <button type="submit">Добавить запись</button>
</form>
