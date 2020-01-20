<?php

$string = 'This is an demo string .';
$stringWordCount = str_word_count($string,1);
print_r($stringWordCount);

$stringWordCount = str_word_count($string,2,'.');
print_r($stringWordCount);

$string  = 'abcdefghijklmno1234568970';
$stringShuffle = str_shuffle($string);
$half = substr($stringShuffle, 0, 6);
echo "<br>". $half;

$string = 'This is an demo string';
$stringReverse = strrev($string);
echo "<br>".$stringReverse;

$stringOne = 'This is an demo string';
$stringTwo = 'This is an demo of php';
similar_text($stringOne,$stringTwo,$result);
echo "<br>".$result;

echo '<br>'.strlen($string);

?>