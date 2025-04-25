<?php require dirname(__DIR__, 2).'/templates/header.php'; ?>

<div class="container mt-4">
    <h2>Редактирование комментария</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <?php if ($comment): ?>
        <form action="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/comment/<?= $comment->getId() ?>/update" method="POST">
        <div class="mb-3">
            <label for="text" class="form-label">Текст комментария</label>
            <textarea class="form-control" id="text" name="text" rows="5" required><?= 
                htmlspecialchars($comment->getText()) 
            ?></textarea>
        </div>
        
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
    <?php endif; ?>
</div>

<?php require dirname(__DIR__, 2).'/templates/footer.php'; ?>