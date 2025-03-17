<?php
echo "задание 2";
$file = 'test.txt'; 
$text = '12345';

// Запись в файл
file_put_contents($file, $text);

echo "Данные записаны в $file";
?>

