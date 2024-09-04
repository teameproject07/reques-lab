<?php
session_start();
$error = array();
    require "mail.php";
if(!$con = mysqli_connect("localhost","root","","forgot_db")){
    die("Could not connect to");
}
    $mode = "enter_email";
    if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
    }
    
    if(count($_POST) > 0){
        switch ($mode) {
            case 'enter_email':
                $email = $_POST['email'];
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $error[] = "Please enter a valid email";
                }else if(!valid_email($email)){
                    $error[] = "That email was not found";
                }else{
                
                    $_SESSION['forgot']['email'] = $email;
                    send_email($email);
                    
                    header("Location: forgot.php?mode=enter_code");
                    die;
                }
                
                break;
                case 'enter_code':
                    $code = $_POST['code'];
                    $result = is_code_correct($code);
                    if($result == "the code is correct"){ 
                        $_SESSION['forgot']['code'] = $code;
                        header("Location: forgot.php?mode=enter_password");
                        die;
                    }else{
                        $error[] = $result;
                    }
                
                    break;
                    case 'enter_password':
                        $password = $_POST['password'];
                        $password2 = $_POST['password2'];
                        
                        if($password !== $password2){
                           $error[] = "Passwords do not match"; 
                        }else if(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
                            header("Location: forgot.php");
                            die;
                        }else{
                            save_password($password);
                            if(isset($_SESSION['forgot'])){
                                unset($_SESSION['forgot']);
                            }
                            header("Location: login.php");
                            die;
                        }
                        
                        break;
            
            default:
                # code...
                break;
        }
    }

    function send_email($email){
        global $con;
        $expire = time() + (60 * 1);
        $code = rand(10000,999999);
        $email = addslashes($email);

        $query = "INSERT INTO codes (email,code,expire) VALUES('$email','$code','$expire')";
        mysqli_query($con,$query);

        //send the email
        send_mail($email,'Password reset',"Your code is " . $code);
    }

    function save_password($password){
        global $con;
        $password = password_hash($password, PASSWORD_DEFAULT);
        $email = addslashes($_SESSION['forgot']['email']);

        $query = "UPDATE users SET password = '$password' WHERE email = '$email' LIMIT 1";
        mysqli_query($con,$query);

        }

        function valid_email($email){
            global $con;
            $email = addslashes($email);
            $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $result = mysqli_query($con,$query);
                if($result){
                    if(mysqli_num_rows($result) > 0){
    
                        return true;          
                    }
                }
            return false;
        }

    function is_code_correct($code){
        global $con;
        $code = addslashes($code);
        $expire = time();
        $email = addslashes($_SESSION['forgot']['email']);
        $query = "SELECT * FROM codes WHERE email='$email' && code='$code' ORDER BY id desc limit 1";
        $result = mysqli_query($con,$query);
        if($result){
            if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                    if($row['expire'] > $expire){

                        return "the code is correct";
                    }else{
                        return "the code is expired";
                    }             
            }else{
                return "the code is incorrect";
            }
        }

        return "the code is incorrect";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>
</head>
<body>
    <style type="text/css">
        *{
            font-family:tahoma;
            font-size: 13px;
        }
        form{
            width: 100%;
            max-width: 200px;
            margin:  auto;
            border: solid thin #ccc;
            padding: 10px;
        }
        .textbox{
            padding: 5px;
            width: 180px;
        }
    </style>

    <?php
        switch ($mode) {
            case 'enter_email':
                ?>
            <form action="" method="post" action="forgot.php?mode=enter_email">
                <h1>Forgot Password</h1>
                <h3>Enter your email below</h3>
                <span style="font-size: 12px;color:red;">
                <?php
                    foreach ($error as $err) {
                        echo $err . "<br>";
                    }
                ?>
                </span>
                <input class="textbox" type="email" name="email" placeholder="Email"><br>
                <br style="clear: both;">
                <input type="submit" value="Next" >
                <br><br>
                <div><a href="login.php">Login</a></div>
            </form>
            <?php
                break;
                case 'enter_code':
                    ?>
            <form action="" method="post" action="forgot.php?mode=enter_code">
                <h1>Forgot Password</h1>
                <h3>Enter your the code sent your email</h3>
                <span style="font-size: 12px;color:red;">
                <?php
                    foreach ($error as $err) {
                        echo $err . "<br>";
                    }
                ?>
                </span>
                <input class="textbox" type="text" name="code" placeholder="Enter your code"><br>
                <br style="clear: both;">
                <input type="submit" value="Next" >
                <a href="forgot.php">
                    <input type="button" value="Start Over" style="float: right;">
                </a>
                <br><br>
                <div><a href="login.php">Login</a></div>
            </form>
            <?php
                    break;
                    case 'enter_password':
                        ?>
            <form action="" method="post" action="forgot.php?mode=enter_password">
                <h1>Forgot Password</h1>
                <h3>Enter your new password</h3>
                <span style="font-size: 12px;color:red;">
                <?php
                    foreach ($error as $err) {
                        echo $err . "<br>";
                    }
                ?>
                </span>
                <input class="textbox" type="text" name="password" placeholder="Password"><br>
                <input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
                <br style="clear: both;">
                <a href="forgot.php">
                    <input type="button" value="Start Over" style="float: right;">
                </a>
                <input type="submit" value="Next" >
                <br><br>
                <div><a href="login.php">Login</a></div>
            </form>
            <?php
                        break;
            
            default:
                # code...
                break;
        }
    ?>
    
</body>
</html>