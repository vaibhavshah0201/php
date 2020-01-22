<?php

$number = 0;
$num = 6;
echo "<table>";
for($i = 0; $i < $num; $i++) {
    echo "<tr>";    
    for ($j = 0; $j < $i; $j++) {
        $number ++;
        echo "<td>$number</td>";
    }
    echo "</td>";
}

?>