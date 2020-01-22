<?php

if(isset($_POST['txtNumber']) && !empty($_POST['txtNumber'])) {
    $number = $_POST['txtNumber'];
    for($i = 1; $i <= 10; $i++) {
        echo "$number * $i = ".$number*$i.'<br>';
    }

    
}

?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <form method='POST'>
        <input type='text' name='txtNumber' placeholder='Enter number to find the table'>
        <input type='submit'>
    </form>
</body>
</html>