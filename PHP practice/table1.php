<?php


echo "<table border=1>";
for($i = 1; $i <= 6; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= 5; $j++) {
        echo "<td> $i * $j = ".$i * $j."</td>";
    }
    echo "</tr>";
}

?>

