<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laba2</title>
</head>
<body>
<p>1 задание</p>
<?php 
$array = ['a', 'b', 'c', 'b', 'a'];
print_r(array_count_values($array));
?>
<p>5 задание</p>
<?php
$arr = ['a' => 1, 'b' => 2, 'c' => 3];

$keys = array_keys($arr);

$values = array_values($arr);

print_r($keys);
print_r($values);
?>
<p>10 задание</p>
<?php 
$arr = ['a' => 1, 'b' => 2, 'c' => 3];
echo array_rand($arr)
?>
<p>15 задание</p>
<?php
$arr = [1, 2, 3, 4, 5];

// Добавляем элемент 0 в начало
array_unshift($arr, 0);

// Добавляем элемент 6 в конец
array_push($arr, 6);

// Выводим результат
print_r($arr);
?>

</body>
</html>