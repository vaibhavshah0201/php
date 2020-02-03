<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
</head>
<body>
     <?php
    require_once 'Controller.php';
    $obj = new Controller();
    if(isset($_POST['btnRegister'])) {
    //     $obj->setSessionValue('account');
    //     $obj->setSessionValue('address');
    //     $obj->setSessionValue('otherInfo');
        if($userId = $obj->setUserValues("user")) {
            $_SESSION['userId'] = $userId;
            echo $_SESSION['userId'];
            echo "Data Insert Successfully.";
            header("Refresh:1; url=blogpost.php");
        }
    }
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Registration Form</h2>
        <fieldset>
            <legend>YOUR ACCOUNT DETAILS</legend><br>
                <div class='account'>
                        <label>Full Name : </label>
                            <select name="user[prefix]">
                                <?php 
                                    $prefix = ['Mr', 'Miss', 'Ms', 'Mrs'];
                                    foreach($prefix as $value):
                                        $select = $value == $obj->getValue('user','prefix') ? "selected" : ""; ?>                            
                                        <option value="<?php echo $value;?>" <?php echo $select;?>><?php echo $value;?></option>
                                <?php endforeach?>
                            </select>
                                    <input type="text" name="user[txtFirstName]" value="<?php ?>" placeholder='First Name'> 
                                    <input type="text" name="user[txtLastName]" value="<?php ?>" placeholder='Last Name'>
                            <br><br>
                            <label>Phone Number</label> : 
                                <input type="text" name="user[txtPhone]" value="<?php echo $obj->getValue('user', 'txtPhone');?>" placeholder="Phone Number"><br><br>  
                            <label> Email</label> : 
                                <input type="text" name="user[txtEmail]" value="<?php echo $obj->getValue('user', 'txtEmail');?>" placeholder="Email"><br><br>
                            <label>Password </label>: 
                                <input type="password" name="user[txtPassword]" placeholder="Password"><br><br>   
                            <label>Confirm Password </label> 
                                <input type="password" name="user[txtConfirmPassword]" placeholder="Confirm Password"><br><br>
                            <label>INFORMATION : </label>
                                <textarea name="user[info]" rows="5" cols="20"><?php echo $obj->getValue('user', 'info');?></textarea><br><br>
                            <input type="checkbox" name="checkTerm">I Accept Terms & Condition.
                </div>
        </fieldset><br>
    </div>
    <div id='btnSubmit'><br>
        <input type='submit' name='btnRegister' value='Register'>
        <input type='reset' name="reset" value='Reset'><br><br><br>        
    </div>
</form>
</body>
</html> 
