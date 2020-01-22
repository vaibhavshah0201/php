<?php

for($i = 0; $i < 10; $i++) {
    echo '<br>';
    for ($j = 1; $j < $i; $j++) {
        echo '*';
    }

    for ($j = 1; $j < $i; $j++) {
        echo '0 ';
    }
}

?>