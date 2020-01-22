<?php

$number = 10;
echo "<table border=1>";
for($i = 1; $i <= $number; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= $number; $j++) {
        echo "<td> ".$i * $j."</td>";
    }
    echo "</tr>";
}

?>

