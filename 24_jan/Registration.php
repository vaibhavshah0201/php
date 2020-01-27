<?php
session_start();

class Registration {

    private $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/";
    private $phonePattern = "/^[0-9]{11}+$/";
    private $postalPattern = "/^[0-9]{6}+$/";
    private $namePattern = "/^[a-zA-Z]{1,20}+$/";

    function validate () {
        extract($_POST);
        if(!preg_match($this->emailPattern,$txtEmail)) {
            echo "Enter valid Email";
            return false;
        } elseif (!preg_match($this->phonePattern,$txtPhone)) {
            echo "Enter Valid Mobile Number";
            return false;
        } elseif (!preg_match($this->namePattern,$txtFirstName)) {
            echo "Enter valid First Name";
            return false;
        } elseif (!preg_match($this->namePattern,$txtLastName)) {
            echo "Enter valid Last Name";
            return false;
        } elseif (!preg_match($this->postalPattern,$txtPostalCode)) {
            echo "Enter valid postal Code";
            return false;
        } else {
            return true;
        }
    }

    function validateProfileImage() {
        $name = $_FILES['fileProfile']['name'];
        $size = $_FILES['fileProfile']['size'];
        $type = $_FILES['fileProfile']['type'];
        $tmp_name = $_FILES['fileProfile']['tmp_name'];
        $_SESSION['profileName'] = $name;
            $uploadPath = 'uploads/';
            $extension = strtolower(substr($name,strpos($name,'.')+1));
            if(($extension === 'jpeg' || $extension === 'png') && ($type === 'image/png' || $type === 'image/jpeg')) {
                    if($size < 3526840) {
                        if(move_uploaded_file($tmp_name,$uploadPath.$name)) {
                            return true;
                        } else {
                            echo "Something want wrong";
                            return false;
                        } 
                    } else {
                        echo "Please select file upto 2 Mb";
                        return false;
                    }
                } else {
                    echo "Please select only image file";
                }
    }

    function validateCertificateImage() {
        $name = $_FILES['fileCertificate']['name'];
        $size = $_FILES['fileCertificate']['size'];
        $type = $_FILES['fileCertificate']['type'];
        $tmp_name = $_FILES['fileCertificate']['tmp_name'];
        $_SESSION['certificateName'] = $name;
            $uploadPath = 'uploads/';
            $extension = strtolower(substr($name,strpos($name,'.')+1));
            if(($extension === 'jpeg' || $extension === 'png') && ($type === 'image/png' || $type === 'image/jpeg')) {
                    if($size < 3526840) {
                        if(move_uploaded_file($tmp_name,$uploadPath.$name)) {
                            return true;
                        } else {
                            echo "Something want wrong";
                            return false;
                        } 
                    } else {
                        echo "Please select file upto 2 Mb";
                        return false;
                    }
                } else {
                    echo "Please select only image file";
                }
    }
    

    function setSessionData() {
        extract($_POST);
        $sessionData = [
            'prefix' => $prefix,
            'txtFirstName' => $txtFirstName,
            'txtLastName' => $txtLastName,
            'birthDate' => $birthDate,
            'txtPhone' => $txtPhone,
            'txtEmail' => $txtEmail,
            'txtPassword' => $txtPassword,
            'txtConfirmPassword' => $txtConfirmPassword,
            'txtAddressLine1' => $txtAddressLine1,
            'txtAddressLine2' => $txtAddressLine2,
            'txtCompany' => $txtCompany,
            'txtState' => $txtState,
            'txtCountry' => $txtCountry,
            'txtPostalCode' => $txtPostalCode,
            'txtYourSelf' => $txtYourSelf,
            'fileProfile' => $_SESSION['profileName'],
            'fileCertificate' => $_SESSION['certificateName'],
            'rdBusiness' => $rdBusiness,
            'txtClients' => $txtClients,
            'hobbies' => $hobbies,
            'getTouch' => $getTouch
            
        ];

        $_SESSION['registerData'] = $sessionData;
    }

    function getSessionData() {
        $sessionData = $_SESSION['registerData'];
        return $sessionData;
    }

}

?>