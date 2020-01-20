<?php
// ini_set('error_reporting','0');
echo '<input type="text" value="Hello" >';
echo "<input type=\"text\" value=\"Hello\" >";  
$value = "Hello World";
?>

<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <input type="text" value="<?php echo $value;?>">
    </body>
</html>
