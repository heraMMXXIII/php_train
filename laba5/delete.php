<?php
require_once 'db.php';


$stmt = $pdo->query("SELECT * FROM contacts ORDER BY surname, name");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->execute([$id]);

    echo "<p class='success'>Запись с ID $id удалена.</p>";
}
?>

<h2>Удаление всех записей</h2>

<?php foreach ($contacts as $contact): ?>
    <div class="contact-delete">
        <h3>Удалить: <?= htmlspecialchars($contact['surname']) . " " . htmlspecialchars($contact['name']) ?></h3>
        <a href="delete.php?id=<?= $contact['id'] ?>" class="form-btn">Удалить</a>
        <hr>
    </div>
<?php endforeach; ?>
