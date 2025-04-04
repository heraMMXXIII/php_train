<?php
require_once 'db.php'; 

$stmt = $pdo->query("SELECT * FROM contacts ORDER BY surname, name");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($contacts as $contact) {

        if (isset($_POST['surname_' . $contact['id']])) {
            $surname = $_POST['surname_' . $contact['id']];
            $name = $_POST['name_' . $contact['id']];
            $lastname = $_POST['lastname_' . $contact['id']];
            $gender = $_POST['gender_' . $contact['id']];
            $birthdate = $_POST['birthdate_' . $contact['id']];
            $phone = $_POST['phone_' . $contact['id']];
            $address = $_POST['address_' . $contact['id']];
            $email = $_POST['email_' . $contact['id']];
            $comment = $_POST['comment_' . $contact['id']];

            $sql = "UPDATE contacts SET surname = ?, name = ?, lastname = ?, gender = ?, birthdate = ?, phone = ?, address = ?, email = ?, comment = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$surname, $name, $lastname, $gender, $birthdate, $phone, $address, $email, $comment, $contact['id']]);
        }
    }
    echo "<p class='success'>Все изменения сохранены.</p>";
}
?>

<h2>Редактирование всех записей</h2>

<form method="post">
    <?php foreach ($contacts as $contact): ?>
        <div class="contact-edit">
            <h3>Редактировать: <?= htmlspecialchars($contact['surname']) . " " . htmlspecialchars($contact['name']) ?></h3>
            <label>Фамилия:</label>
            <input type="text" name="surname_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['surname']) ?>">
            
            <label>Имя:</label>
            <input type="text" name="name_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['name']) ?>">
            
            <label>Отчество:</label>
            <input type="text" name="lastname_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['lastname']) ?>">
            
            <label>Пол:</label>
            <select name="gender_<?= $contact['id'] ?>">
                <option value="мужской" <?= $contact['gender'] == 'мужской' ? 'selected' : '' ?>>мужской</option>
                <option value="женский" <?= $contact['gender'] == 'женский' ? 'selected' : '' ?>>женский</option>
            </select>

            <label>Дата рождения:</label>
            <input type="date" name="birthdate_<?= $contact['id'] ?>" value="<?= $contact['birthdate'] ?>">

            <label>Телефон:</label>
            <input type="text" name="phone_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['phone']) ?>">

            <label>Адрес:</label>
            <input type="text" name="address_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['address']) ?>">

            <label>Email:</label>
            <input type="email" name="email_<?= $contact['id'] ?>" value="<?= htmlspecialchars($contact['email']) ?>">

            <label>Комментарий:</label>
            <textarea name="comment_<?= $contact['id'] ?>"><?= htmlspecialchars($contact['comment']) ?></textarea>
            <hr>
        </div>
    <?php endforeach; ?>

    <button type="submit" class="form-btn">Сохранить изменения</button>
</form>
