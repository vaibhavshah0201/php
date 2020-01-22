<?php

//output 1
$a = '1';
echo $b = &$a.'<br>';
echo $c = "2$b<br>";
 

// output 2
var_dump(0123 == 123);
var_dump('0123' == 123); 
var_dump('0123' === 123); 
echo "<br>";

//output 3
@$x = ture and false;
var_dump($x);

//output 4
$array = array(
    1 => "a",
    "1" => "b",
    1.5 => "c",
    true => "d",
);
print_r($array);
    
?>