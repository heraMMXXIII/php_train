<?php
$file = 'test2.txt'; 


if (file_exists($file)) {
    $number = file_get_contents($file);
    

    if (is_numeric($number)) {
        $square = $number ** 2; 
        

        file_put_contents($file, $square);
        
        echo "Число $number возведено в квадрат: $square";
    } else {
        echo "Ошибка: в файле не число!";
    }
} else {
    echo "Ошибка: файл test.txt не найден!";
}
?>
