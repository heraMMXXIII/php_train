<?php
require dirname(__DIR__) . '/header.php';
?>
<div class="container mt-4">
    <h1 class="mb-4">Список статей</h1>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Текст</th>
                <th scope="col">Автор</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($article->getId()) ?></th>
                    <td>
                        <a href="<?= htmlspecialchars(dirname($_SERVER['SCRIPT_NAME']) . '/article/' . $article->getId()) ?>">
                            <?= htmlspecialchars($article->getName()) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars(mb_strimwidth($article->getText(), 0, 100, '...')) ?></td>
                    <td>
                        <?php if ($article->getAuthor()): ?>
                            <?= htmlspecialchars($article->getAuthor()->getNickname()) ?>
                        <?php else: ?>
                            <span class="text-muted">Неизвестен</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (empty($articles)): ?>
        <div class="alert alert-info">Статьи не найдены</div>
    <?php endif; ?>
</div>
<?php
require dirname(__DIR__) . '/footer.php';
?>