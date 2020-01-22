<?php

$number = 10;

echo "<table>";
for($i = 0; $i < $number; $i++) {
    echo "<tr>";
    for ($j = 1; $j < $i; $j++) {
        echo "<td>*</td>";
    }
    echo "</tr>";
}

?>