<h2>Редактирование комментария</h2>

<form action="/comment/update" method="post">
    <input type="hidden" name="id" value="<?= $comment->getId() ?>">
    <textarea name="text"><?= htmlspecialchars($comment->getText()) ?></textarea>
    <button type="submit">Сохранить</button>
</form>