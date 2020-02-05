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
         //     $obj->setSessionValue('account');
         //     $obj->setSessionValue('address');
         //     $obj->setSessionValue('otherInfo');
             if($userId = $obj->setUserValues("user")) {
                 $_SESSION['userId'] = $userId;
                 echo $_SESSION['userId'];
                 echo "Data Insert Successfully.";
                 header("Refresh:1; url=blogpost.php");
             }
         }
         
         ?>
      <form name='registerData' method="POST" enctype="multipart/form-data">
         <h2>Registration Form</h2>
         <fieldset>
            <legend>YOUR ACCOUNT DETAILS</legend>
            <div class='account'>
               <table>
               <tr>
                  <td>
                     <label>Full Name : </label>
                  </td>
                  <td>
                     <select name="user[prefix]">
                        <?php 
                           $prefix = ['Mr', 'Miss', 'Ms', 'Mrs'];
                           foreach($prefix as $value):
                               $select = $value == $obj->getValue('user','prefix') ? "selected" : ""; ?>
                        <option value="<?php echo $value;?>" <?php echo $select;?>>
                           <?php echo $value;?>
                        </option>
                        <?php endforeach?>
                     </select>
                     <input type="text" name="user[txtFirstName]" value="<?php ?>" placeholder='First Name'>
                     <input type="text" name="user[txtLastName]" value="<?php ?>" placeholder='Last Name'>
                  </td>
               </tr>
               <tr>
                  <td>
                     <label>Phone Number</label> : 
                  </td>
                  <td>
                     <input type="text" name="user[txtPhone]" value="<?php echo $obj->getValue('user', 'txtPhone');?>" placeholder="Phone Number"> 
                  </td>
               </tr>
               <tr>
                  <td>
                    <label> Email</label> :
                  </td>
                  <td>
                  <input type="text" name="user[txtEmail]" value="<?php echo $obj->getValue('user', 'txtEmail');?>" placeholder="Email">
                  </td>
               </tr>
               <tr>
                  <td>
                     <label>Password </label>:
                  </td>
                  <td>
                  <input type="password" name="user[txtPassword]" placeholder="Password">
                  </td>
               </tr>
               <tr>
                  <td>
                    <label>Confirm Password </label>  
                  </td>
                  <td>
                    <input type="password" name="user[txtConfirmPassword]" placeholder="Confirm Password">
                  </td>
               </tr>
               <tr>
                  <td>
                    <label>INFORMATION : </label> 
                  </td>
                  <td>
                    <textarea name="user[info]" rows="5" cols="20">
                                <?php echo $obj->getValue('user', 'info');?>
                            </textarea>
                  </td>
               </tr>
               <tr>
                  <td colspan=2>
                  <input type="checkbox" name="checkTerm">I Accept Terms & Condition.
                  </td>
               </tr>
               <tr>
                  <td colspan=2>
                  <div id='btnSubmit'>
            <input type='submit' name='btnRegister' value='Register'>
            <input type='reset' name="reset" value='Reset'>
             </div>
                  </td>
               </tr>
            </div>
         </fieldset>
         </div>
      </form>
   </body>
</html>