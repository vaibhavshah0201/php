<?php
//Basic arrays
echo "<pre>";
$food = array('Pasta', 'Pizza', 'Salad');
print_r($food);
$food [5] = 'Vegetable';
print_r($food);

$array = array(1, 1, 1, 1,  1, 8 => 1,  4 => 1, 19, 3 => 13);
print_r($array);

$a = [1, 2, 3, 4];
print_r($a);

//associative array

$age = array("-1" => "abc", "Peter" => "35", "Ben" => "37", "Joe" => "43");

print_r($age);

//multidimension array

$food = array('Healthy' => 
                        array('Salad', 'Pasta', 'Vegetables'), 
              'Unhealthy' =>
                        array('Pizza', 'Ice-cream'));
foreach($food as $types => $innerItems) {
    echo "<strong>$types</strong><br>";
    foreach ($innerItems as $data) {
        echo $data."<br>";
    }
}
            

?>