<?php
require dirname(__DIR__) . '/header.php';
?>
<table class="table">
  <!-- Заголовки таблицы -->
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Text</th>
      <th scope="col">Author</th>
      <th scope="col">Actions</th> <!-- Новая колонка для действий -->
    </tr>
  </thead>
  <tbody>
    <?php foreach ($articles as $article): ?>
      <tr>
        <th scope="row"><?= htmlspecialchars($article->getId()) ?></th>
        <td>
          <a href="<?= BASE_PATH ?>/article/<?= $article->getId() ?>"><?= htmlspecialchars($article->getName()) ?></a>
        </td>
        <td><?= htmlspecialchars(mb_substr($article->getText(), 0, 50)) ?>...</td>
        <td><?= htmlspecialchars($article->getAuthor()->getNickName()) ?></td>
        <td>
          <!-- Кнопка редактирования -->
          <a href="/php/Project/www/article/<?= $article->getId() ?>/edit" class="btn btn-primary btn-sm">
            Редактировать
          </a>

          <!-- Кнопка удаления -->
          <form action="/article/<?= $article->getId() ?>/delete" method="post" style="display: inline;">
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
              Delete
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require dirname(__DIR__) . '/footer.php'; ?>