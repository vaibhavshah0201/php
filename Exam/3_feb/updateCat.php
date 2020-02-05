<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
</head>
<body>
     <?php
   $catId = $_GET['catId'];
   require_once 'Controller.php';
    $obj = new Controller();
    if(!isset($_SESSION['userId'])) {
        header("location: login.php");
    }
    if(!$data = $obj->prepareFetchRow($catId)) {
        echo "NO result Found";
    }
   
   if(isset($_POST['btnUpdate'])) {
       if($obj->updateCatValues("cat", $catId) > 0) {
           echo "Data Updated Successfully.";
           header("Refresh:2; url=category.php");
       }
   }
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Update Category</h2>
        <fieldset>
                <div class='account'>
                    <label>Title : </label>
                        <input type="text" name="cat[txtTitle]" value="<?php  echo $data['catTitle']; ?>" placeholder='Enter Title'> <br><br>
                    <label>Content : </label>
                        <textarea name="cat[txtcontent]" rows="5" cols="20"><?php echo $data['catContent'];?></textarea><br><br>
                    <label>URL</label> : 
                        <input type="text" name="cat[txtURL]" value="<?php echo $data['catUrl'];?>" placeholder="URL"><br><br>  
                    <label> Meta Title</label> :                            
                        <input type="text" name="cat[txtMetaTitle]" value="<?php echo $data['catMetaTitle'];?>" placeholder="Meta title"><br><br>
                        <label> Parent Category</label> : 
                        <select name="cat[txtParentId]">
                        <?php 
                            $dataa = $obj->getParentCat();
                            while($row = mysqli_fetch_assoc($dataa)):
                            $select = $row['catParentId'] == $data['catParentId'] ? "selected" : ""; ?>                                                          
                                <option value="<?php echo $row['catParentId'];?>" <?php echo $select;?>><?php echo $row['catParentName'];?></option>
                        <?php endwhile?>
                    </select><br><br>
                        <input type="file" name="userFile">
                </div>
        </fieldset><br>
    </div>
    <div id='btnSubmit'><br>
        <input type='submit' name='btnUpdate' value='Update'>
    </div>
</form>
</body>
</html> 
