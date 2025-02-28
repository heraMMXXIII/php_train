<?php
if (isset($_GET['number'])) {
    $number = $_GET['number'];
    if ($number == 1) {
        echo "Привет!";
    } elseif ($number == 2) {
        echo "Пока!";
    } else {
        echo "Неверное число. Введите 1 или 2.";
    }
} else {
    echo "Число не было передано.";
}
?>
