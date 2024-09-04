<?php
if(!$con = mysqli_connect("localhost","root","","forgot_db")){
    die("Could not connect to");
}
// $password = password_hash('password',PASSWORD_DEFAULT);
// $query = "update users set password = '$password' ";
//  mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home Page</h1>
</body>
</html>