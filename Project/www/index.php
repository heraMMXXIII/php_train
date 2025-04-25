<?php

spl_autoload_register(function(string $className) { // автозагрузка классов 
    $filePath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php'; // приписывает в конец ".php"
    $fullPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . $filePath;

    if (file_exists($fullPath)) {
        require_once $fullPath;
    } else {
        throw new Exception("{$fullPath}");
    }
});


$findRoute = false;
$route = $_GET['route'] ?? ''; // здесь получаем текущий маршрут нн

$patterns = require 'route.php'; //подключение шаблонов 
foreach ($patterns as $pattern => $controllerAndAction) { //перебор шаблонов
    preg_match($pattern, $route, $matches); // проверка на совпадение регулярки с URL
    if (!empty($matches)) { // если есть совпадение...
        $findRoute = true;
        unset($matches[0]); // полное совпадение
        $controllerClass = $controllerAndAction[0]; 
        $action = $controllerAndAction[1];  
        $controller = new $controllerClass(); // создание объекта 
        $controller->$action(...$matches); // для show(int $id) бдует передаваться только id
        break;
    }
}
if (!$findRoute) echo "Page not found (404)"; // обрабатывает ошибки маршрутизации 