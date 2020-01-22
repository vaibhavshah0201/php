<?php
$numbers = [10, 15, 25, 27, 1, 6];
$temp = 0;  
for($i = 0; $i < sizeof($numbers); $i++) {
    if($numbers[$i] > $temp) {
        $temp = $numbers[$i];
    }
}

echo 'Biggest Number of array: '.$temp;
?>