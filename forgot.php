<?php
session_start();
$error = array();
require "mail.php";

$con = mysqli_connect("localhost", "root", "", "forgot_db");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$mode = "enter_email";
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($mode) {
        case 'enter_email':
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Please enter a valid email";
            } elseif (!valid_email($email)) {
                $error[] = "That email was not found";
            } else {
                $_SESSION['forgot']['email'] = $email;
                send_email($email);
                header("Location: code.php?mode=enter_code");
                exit;
            }
            break;

        case 'enter_code':
            $code = $_POST['code'];
            $result = is_code_correct($code);
            if ($result === "the code is correct") {
                $_SESSION['forgot']['code'] = $code;
                header("Location: code.php?mode=enter_password");
                exit;
            } else {
                $error[] = $result;
            }
            break;

        case 'enter_password':
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            if ($password !== $password2) {
                $error[] = "Passwords do not match";
            } elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
                header("Location: code.php");
                exit;
            } else {
                save_password($password);
                unset($_SESSION['forgot']);
                header("Location: login.php");
                exit;
            }
            break;

        default:
            // Fallback case, should not be reached
            break;
    }
}

function send_email($email)
{
    global $con;
    $expire = time() + 60 * 15;  // Code expires in 15 minutes
    $code = rand(10000, 99999);
    $email = mysqli_real_escape_string($con, $email);

    $query = "INSERT INTO codes (email, code, expire) VALUES ('$email', '$code', '$expire')";
    mysqli_query($con, $query);

    // Send the email
    send_mail($email, 'Password reset', "Your code is " . $code);
}

function save_password($password)
{
    global $con;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $email = mysqli_real_escape_string($con, $_SESSION['forgot']['email']);

    $query = "UPDATE users SET password = '$password' WHERE email = '$email' LIMIT 1";
    mysqli_query($con, $query);
}

function valid_email($email)
{
    global $con;
    $email = mysqli_real_escape_string($con, $email);
    $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($con, $query);

    return ($result && mysqli_num_rows($result) > 0);
}

function is_code_correct($code)
{
    global $con;
    $code = mysqli_real_escape_string($con, $code);
    $expire = time();
    $email = mysqli_real_escape_string($con, $_SESSION['forgot']['email']);
    
    $query = "SELECT * FROM codes WHERE email = '$email' AND code = '$code' ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['expire'] > $expire) {
            return "the code is correct";
        } else {
            return "the code is expired";
        }
    }

    return "the code is incorrect";
}
?>
