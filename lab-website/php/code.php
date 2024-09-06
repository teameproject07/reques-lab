<?php
include 'forgot.php';

// Ensure $mode is defined
$mode = isset($mode) ? $mode : 'enter_email';
$error = isset($error) ? $error : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style type="text/css">
        * {
            font-family: Arial, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }
        h3 {
            margin-bottom: 10px;
            font-size: 16px;
            color: #666;
            text-align: center;
        }
        .textbox {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], input[type="button"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="button"] {
            background-color: #6c757d;
            margin-top: 10px;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #0056b3;
        }
        input[type="button"]:hover {
            background-color: #5a6268;
        }
        a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
        span {
            display: block;
            color: red;
            margin-bottom: 10px;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
    switch ($mode) {
        case 'enter_email':
            ?>
            <form method="post" action="forgot.php?mode=enter_email">
                <h1>Forgot Password</h1>
                <h3>Enter your email below</h3>
                <span>
                <?php
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo $err . "<br>";
                        }
                    }
                ?>
                </span>
                <input class="textbox" type="email" name="email" placeholder="Email" required><br>
                <input type="submit" value="Next">
                <a href="login.php">Login</a>
            </form>
            <?php
            break;

        case 'enter_code':
            ?>
            <form method="post" action="forgot.php?mode=enter_code">
                <h1>Forgot Password</h1>
                <h3>Enter the code sent to your email</h3>
                <span>
                <?php
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo $err . "<br>";
                        }
                    }
                ?>
                </span>
                <input class="textbox" type="text" name="code" placeholder="Enter your code" required><br>
                <input type="submit" value="Next">
                <a href="forgot.php"><input type="button" value="Start Over"></a>
                <a href="login.php">Login</a>
            </form>
            <?php
            break;

        case 'enter_password':
            ?>
            <form method="post" action="forgot.php?mode=enter_password">
                <h1>Forgot Password</h1>
                <h3>Enter your new password</h3>
                <span>
                <?php
                    if (!empty($error)) {
                        foreach ($error as $err) {
                            echo $err . "<br>";
                        }
                    }
                ?>
                </span>
                <input class="textbox" type="password" name="password" placeholder="Password" required><br>
                <input class="textbox" type="password" name="password2" placeholder="Retype Password" required><br>
                <input type="submit" value="Next">
                <a href="forgot.php"><input type="button" value="Start Over"></a>
                <a href="login.php">Login</a>
            </form>
            <?php
            break;

        default:
            echo "Invalid mode.";
            break;
    }
?>

</body>
</html>
