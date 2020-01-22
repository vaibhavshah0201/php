<?php

$number = 0;

for($i = 0; $i < 6; $i++) {
    echo '<br>';    
    for ($j = 0; $j < $i; $j++) {
        $number ++;
        echo $number;
    }
}

?>