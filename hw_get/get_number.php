<?php
if (isset($_GET['number'])) {
    $number = $_GET['number'];
    echo "Число, переданное через GET-запрос: " . htmlspecialchars($number);
} else {
    echo "Число не было передано.";
}
?>
