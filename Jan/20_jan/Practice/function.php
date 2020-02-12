<?php

function writeMsg(): string {
    return "Hello world!<br>";

}

echo writeMsg();


function sum(int $x, int $y): int {
    $z = $x + $y;
    return $z;
}

echo sum(5, 10) . "<br>";
echo sum(7, 13) . "<br>";
echo sum(2, 4);

?>
