<?php


for($i = 0; $i <= 5; $i++) {
    echo "<br>";
    for($j = 1; $j <= 5; $j++) {
        if($i === 0 || $i === 5 || $j == 1 || $j == 5) {
            echo "*";
        }
        else {
            echo "&nbsp;&nbsp;";
        }
        
    }
}
?>