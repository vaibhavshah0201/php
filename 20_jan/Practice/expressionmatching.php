<?php

$string = "This is an demo string";

if (preg_match('/^[a-zA-Z]{0,5}/', $string)) {
    echo "match Found";
} else {
    echo "not found";
}

$number = "12345678900";

if (preg_match('/[0-9]{10}/', $number)) {
    echo "match Found";
} else {
    echo "not found";
}
?>
