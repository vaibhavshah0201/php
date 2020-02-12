<?php

$scriptName = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <form action="<?php echo $scriptName;?>" method='POST'>
        <input type='submit' name='submit'>
    </form>
</body>
</html>