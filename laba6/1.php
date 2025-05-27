<?php
session_start();

if (!isset($_SESSION['value'])) {
    $_SESSION['value'] = 'test';
    echo "В сессию записано значение 'test'. Обновите страницу.";
} else {
    echo "Значение в сессии: " . $_SESSION['value'];
}
?>