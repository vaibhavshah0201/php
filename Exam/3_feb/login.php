<!DOCTYPE html>
<html>
<head><title>Login Page</title></head>
<body>
    <?php
       require_once 'Controller.php';
       $obj = new Controller();
        if(isset($_POST['btnLogin'])) {
            if($data = $obj->setLoginValue("login")) {
                $_SESSION['userId'] = $data['userId'];
                $obj->updateLastLoginTime($data['userId']);
                header("Location: blogpost.php");
            } else {
                echo "Invalid user Id or Password";
            }        
        }
            
    ?>
    <form method="POST">
        <fieldset>
            <legend>Login Details</legend>
                <label for='login'>Login<br>
                <input type='text' name='login[txtUserName]' value=""><br><br>

                <label for='password'>Password<br>
                <input type="password" name='login[txtPassword]' value=""><br><br>

                <input type="submit" value="Login" name="btnLogin">
                <a href="register.php"><input type="button" value="Register" name="btnLogin"></a>

        </fieldset>                    
    </form>
</body>
</html>