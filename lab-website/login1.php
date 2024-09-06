<?php
include 'db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM user WHERE Username = '$username'";
    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_hash($password, $row['password'])) {
            // Check user type and redirect
            if ($row['Type'] === 'admin') {
                header('Location: schedule-admin.html');
            } else {
                header('Location: schedule-user.html');
            }
            exit();
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid username or password'); window.history.back();</script>";
        }
    } else {
        // Username does not exist
        echo "<script>alert('Username does not exist'); window.history.back();</script>";
    }
}

$conn->close();
?>
