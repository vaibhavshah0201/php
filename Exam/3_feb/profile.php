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
    
    if(!$data = $obj->prepareFetchRow('user', $_SESSION['userId'])) {
        echo "NO result Found";
    }

    if(isset($_POST['btnUpdate'])) {
        if($obj->updateProfileValues("blog", $_SESSION['userId']) > 0) {
            echo "Data Updated Successfully.";
            header("Refresh:2; url=blogpost.php");
        }
    }
    
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
                                        $select = $value == $data['prefix'] ? "selected" : ""; ?>                            
                                        <option value="<?php echo $value;?>" <?php echo $select;?>><?php echo $value;?></option>
                                <?php endforeach?>
                            </select>
                                    <input type="text" name="user[txtFirstName]" value="<?php echo $data['userFirstName'];?>" placeholder='First Name'> 
                                    <input type="text" name="user[txtLastName]" value="<?php echo $data['userLastName'];?>" placeholder='Last Name'>
                            <br><br>
                            <label>Phone Number</label> : 
                                <input type="text" name="user[txtPhone]" value="<?php echo $data['userMobile'];?>" placeholder="Phone Number"><br><br>  
                            <label> Email</label> : 
                                <input type="text" name="user[txtEmail]" value="<?php echo $data['userEmail'];?>" placeholder="Email"><br><br>
                            <label>INFORMATION : </label>
                                <textarea name="user[info]" rows="5" cols="20"><?php echo $data['userInfo'];?></textarea><br><br>
                
                </div>
        </fieldset><br>
    </div>

</form>
</body>
</html> 
