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
        if($obj->setCatValues("cat")) {
            // $_SESSION['userId'] = $userId;
            // echo $_SESSION['userId'];
            echo "Data Insert Successfully.";
            header("Refresh:1; url=category.php");
        }
    }
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Add Category</h2>
        <fieldset>
                <div class='account'>
                    <label>Title : </label>
                        <input type="text" name="cat[txtTitle]" value="<?php ?>" placeholder='Enter Title'> <br><br>
                    <label>Content : </label>
                        <textarea name="cat[txtcontent]" rows="5" cols="20"><?php echo $obj->getValue('user', 'info');?></textarea><br><br>
                    <label>URL</label> : 
                        <input type="text" name="cat[txtURL]" value="<?php echo $obj->getValue('user', 'txtPhone');?>" placeholder="URL"><br><br>  
                    <label> Meta Title</label> : 
                        <input type="text" name="cat[txtMetaTitle]" value="<?php echo $obj->getValue('user', 'txtEmail');?>" placeholder="Meta title"><br><br>
                        <label> Parent Category</label> : 
                        <select name="cat[txtParentId]">
                        <?php 
                            $data = $obj->getParentCat();
                            while($row = mysqli_fetch_assoc($data)):?>                                
                                <option value="<?php echo $row['catParentId'];?>" ><?php echo $row['catParentName'];?></option>
                        <?php endwhile?>
                    </select><br><br>
                        <input type="file" name="userFile">
                </div>
        </fieldset><br>
    </div>
    <div id='btnSubmit'><br>
        <input type='submit' name='btnRegister' value='Submit'>
    </div>
</form>
</body>
</html> 
