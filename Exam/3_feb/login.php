<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
    </head>
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
                <div class="loginForm" style="white-space: pre; margin-left:-60px;">
                    <label for='login'>Login
                    <input type='text' name='login[txtUserName]' value="">

                    <label for='password'>Password
                    <input type="password" name='login[txtPassword]' value="">

                    <input type="submit" value="Login" name="btnLogin">

                    <a href="register.php"><input type="button" value="Register" name="btnLogin"></a>
                </div>
        </fieldset>                    
    </form> 
</body>
</html>