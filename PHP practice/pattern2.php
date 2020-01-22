<?php

$number = 10;
echo "<table>";
for($i = $number; $i > 1; $i--) {
    echo "<tr>";
    for ($j = 1; $j < $i; $j++) {
        echo "<td>*</td>";
    }
    echo "</tr>";
}

?>