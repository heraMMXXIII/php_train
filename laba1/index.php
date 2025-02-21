<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laba1</title>
</head>
<body>
    <p>1 задание</p>
    <?php 
    $a = 27;
    $b = 12; 
    $c = sqrt($a*$a+$b*$b);
    echo round($c, 2);
    ?>
        <p>6 задание</p>
        <?php
$a = 2;
$b = 2.0;
$c = '2';
$d = 'two';
$g = true;
$f = false;
echo(($a - $a) ); 
echo(($b - $b) );  
echo(($c - $c) );  
echo(($g - $g) );  
echo(($f + $f) );  
echo(($g * $g) );   
echo(($g / $g) );   
echo(($a / $a) );  
echo(($b / $b) );   
echo(($c / $c) );    
echo(($f * $a) ); 
echo(($f * $b) ); 
echo(($f * $c) );  
echo(($f / $a) ); 
echo(($f / $b) ); 
echo(($f / $c) );  
echo(($g + $f) );  
echo(($g - $f) );  
?>
<p>11 задание</p>
<?php
$quieter = 'Тише'; $go = 'едешь'; $further = 'дальше';
echo("{$quieter} {$go}, {$further}");
?>

<p>16 задание</p>
<?php 
$not_take_risks = 'Кто не рискует '; $not_drink = 'не пьет '; $ellipsis = '...';
$full = $not_take_risks . $not_drink . $ellipsis;
echo $full;
?>
<p>21 задание</p>

<?php
$a = 5.7;
$b = 8.3;
$c = '5.6';
$d = '9.2кг';

echo "Пол (floor):\n";
echo "a: " . floor($a) . "\n"; 
echo "b: " . floor($b) . "\n"; 
echo "c: " . floor((float)$c) . "\n"; 
echo "d: " . floor((float)$d) . "\n"; 

echo "Потолок (ceil):\n";
echo "a: " . ceil($a) . "\n";
echo "b: " . ceil($b) . "\n";
echo "c: " . ceil((float)$c) . "\n";
echo "d: " . ceil((float)$d) . "\n";

echo "Арифметическое округление (round):\n";
echo "a: " . round($a) . "\n"; 
echo "b: " . round($b) . "\n"; 
echo "c: " . round((float)$c) . "\n"; 
echo "d: " . round((float)$d) . "\n"; 

?>
</body>
</html>