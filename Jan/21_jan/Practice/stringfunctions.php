<?php

$string = 'This is an demo string';
$strLength = strlen($string);
echo $strLength.'<br>';

echo $strLower = strtolower($string).'<br>';
echo $strUpper = strtoupper($string).'<br>';

$string = 'This is an string, it is and example.';
$find = 'is';
$offset = 0;
$findLength = strlen($find);
while($strPosition = strpos($string, $find, $offset)) {
    echo $find.' found at '.$strPosition.'<br>';
    $offset = $strPosition + $findLength;
}

$string = 'This part don\'t search. This part search.';
$stringNew = substr_replace($string, 'ABC555', 29, 4);
echo $stringNew.'<br>';

$find = ['is', 'string'];
$replace = ['IS', 'STRING'];
$string = 'This is an example string.';
$newString = str_replace($find, $replace,$string);
echo $newString;
?>