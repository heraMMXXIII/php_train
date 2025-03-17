<?php
echo "task3";
$files = ['1.txt', '2.txt', '3.txt']; 
$mergedContent = ''; 

foreach ($files as $file) {
    if (file_exists($file)) {
        $mergedContent .= file_get_contents($file) . PHP_EOL; 
    } else {
        echo "Файл $file не найден!<br>";
    }
}

file_put_contents('new.txt', $mergedContent);

echo "Файл new.txt успешно создан!";
?>
