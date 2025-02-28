<?php
if (isset($_GET['number1']) && isset($_GET['number2'])) {
    // Получаем числа
    $number1 = $_GET['number1'];
    $number2 = $_GET['number2'];
    
    // Проверяем, являются ли оба значения числами
    if (is_numeric($number1) && is_numeric($number2)) {
        $sum = $number1 + $number2;
        echo "Сумма чисел: " . $sum;
    } else {
        echo "Пожалуйста, введите два числа.";
    }
} else {
    echo "Числа не были переданы.";
}
?>
