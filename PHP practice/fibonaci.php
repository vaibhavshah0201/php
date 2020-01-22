<?php

$temp = 0;
$number1 = 0;
$number2 = 1;
for ( $index = 0; $index < 10; $index ++) {
    echo $temp.'<br>';
    $temp = $number1 + $number2;   
    $number1 = $number2;
    $number2 = $temp;
}
