<?php
$oldName = 'old.txt'; 
$newName = 'new.txt'; 

if (file_exists($oldName)) {

    if (rename($oldName, $newName)) {
        echo "Файл успешно переименован в $newName";
    } else {
        echo "Ошибка при переименовании файла!";
    }
} else {
    echo "Файл $oldName не найден!";
}
?>
