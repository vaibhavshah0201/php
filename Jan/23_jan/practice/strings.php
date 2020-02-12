<?php
$userInput = '';
$find = ['alex', 'billy', 'john'];
$replace = ['a**x', 'b**y', 'j**n'];
if(isset($_POST['txtUserInput']) && !empty($_POST['txtUserInput'])) {
    $userInput = $_POST['txtUserInput'];
    $userReplacedValue = str_ireplace($find, $replace, $userInput);
    echo $userReplacedValue;
    
}
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <form method='POST'>
        <textarea name='txtUserInput' rows='6' cols='30' ><?php echo $userInput;?></textarea><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html> 