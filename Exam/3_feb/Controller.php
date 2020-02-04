<?php
session_start();
require_once 'Dbconnection.php';

class Controller {

    private $conn;

    function __construct() {
        if(!$this->conn){
            $this->conn = new DbConnect;
        }
    }

    function getValue($sectionName, $fieldName, $returnType = "") {
        return isset($this->data[$sectionName][$fieldName]) ? $this->data[$sectionName][$fieldName] : $returnType;
    }

    function setLoginValue($section) {
        if($section == 'login') {   
            return $this->loginData($_POST[$section]);
        }     
    }

    function loginData($data) {
        $tableName = "user";
        $condition = "userEmail = '".$data['txtUserName']."' AND userPassword = '".md5($data['txtPassword'])."'";
        $result = $this->conn->fetchRow($tableName, $condition);
        if(mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return FALSE;
        }
    }

    function updateLastLoginTime($userId) {
        $tableName = "user";
        $data['userLastLogin'] = date('Y-m-d h:i:s', time());
        $condition = "userId = $userId";
        $this->conn->update($data, $tableName, $condition);
    }

    function imageUpload($file) {
        if(!empty($file)) {
            $name = $file['name'];
            $size = $file['size'];
            $type = $file['type'];
            $tmp_name = $file['tmp_name'];
            $uploadPath = 'uploads/';
            $extension = strtolower(substr($name,strpos($name,'.')+1));
            if(($extension === 'jpeg' || $extension === 'png') && ($type === 'image/png' || $type === 'image/jpeg')) {
                    if($size < 3526840) {
                        if(move_uploaded_file($tmp_name,$uploadPath.$name)) {
                            return TRUE;
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

    function setUserValues($section, $custId = 0 ){
        $errors = [];
        if(isset($section)) {
            foreach( $_POST[$section] as $key => $value) {
                $this->isValidate($key, $value) ? "" : array_push($errors, "<br>Invalid $key");
            }
        }
        if(sizeof($errors) != 0) {
            $errors = implode(',',$errors);
            echo "$errors";
        } else {
            if($this->checkRegisterdUser($_POST[$section])) {
                if($section == "user"){
                    return $this->setUserData($_POST[$section]);          
                }
            } else {
                echo "User alredy regisered..";
            }   
        }        
    }
 
    function setUserData($data) {
        $userData = $this->converterUser($data);
        $tableName = "user";   
        return $this->conn->insert($userData, $tableName);
    }

    function setCatValues($section) {       
        if($this->checkRegisterdURL($_POST[$section])) {
            if($section == "cat"){
                return $this->setCatData($_POST[$section]);          
            }
        } else {
            echo "URL alredy regisered..";
        }   
    }

    function setBlogValues($section, $userId) {       
        if($this->checkRegisterdURL($_POST[$section])) {
            if($section == "blog"){
                return $this->setBlogData($_POST[$section], $userId);          
            }
        } else {
            echo "URL alredy regisered..";
        }   
    }

    function updateCatValues($section, $catId) {       
        if($section == "cat"){
            return $this->updateCatData($_POST[$section], $catId);          
        }
    }

    function updateBlogValues($section, $blogId) {       
        if($section == "blog"){
            return $this->updateBlogData($_POST[$section], $blogId);          
        }
    }

    function updateCatData($data, $catId) {
        $userData = $this->converterCat($data);
        $tableName = "category";   
        $condition = "catId = $catId";
        return $this->conn->update($userData, $tableName, $condition);
    }

    function updateBlogData($data, $blogId) {
        $userData = $this->converterBlog($data);
        $tableName = "blog_post";   
        $condition = "blogId = $blogId";
        return $this->conn->update($userData, $tableName, $condition);
    }

    function setCatData($data) {
        if($this->imageUpload($_FILES['userFile'])) {
            $userData = $this->converterCat($data);
            $tableName = "category";   
            return $this->conn->insert($userData, $tableName);
        } else {
            echo "fail";
        }
        
    }

    function setBlogData($data) {
        $parentId = [];
        $userData = $this->converterBlog($data);
        $tableName = "blog_post";  
        $result = $this->conn->insert($userData, $tableName);

        foreach($data['txtParentId'] as $value) {
            $parentId['blogId'] = $result;
            $parentId['catParentId'] = $value;
            $final = $this->conn->insert($parentId, "post_category");
        }
        return $final;
    }
    

    function checkRegisterdURL($data) {
        $tableName = "category";
        $condition = "catUrl = '".$data['txtURL']."'";
        $result = $this->conn->fetchRow($tableName, $condition);
        if(mysqli_num_rows($result) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function checkRegisterdUser($data) {
        $tableName = "user";
        $condition = "userEmail = '".$data['txtEmail']."'";
        $result = $this->conn->fetchRow($tableName, $condition);
        if(mysqli_num_rows($result) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function converterUser($data) {
        $userData = [];
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'prefix':
                    $userData['userPrefix'] = $value;
                    break;
                
                case 'txtFirstName':
                    $userData['userFirstName'] = $value;
                    break;
                
                case 'txtLastName':
                    $userData['	userLastName'] = $value;
                    break;

                case 'txtPhone':
                    $userData['userMobile'] = $value;
                    break;
                    
                case 'txtEmail':
                    $userData['userEmail'] = $value;
                    break;
                
                case 'txtPassword':
                    $userData['userPassword'] = md5($value);
                    break;

                case 'info':
                    $userData['userInfo'] = $value;
                    break;
            }
        }
        return $userData;
    }

    function converterCat($data) {
        $userData = [];
        $imageName = $_FILES['userFile']['name'];
        $userData['catImage'] = $imageName;
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'txtTitle':
                    $userData['catTitle'] = $value;
                    break;
                
                case 'txtMetaTitle':
                    $userData['catMetaTitle'] = $value;
                    break;
                
                case 'txtURL':
                    $userData['	catUrl'] = $value;
                    break;

                case 'txtcontent':
                    $userData['catContent'] = $value;
                    break;
                    
                case 'txtParentId':
                    $userData['catParentId'] = $value;
                    break;
            }
        }
        return $userData;
    }

    function converterBlog($data) {
        $userData = [];
        $userData['userId'] = $_SESSION['userId'];
        $userData['blogImage'] = 'IMg.jpeg';
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'txtTitle':
                    $userData['blogTitle'] = $value;
                    break;
                
                case 'txtMetaTitle':
                    $userData['catMetaTitle'] = $value;
                    break;
                
                case 'txtURL':
                    $userData['blogUrl'] = $value;
                    break;

                case 'txtcontent':
                    $userData['blogContent'] = $value;
                    break;

                case 'dtPublish':
                    $userData['blogPublishAt'] = $value;
                 break;     

                

            }
        }
        return $userData;
    }

    function isValidate($key, $value) {
        switch($key) {
            case 'txtFirstName':
            case 'txtLastName':
                return preg_match('/^[a-zA-Z]{2,20}$/',$value);
                break;
            case 'txtPhone':
                return preg_match('/^[0-9]{10,10}$/',$value);
                break;
            case 'txtEmail':
                return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',$value);
                break;
            case 'txtPassword':
                return $value == $_POST['user']['txtConfirmPassword'] ? TRUE : FALSE;
            break;
            
            default:
                return TRUE;
        }
    }

    function getParentCat() {
        $tableName = "parentCategory";
        $fields = "*";
        $result = $this->conn->fetchAll($tableName, $fields);
        return $result;
    }

    function prepareFetchAllCat() {
        $result = $this->conn->fetchCat();
        return $result;
    }

    function prepareFetchAllBlog() {
        $result = $this->conn->fetchAllBlog();
        return $result;
    }

    function prepareFetchRow($catId) {
        $tableName = "category";
        $condition = "catId = $catId";
        $this->data['cat'] = mysqli_fetch_assoc($this->conn->fetchRow($tableName, $condition));
    }

    function prepareFetchRowBlog($blogId) {
        $tableName = "blog_post";
        $condition = "blogId = $blogId";
        $this->data['blog'] = mysqli_fetch_assoc($this->conn->fetchRow($tableName, $condition));
        // $tableName = "post_category";
        // $condition = "blogId = $blogId";
        // $data = mysqli_fetch_assoc($this->conn->fetchRow($tableName, $condition));
        //  array_push($this->data['id'], $data);
        //  echo "<pre>";
        // print_r($this->data);
    }

    function prepareFetchRowProfile($blogId) {
        $tableName = "user";
        $condition = "userId = $blogId";
        $this->data['user'] = mysqli_fetch_assoc($this->conn->fetchRow($tableName, $condition));
    }

    function deleteCat($deleteId) {
        $tableName = "category";
        $field = "catId";
        return $this->conn->delete($tableName, $field, $deleteId);
    }

    function deleteBlog($deleteId) {
        $tableName = "blog_post";
        $field = "blogId";
        return $this->conn->delete($tableName, $field, $deleteId);
    }

    
}

?>