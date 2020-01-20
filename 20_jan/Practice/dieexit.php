<?php

echo "Hello";
    // exit();
echo " world";

for( $index = 0; $index < 5; $index ++){
    if($index == 3){
        // exit();
    }
    else {
        echo $index;
    }
}

$filename = '/path/to/data-file';
@$file = fopen($filename, 'r')
    or exit("unable to open file ($filename)");

@mysqli_connect("root","roos    r") or die("Could'n connect to the database");





?>