<?php

$number = 5;
echo "<table>";
for($i = 0; $i <= $number; $i++) {
    echo "<br>";
    for($j = 1; $j <= $number; $j++) {
        if($i === 0 || $i === $number || $j == 1 || $j == $number) {
            echo "<td>*</td>";
        }
        else {
            echo "<td></td>";
        }
        
    }
    echo "</tr>";
}
?>