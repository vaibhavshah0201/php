<?php
$numbers = [10, 15, 25, 27, 1, 6];
$temp = $numbers[0];  
for($i = 0; $i < sizeof($numbers); $i++) {
    if($numbers[$i] < $temp) {
        $temp = $numbers[$i];
    }
}

echo 'Smallest Number of array: '.$temp;
?>