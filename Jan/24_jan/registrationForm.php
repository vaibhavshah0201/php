<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
</head>
<body>
<?php
    require_once 'Registration.php';
    $obj = new Registration();
    if(isset($_POST['btnRegister'])) {
        $obj->setSessionValue('account');
        $obj->setSessionValue('address');
        $obj->setSessionValue('otherInfo');
        if($userId = $obj->setQueryValues("account")) {
            $obj->setQueryValues("address",$userId);
            $obj->setQueryValues("otherInfo",$userId);
            echo "Data Insert Successfully.";
        }
    }
    

?>
<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Registration Form</h2>
        <fieldset>
            <legend>YOUR ACCOUNT DETAILS</legend><br>
                <div class='account'>
                        <label>Full Name : </label>
                            <select name="account[prefix]">
                                <?php 
                                    $prefix = ['Mr', 'Miss', 'Ms', 'Mrs'];
                                    foreach($prefix as $value):
                                    $select = $value == $obj->getValue('account','prefix') ? "selected" : ""; ?>                            
                                <option value="<?php echo $value;?>" <?php echo $select;?>><?php echo $value;?></option>
                                <?php endforeach?>
                            </select>
                                    <input type="text" name="account[txtFirstName]" value="<?php echo $obj->getValue('account', 'txtFirstName');?>" placeholder='First Name'> 
                                    <input type="text" name="account[txtLastName]" value="<?php echo $obj->getValue('account', 'txtLastName');?>" placeholder='Last Name'><br><br>
                            <label>Date of Birth</label> : 
                                <input type="date" name="account[birthDate]" value="<?php echo $obj->getValue('account', 'birthDate');?>"><br><br>
                            <label>Phone Number</label> : 
                                <input type="text" name="account[txtPhone]" value="<?php echo $obj->getValue('account', 'txtPhone');?>" placeholder="Phone Number"><br><br>  
                            <label> Email</label> : 
                                <input type="text" name="account[txtEmail]" value="<?php echo $obj->getValue('account', 'txtEmail');?>" placeholder="Email"><br><br>
                            <label>Password </label>: 
                                <input type="password" name="account[txtPassword]" placeholder="Password"><br><br>   
                            <label>Confirm Password </label> 
                                <input type="password" name="account[txtConfirmPassword]" placeholder="Confirm Password">
                </div>
        </fieldset><br>
                
        <fieldset>
            <legend>ADDRESS INFORMATION</legend><br>
                <div class='address'>
                    <label>Address Line 1 : </label>
                        <input type="text" name="address[addressLine1]" value="<?php echo $obj->getValue('address', 'addressLine1');?>" placeholder='Address Line'><br><br>
                    <label>Address Line 1 :</label> : 
                        <input type="text" name="address[addressLine2]" value="<?php echo $obj->getValue('address', 'addressLine2');?>" placeholder='Address Line'><br><br>
                    <label>Company</label> : 
                        <input type="text" name="address[txtCompany]"  value="<?php echo $obj->getValue('address', 'txtCompany');?>" placeholder='Company'><br><br>  
                    <label> State</label> : 
                        <input type="text" name="address[txtState]" value="<?php echo $obj->getValue('address', 'txtState');?>" placeholder='State'>    
                    <label>Country </label>: 
                        <select name="address[txtCountry]">
                        <?php   $prefix = ['India', 'Australia', 'Canada', 'United States'];
                                foreach($prefix as $value) :
                                $select = $value == $obj->getValue('address','txtCountry') ? "selected" : "";
                                ?>                            
                                <option value="<?php echo $value;?>" <?php echo $select;?>><?php echo $value;?></option>
                                <?php endforeach ?>
                        </select><br><br>
                    <label>Postal Code</label> 
                        <input type="text" name="address[txtPostalCode]" value="<?php echo $obj->getValue('address', 'txtPostalCode');?>" placeholder='Postal Code'>
                </div>
        </fieldset><br>

    <input type='checkbox' id="otherData" onclick="showOtheData()">Other Information<br><br>

    <div id='otherInfo' style="visibility:hidden">
        <fieldset>
            <legend>OTHER INFORMATION</legend><br>           
                <label>Describe Yourself : </label>
                    <textarea name="otherInfo[txtYourSelf]" rows="5" cols="20"><?php echo $obj->getValue('otherInfo', 'txtYourSelf');?></textarea><br><br>
                <label>Profile Image</label> : 
                    <input type="file" name="otherInfo[fileProfile]"><br><br>
                <label>Certificate Upload</label> : 
                    <input type="file" name="otherInfo[fileCertificate]"><br><br>  
                <label> How long have you been in business?</label> :<br> 
                    <?php $data = ['UNDER 1 YEAR', '2-5 YEARS', '5-10 YEARS', 'OVER 10 YEARS'];
                        foreach($data as $value) :
                            
                            $select = $value == $obj->getValue('otherInfo', 'rdBusiness') ? 'checked' : "";?>
                        <input type="radio" name="otherInfo[rdBusiness]" value="<?php echo $value;?>" <?php echo $select;?>> <?php echo $value;?> 
                        <?php endforeach?> <br><br>  
                    
                <label> Number of unique clients you see each week?</label> :
                        <select name="otherInfo[txtClients]">
                        <?php $prefix = ['1-5', '6-10', '11-15', '15+'];
                            foreach($prefix as $value): 
                            $select = $value == $obj->getValue('otherInfo', 'txtClients') ? "selected" : "";?>                            
                            <option value="<?php echo $value;?>" <?php echo $select;?>><?php echo $value;?></option>
                            <?php endforeach?>
                        </select><br><br>
                
                <label> How do you like us to get in touch with you?</label> :<br>
                    <?php $data = ['POST', 'Mail', 'SMS', 'Phone'];
                        foreach( $data as $value ) :
                        $checked = $value == in_array($value, $obj->getValue('otherInfo', 'getTouch', [])) ? "checked" : "";?> 
                        <input type="checkbox" name="otherInfo[getTouch][]" value="<?php echo $value;?>" <?php echo $checked;?>> <?php echo $value;?> <br> <?php endforeach ?>
                
                <br><br>
                <label> Hobbies :</label> :
                        <select name="otherInfo[hobbies][]" multiple>
                        <?php
                            $prefix = ['Listeing To Music', 'Travelling', 'Blogging', 'Sports'];
                            foreach($prefix as $value){ 
                            $selected = $value == in_array($value, $obj->getValue('otherInfo', 'hobbies', [])) ? "selected" : "";?>                             
                            <option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $value;?></option>
                        <?php }?>
                        </select><br>       
        </fieldset> 
    </div>
    <div id='btnSubmit' style="visibility:hidden"><br>
        <input type='submit' name='btnRegister' value='Register'>
        <input type='reset' name="reset" value='Reset'><br><br><br>        
    </div>
</form>
    <script>
        function showOtheData() {
            var checkedData = document.getElementById("otherData").checked;
            
            if(checkedData){
                document.getElementById("otherInfo").style.visibility='visible';
                document.getElementById("btnSubmit").style.visibility='visible';
            } else {
                document.getElementById("otherInfo").style.visibility='hidden';
                document.getElementById("btnSubmit").style.visibility='hidden';
            }
        }
    </script>

</body>
</html> 
