<?php  ob_start(); ?>
<h1>my page</h1>
hellosdaf
<?php
echo "asdf";
$redirectPage = 'http://google.com';
$redirect = false;

if($redirect) {
    header ('Location: '.$redirectPage);
}

ob_end_flush();
?>