<?php
$userInput = '';
$offset = 0;
if(isset($_POST['txtUserInput']) && isset($_POST['txtReplace']) && isset($_POST['txtFind'])) {
    echo "sadf";
    $userInput = $_POST['txtUserInput'];
    $find = $_POST['txtFind'];
    $replace = $_POST['txtReplace'];
    $findLength = strlen($find);
    if(!empty($userInput) && !empty($find) && !empty($replace)) {
        
        while ($strPos = strpos($userInput, $find, $offset)) {
            $offset = $strPos + $findLength;
            $userInput = substr_replace($userInput, $replace, $strPos, $findLength);
        }
        // echo $userInput;
    } else {
        echo "Please fill all the details";
    }

}

?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <form method='POST' action='findReplace.php'>
        <textarea name='txtUserInput' rows='6' cols='30' ><?php echo $userInput;?></textarea><br><br>
        Search for : <br>
        <input type='text' name='txtFind'><br><br>
        Replace with : <br> 
        <input type='text' name='txtReplace'><br><br>
        <input type="submit" value="Fin and replace">
    </form>
</body>
</html> 