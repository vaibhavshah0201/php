<?php
if(isset($_FILES['userFile'])) {
    if(!empty($_FILES['userFile'])) {
        $name = $_FILES['userFile']['name'];
        $size = $_FILES['userFile']['size'];
        $type = $_FILES['userFile']['type'];
        $tmp_name = $_FILES['userFile']['tmp_name'];
        $uploadPath = 'uploads/';
        $extension = strtolower(substr($name,strpos($name,'.')+1));
        if(($extension === 'jpeg' || $extension === 'png') && ($type === 'image/png' || $type === 'image/jpeg')) {
                if($size < 3526840) {
                    if(move_uploaded_file($tmp_name,$uploadPath.$name)) {
                        echo "File Uploaded";
                    } else {
                        echo "Something want wrong";
                    } 
                } else {
                    echo "Please select file upto 2 Mb";
                }
        } else {
            echo "Please select only image file";
        }
    } else {
        echo "Please Select the file";
    }
}


?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <form method='POST' action="fileupload.php" enctype="multipart/form-data">
        <input type='file' name='userFile'><br><br>
        <input type='submit' value='Upload'>
    </form>
</body>
</html>
