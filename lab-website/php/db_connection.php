<?php
// // db_connection.php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "request-lab";

// // Create connection
// $con = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// }

$conn = mysqli_connect("localhost", "root", "", "request_lab");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
