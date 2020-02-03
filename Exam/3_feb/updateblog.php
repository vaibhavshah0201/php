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
    $obj->prepareFetchRowBlog($blogId);
    
    if(isset($_POST['btnUpdate'])) {
        if($obj->updateBlogValues("blog", $blogId) > 0) {
            echo "Data Updated Successfully.";
            header("Refresh:2; url=blogpost.php");
        }
    }
    
?> 
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Add Blog</h2>
        <fieldset>
                <div class='account'>
                    <label>Title : </label>
                        <input type="text" name="blog[txtTitle]" value="<?php echo $obj->getValue('blog', 'blogTitle');?>" placeholder='Enter Title'> <br><br>
                    <label>Content : </label>
                        <textarea name="blog[txtcontent]" rows="5" cols="20"><?php echo $obj->getValue('blog', 'blogContent');?></textarea><br><br>
                    <label>URL</label> : 
                        <input type="text" name="blog[txtURL]" value="<?php echo $obj->getValue('blog', 'blogUrl');?>" placeholder="URL"><br><br>  
                    <label>Published At</label> : 
                        <input type="date" name="blog[dtPublish]" value="<?php echo $obj->getValue('blog', 'blogPublishAt');?>" placeholder="URL"><br><br>      
                    
                        <label>Category</label> : 
                        <select name="blog[txtParentId][]" multiple>
                        <?php 
                            $data = $obj->getParentCat();
                            while($row = mysqli_fetch_assoc($data)):
                                $selected = $value == in_array($value, $obj->getValue('blog', 'catParentId', [])) ? "selected" : "";?>                             ?>                                
                                <option value="<?php echo $row['catParentId'];?>" <?php echo $selected;?>><?php echo $row['catParentName'];?></option>
                        <?php endwhile?>
                    </select><br><br>
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
