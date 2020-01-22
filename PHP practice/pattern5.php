<?php

$number = 10;

echo "<table border=1>";
for($i = 0; $i < $number; $i++) {
    echo "<tr>";
    if($i % 2 == 0) {
        for ($j = 1; $j < $number; $j++) {
            if($j % 2 == 0) {
                echo "<td bgcolor='black'></td>";
            }
            else {
                echo "<td bgcolor='white'></td>";
            }
    
        }
    } else {
        for ($j = 1; $j < $number; $j++) {
            if($j % 2 != 0) {
                echo "<td bgcolor='black'></td>";
            }
            else {
                echo "<td bgcolor='white'></td>";
            }
    
        }
    }
    
    echo "</tr>";
}

?>