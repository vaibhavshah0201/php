<!DOCTYPE html>
<html>
<head>
    <title>List of customer</title> 
</head>
<body>
    <?php 
     require_once 'Registration.php';
     $obj = new Registration();
    $data = $obj->prepareFetchAll(); 
        if(!mysqli_num_rows($data) > 0):
            echo "No record found";
        else:?>
        
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Company</th>
            <th>Hobbies</th>
            <th>Get In</th>
        </tr>
        <?php foreach($data as $row) :?>
        <tr>
            <td><?php echo $row['customerId'];?></td>
            <td><?php echo $row['customerFirstName']." ".$row['customerLastName'];?></td>
            <td><?php echo $row['custAddCompany'];?></td>
            <td><?php echo $row['hobbie'];?></td>
            <td><?php echo $row['getTouch'];?></td>
            <td><a href="updateCustomer.php?custId=<?php echo $row['customerId'];?>"><button> Update</button></a></td>
        </tr>
        <?php
        endforeach;
        endif;?>
    </table>    
</body>
</html>