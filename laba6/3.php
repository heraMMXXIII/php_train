<?php
session_start(); 
if (isset($_SESSION['refresh_count'])) {
    $_SESSION['refresh_count']++;
    echo "Вы обновили страницу {$_SESSION['refresh_count']} раз(а).";
} else {
    $_SESSION['refresh_count'] = 0;
    echo "Вы ещё не обновляли страницу.";
}
?>
