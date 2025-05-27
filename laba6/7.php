<?php

if (!isset($_COOKIE['test'])) {
    setcookie('test', '123', time() + 100);
    echo "Кука 'test' установлена. Обновите страницу.";
} else {
    echo "Значение куки 'test': " . htmlspecialchars($_COOKIE['test']);
}
?>
