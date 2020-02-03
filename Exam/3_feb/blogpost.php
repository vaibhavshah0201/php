<!DOCTYPE html>
<html>
<head>
    <title>Blog Post</title> 
</head>
<body>
    <h2>Blog Posts</h2>
    <a href="addBlog.php"><input type="button" value="Add Blog "></a>
    <div class="others" style="margin-left:500pt;margin-top:-55pt;">
        <a href="category.php"><input type="button" value="Manage Category"></a>
        <a href="profile.php"><input type="button" value="My Profile"></a>
        <a href="logout.php"><input type="button" value="Logout"></a>
    </div>
    <?php
        require_once 'Controller.php';
        $obj = new Controller();
        
        if(isset($_GET['deleteId'])) {
            $deleteId = $_GET['deleteId'];
            if($obj->deleteCat($deleteId)) {
                echo "Data deleted Successfully";
                header("Refresh: 1.5; url=category.php");
            }
         }

      $data = $obj->prepareFetchAllCat(); 
    if(!mysqli_num_rows($data) > 0):
        echo "No record found";
    else:?>
    <br><br><br><br>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Category Name</th>
            <th>Created Date</th>
            <th colspan=2>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($data)) :?>
        <tr>
            <td><?php echo $row['catId'];?></td>
            <td><image src="" alr="img.jpg"></td>
            <td><?php echo $row['catTitle'];?></td>
            <td><?php echo $row['createdAt'];?></td>
            <td><a href="updateCat.php?catId=<?php echo $row['catId'];?>"><button> Update</button></a></td>
            <td><a href="category.php?deleteId=<?php echo $row['catId'];?>"><button> Delete</button></a></td>
        </tr>
        <?php
        endwhile;
        endif;?>
    </table>   
</body>
</html>