<?php




function echoIpAddress() {
    global $ipAddress;
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    
    echo $ipAddress;
}

echoIpAddress();

echo $ipAddress;


$x = 75;
$y = 25; 

function addition() {
    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}

addition();
echo $z;

?>