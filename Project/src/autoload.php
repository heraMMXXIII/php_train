<?php
spl_autoload_register(function ($className) {
    // Нормализуем имя класса
    $className = ltrim($className, '\\');
    
    // Преобразуем неймспейс в путь
    $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    
    // Проверяем существование файла (регистронезависимо для Windows)
    if (!file_exists($file)) {
        $file = findFileCaseInsensitive($file);
    }
    
    if ($file && file_exists($file)) {
        require $file;
    } else {
        throw new \RuntimeException("Class {$className} not found in: " . __DIR__);
    }
});

/**
 * Поиск файла без учета регистра (для Windows)
 */
function findFileCaseInsensitive($filepath) {
    if (file_exists($filepath)) return $filepath;
    
    $dirname = dirname($filepath);
    $filename = basename($filepath);
    
    if (!is_dir($dirname)) return false;
    
    foreach (scandir($dirname) as $file) {
        if (strtolower($file) === strtolower($filename)) {
            return $dirname . DIRECTORY_SEPARATOR . $file;
        }
    }
    return false;
}