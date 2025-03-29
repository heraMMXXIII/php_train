<?php

$input1 = "waaa baaa xaaa yaaa";
$output1 = preg_replace('/([^b])aaa/', '$1!', $input1);
echo "1) $output1\n"; 


$input2 = "a1b2c3";
$output2 = preg_replace('/(\d)/', '$1$1', $input2);
echo "2) $output2\n"; 


$input3 = "aa aba abba abbba abbbba abbbbba";
preg_match_all('/ab{1,3}a/', $input3, $matches3);
echo "3) " . implode(" ", $matches3[0]) . "\n"; 


$input4 = "aba aca aea abba adca abea";
preg_match_all('/a..a/', $input4, $matches4);
echo "4) " . implode(" ", $matches4[0]) . "\n"; 
?>
