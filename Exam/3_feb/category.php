<!DOCTYPE html>
<html>
<head>
    <title>Blog Post</title> 
</head>
<body>
    <h2>Blog Category</h2>
    <a href="addCategory.php"><input type="button" value="Add Blog Category"></a>
    <div class="others" style="margin-left:500pt;margin-top:-55pt;">
        <a href="blogpost.php"><input type="button" value="Manage Blog"></a>
        <a href="profile.php"><input type="button" value="My Profile"></a>
        <a href="logout.php"><input type="button" value="Logout"></a>
    </div>
    <?php
        
        
        require_once 'Controller.php';
        $obj = new Controller();
        if(!isset($_SESSION['userId'])) {
            header("location: login.php");
        }
        if(isset($_GET['deleteId'])) {
            $deleteId = $_GET['deleteId'];
            if($obj->prepareDelete('category', $deleteId)) {
                echo "Data deleted Successfully";
                header("Refresh: 1.5; url=category.php");
            }
         }

      $data = $obj->prepareFetchAll('category'); 
    if(!mysqli_num_rows($data) > 0):
        echo "No record found";
    else:?>
    <br><br><br><br>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Category Name</th>
            <th>Category Title</th>
            <th>Created Date</th>
            <th colspan=2>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($data)) :?>
        <tr>
            <td><?php echo $row['catId'];?></td>
            <td><image height="100px" width="100px" src="uploads/<?php echo $row['catImage'];?>" alr="img.jpg"></td>
            <td><?php echo $row['catParentName'];?></td>
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