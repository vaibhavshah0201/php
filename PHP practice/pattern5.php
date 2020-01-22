<?php


echo "<table border=1>";
for($i = 0; $i < 10; $i++) {
    echo "<tr>";
    if($i % 2 == 0) {
        for ($j = 1; $j < 10; $j++) {
            if($j % 2 == 0) {
                echo "<td bgcolor='black'></td>";
            }
            else {
                echo "<td bgcolor='white'></td>";
            }
    
        }
    } else {
        for ($j = 1; $j < 10; $j++) {
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