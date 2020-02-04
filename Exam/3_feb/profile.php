<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
</head>
<body>
     <?php
    require_once 'Controller.php';
    $obj = new Controller();
    if(!isset($_SESSION['userId'])) {
        header("location: login.php");
    }
    $obj->prepareFetchRowProfile($_SESSION['userId']);
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Your Profile</h2>
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
                                    <input type="text" name="user[txtFirstName]" value="<?php echo $obj->getValue('user', 'userFirstName');?>" placeholder='First Name'> 
                                    <input type="text" name="user[txtLastName]" value="<?php echo $obj->getValue('user', 'userLastName');?>" placeholder='Last Name'>
                            <br><br>
                            <label>Phone Number</label> : 
                                <input type="text" name="user[txtPhone]" value="<?php echo $obj->getValue('user', 'userMobile');?>" placeholder="Phone Number"><br><br>  
                            <label> Email</label> : 
                                <input type="text" name="user[txtEmail]" value="<?php echo $obj->getValue('user', 'userEmail');?>" placeholder="Email"><br><br>
                            <label>INFORMATION : </label>
                                <textarea name="user[info]" rows="5" cols="20"><?php echo $obj->getValue('user', 'userInfo');?></textarea><br><br>
                
                </div>
        </fieldset><br>
    </div>

</form>
</body>
</html> 
