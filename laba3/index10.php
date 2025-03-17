<?php
$file = '10mb-example-jpg.jpg'; 

if (file_exists($file)) {
    $size = filesize($file);
    $sizeMB = $size / 1024 / 1024;
    echo "Размер файла $file: " . round($sizeMB, 2) . " MB";
} else {
    echo "Файл $file не найден!";
}
?>