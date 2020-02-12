<!DOCTYPE html>
<html>
<head><title>Calender</title></head>
<body>
    <?php
        require_once "Cal.inc.php";

        $cal = new Calender();
        $sessionData = $cal->getSessionData();
    ?>
    <form method='POST' action="calender.php">
        Enter Month : <br>
        <input type='text' value="<?php echo $sessionData['setMonth'];?>" name='txtMonth'><br><br>
        Enter Year : <br>
        <input type='text' value="<?php echo $sessionData['setYear'];?>" name='txtYear'><br><br>
        <input type='submit' value='Get Calender' name='btnSubmit'>
    </form>

    <?php
        if (isset($_POST['txtMonth']) && isset($_POST['txtYear'])) {
            if(!empty($_POST['txtMonth']) && !empty($_POST['txtYear'])) {
                $userMonth = $_POST['txtMonth'];
                $userYear = $_POST['txtYear'];
                $valid = $cal->validate($userMonth,$userYear);
                if($valid) {
                    $cal->getCalender($userMonth,$userYear);
                    $cal->setSessionData($userMonth,$userYear);
                    $sessionData = $cal->getSessionData();
                } else {
                    echo "Please enter valid month or year";
                }
            } else {
                echo 'Please fill all the details.';
            }
        } 
    ?>


</body> 
</html>