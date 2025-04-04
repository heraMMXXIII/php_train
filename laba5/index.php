<?php
session_start();
require_once 'db.php';
require_once 'menu.php';
require_once 'viewer.php'; 

$section = $_GET['section'] ?? 'view';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Записная книжка</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <?= getMenu($section); ?>
    </header>
    <main>
        <?php
        switch ($section) {
            case 'add':
                require 'add.php';
                break;
            case 'edit':
                require 'edit.php';
                break;
            case 'delete':
                require 'delete.php';
                break;
            case 'view':
            default:
                echo showContacts($pdo); 
                break;
        }
        ?>
    </main>
    <footer>
        <p>&copy; <?= date('Y'); ?> Записная книжка</p>
    </footer>
</body>
</html>