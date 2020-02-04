<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add new blog</title>
</head>
<body>
     <?php
    require_once 'Controller.php';
    $obj = new Controller();
    $userId = $_SESSION['userId'];
    if(isset($_POST['btnRegister'])) {
        if($obj->setBlogValues("blog",$userId)) {
            echo "Data Insert Successfully.";
            header("Refresh:1; url=blogpost.php");
        }
    }
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Add Blog</h2>
        <fieldset>
                <div class='account'>
                    <label>Title : </label>
                        <input type="text" name="blog[txtTitle]" value="<?php ?>" placeholder='Enter Title'> <br><br>
                    <label>Content : </label>
                        <textarea name="blog[txtcontent]" rows="5" cols="20"><?php echo $obj->getValue('user', 'info');?></textarea><br><br>
                    <label>URL</label> : 
                        <input type="text" name="blog[txtURL]" value="<?php echo $obj->getValue('user', 'txtPhone');?>" placeholder="URL"><br><br>  
                    <label>Published At</label> : 
                        <input type="date" name="blog[dtPublish]" value="<?php echo $obj->getValue('user', 'txtPhone');?>" placeholder="URL"><br><br>      
                    
                        <label>Category</label> : 
                        <select name="blog[txtParentId][]" multiple>
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
