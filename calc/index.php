<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['expression'])) {
    $expression = $_POST['expression'];
    if (isValidExpression($expression)) {
        try {
            $result = evaluateExpression($expression);
            echo $result;
        } catch (Exception $e) {
            echo "Ошибка: некорректное выражение";
        }
    } else {
        echo "Ошибка: некорректное выражение";
    }
} else {
    echo "Ошибка: отсутствует выражение";
}

// Функция для проверки корректности выражения
function isValidExpression($expression) {
    // Разрешаем только цифры, операторы и скобки
    return preg_match('/^[0-9+\-*/(). ]+$/', $expression);
}

// Основная функция для вычисления выражения
function evaluateExpression($expression) {
    // Убираем все пробелы
    $expression = str_replace(' ', '', $expression);
    
    // Сначала обрабатываем скобки
    while (preg_match('/\(([^()]+)\)/', $expression, $match)) {
        $subResult = calculate($match[1]);
        $expression = str_replace($match[0], $subResult, $expression);
    }

    // Теперь вычисляем результат без скобок
    return calculate($expression);
}

// Функция для выполнения вычислений
function calculate($expr) {
    // Выполняем умножение и деление
    while (preg_match('/(-?\d+)\s*([*/])\s*(-?\d+)/', $expr, $match)) {
        $result = $match[2] === '*' ? $match[1] * $match[3] : $match[1] / $match[3];
        $expr = str_replace($match[0], $result, $expr);
    }

    // Выполняем сложение и вычитание
    while (preg_match('/(-?\d+)\s*([+-])\s*(-?\d+)/', $expr, $match)) {
        $result = $match[2] === '+' ? $match[1] + $match[3] : $match[1] - $match[3];
        $expr = str_replace($match[0], $result, $expr);
    }

    return $expr;  // Возвращаем финальный результат
}
?>
