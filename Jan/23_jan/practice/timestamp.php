<?php

date_default_timezone_set('Asia/kolkata');

$time = time();
$actualTime = date('D - M - Y @ H:i:s',$time);
$timeNow = date('D - M - Y @ H:i:s', strtotime('- 1 week 2 hours 30 minutes'));
echo "current date/time is : ".$actualTime;
echo '<br>'.$timeNow;

?>