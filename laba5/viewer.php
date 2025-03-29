<?php
require_once 'db.php';

// Получаем все записи из базы данных
$stmt = $pdo->query("SELECT * FROM contacts ORDER BY surname, name");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Список контактов</h2>

<table>
    <thead>
        <tr>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Email</th>
            <th>Адрес</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?= htmlspecialchars($contact['surname']) ?></td>
                <td><?= htmlspecialchars($contact['name']) ?></td>
                <td><?= htmlspecialchars($contact['phone']) ?></td>
                <td><?= htmlspecialchars($contact['email']) ?></td>
                <td><?= htmlspecialchars($contact['address']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

