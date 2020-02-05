<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update blog</title>
</head>
<body>
     <?php
    $blogId = $_GET['blogId'];
    require_once 'Controller.php';
    $obj = new Controller();
   
    if(!isset($_SESSION['userId'])) {
        header("location: login.php");
    }
    
    if(!$data = $obj->prepareFetchRowBlog($blogId)) {
        echo "NO result Found";
    }

    if(isset($_POST['btnUpdate'])) {
        if($obj->updateBlogValues("blog", $blogId) > 0) {
            echo "Data Updated Successfully.";
            header("Refresh:2; url=blogpost.php");
        }
    }
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Update Blog</h2>
        <fieldset>
                <div class='account' style="white-space: pre; margin-left:-60px;">
                    <label>Title : </label>
                    <input type="text" name="blog[txtTitle]" value="<?php echo $data['blogTitle'];?>" placeholder='Enter Title'> 

                    <label>Content : </label>
                    <textarea name="blog[txtcontent]" rows="5" cols="20"><?php echo $data['blogContent'];?></textarea>
                    
                    <label>URL</label> : 
                    <input type="text" name="blog[txtURL]" value="<?php echo $data['blogUrl'];?>" placeholder="URL">
                    
                    <label>Published At</label> : 
                    <input type="date" name="blog[dtPublish]" value="<?php echo $data['blogPublishAt'];?>" placeholder="URL">     
                    
                    <label>Category</label> : 
                    <select name="blog[txtParentId][]" multiple>
                    <?php 
                        $dataa = $obj->getParentCat();
                        while($row = mysqli_fetch_assoc($dataa)):
                            $selected = $value == in_array($row['catParentId'], $data['catParentId'], []) ? "selected" : "";?>                             ?>                                
                            <option value="<?php echo $row['catParentId'];?>" <?php echo $selected;?>><?php echo $row['catParentName'];?></option>
                    <?php endwhile?>
                    </select>

                    <input type="file" name="blog[image]">
                </div>
        </fieldset><br>
    </div>
    <div id='btnSubmit'><br>
        <input type='submit' name='btnUpdate' value='Submit'>
    </div>
</form>
</body>
</html> 
