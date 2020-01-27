<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
</head>
<body>
<?php
require_once 'Registration.php';
$obj = new Registration();
$sessionData = $obj->getSessionData(); 
// print_r($sessionData);
if(isset($_POST['btnRegister'])) {
    extract($_POST);
    if(!empty($txtFirstName) && !empty($txtLastName) && !empty($txtPhone) && !empty($txtEmail) && !empty($txtPassword) && !empty($txtConfirmPassword) && !empty($txtAddressLine1) && !empty($txtAddressLine2) && !empty($txtCountry) && !empty($txtPostalCode) && !empty($getTouch)) {
          
        if($obj->validate() && $obj->validateProfileImage() && $obj->validateCertificateImage()){
            $obj->setSessionData();
            // print_r($_SESSION['registerData']);
            $sessionData = $_SESSION['registerData'];
        }
    } else {            
        echo "Please fill the details";
    }
}
?>

<form name='registerData' method="POST" enctype="multipart/form-data">
    <h2>Registration Form</h2>
    <fieldset>
        <legend>YOUR ACCOUNT DETAILS</legend><br>
            <div class='account'>
                    <label>Full Name : </label>
                        <select name="prefix">
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Ms">Ms</option>
                            <option value="Mrs">Mrs</option>
                        </select>
                        <input type="text" name="txtFirstName" value="<?php echo $sessionData['txtFirstName'];?>" placeholder='First Name'> 
                        <input type="text" name="txtLastName" value="<?php echo $sessionData['txtLastName'];?>" placeholder='Last Name'><br><br>
                <label>Date of Birth</label> : 
                    <input type="date" name="birthDate"><br><br>
                <label>Phone Number</label> : 
                    <input type="text" name="txtPhone" value="<?php echo $sessionData['txtPhone'];?>" placeholder="Phone Number"><br><br>  
                <label> Email</label> : 
                    <input type="text" name="txtEmail" value="<?php echo $sessionData['txtEmail'];?>" placeholder="Email"><br><br>
                <label>Password </label>: 
                    <input type="password" name="txtPassword" placeholder="Password"><br><br>   
                <label>Confirm Password </label> 
                    <input type="password" name="txtConfirmPassword" placeholder="Confirm Password">
            </div>
    </fieldset><br>
                
    <fieldset>
        <legend>ADDRESS INFORMATION</legend><br>
            <div class='address'>
                <label>Address Line 1 : </label>
                    <input type="text" name="txtAddressLine1" value="<?php echo $sessionData['txtAddressLine1'];?>" placeholder='Address Line'><br><br>
                <label>Address Line 1 :</label> : 
                    <input type="text" name="txtAddressLine2" value="<?php echo $sessionData['txtAddressLine2'];?>" placeholder='Address Line'><br><br>
                <label>Company</label> : 
                    <input type="text" name="txtCompany"  value="<?php echo $sessionData['txtCompany'];?>" placeholder='Company'><br><br>  
                <label> State</label> : 
                    <input type="text" name="txtState" value="<?php echo $sessionData['txtState'];?>" placeholder='State'>    
                <label>Country </label>: 
                    <select name="txtCountry">
                        <option value="India">India</option>
                        <option value="New Zelend">New Zelend</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                    </select><br><br>
                <label>Postal Code</label> 
                    <input type="text" name="txtPostalCode" value="<?php echo $sessionData['txtPostalCode'];?>" placeholder='Postal Code'>
            </div>
    </fieldset><br>

    <input type='checkbox' id="otherData" onclick="showOtheData()">Other Information<br><br>

    <div id='otherInfo' style="visibility:hidden">
        <fieldset>
            <legend>OTHER INFORMATION</legend><br>           
                <label>Describe Yourself : </label>
                    <textarea name="txtYourSelf" rows="5" cols="20"><?php echo $sessionData['txtYourSelf'];?></textarea><br><br>
                <label>Profile Image</label> : 
                    <input type="file" name="fileProfile"><br><br>
                <label>Certificate Upload</label> : 
                    <input type="file" name="fileCertificate"><br><br>  
                <label> How long have you been in business?</label> :<br> 
                    <input type="radio" name="rdBusiness" value="UNDER 1 YEAR"> UNDER 1 YEAR <br>   
                    <input type="radio" name="rdBusiness" value="2-5 YEARS"> 2-5 YEARS <br>
                    <input type="radio" name="rdBusiness" value="5-10 YEARS"> 5-10 YEARS <br>
                    <input type="radio" name="rdBusiness" value="OVER 10 YEARS"> OVER 10 YEARS <br><br>   

                <label> Number of unique clients you see each week?</label> :
                        <select name="txtClients">
                            <option value="1-5">1-5</option>
                            <option value="6-10">6-10</option>
                            <option value="11-15">11-15</option>
                            <option value="15+">15+</option>
                        </select><br><br>
                
                <label> How do you like us to get in touch with you?</label> :<br>
                    <input type="checkbox" name="getTouch[]" value='POST'> POST <br>   
                    <input type="checkbox" name="getTouch[]" value='POST'> POST<br>
                    <input type="checkbox" name="getTouch[]" value='SMS'> SMS<br>
                    <input type="checkbox" name="getTouch[]" value='Phone'> Phone <br>
                
                <br><br>
                <label> Hobbies :</label> :
                        <select name="hobbies[] " multiple>
                            <option value="Listening to Music">Listening to Music</option>
                            <option value="Travelling">Travelling</option>
                            <option value="Blogging">Blogging</option>
                            <option value="Sports">Sports</option>
                            <option value="Art">Art</option>
                        </select><br>       
        </fieldset> 
    </div>
            <div id='btnSubmit' style="visibility:hidden">
                    <br>
                    <center>
                        <input type='submit' name='btnRegister' value='Register'>
                        <input type='reset' name="reset" value='Reset'><br><br><br>
                    </center>
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
