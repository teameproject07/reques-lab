<?php
include 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$user = $_POST['username'];
$pass = $_POST['password'];
$pass2 = $_POST['password2'];

// Check if all fields are filled
if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($user) && !empty($pass) && !empty($pass2)) {
    
    // Validate email format
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // Check if the email already exists
        $email_check = mysqli_query($conn, "SELECT Email FROM user WHERE Email = '$email'");
        if (mysqli_num_rows($email_check) > 0) {
            echo "<script>alert('$email already exists.'); window.history.back();</script>";
            exit();
        }
        
        // Check if the username already exists
        $username_check = mysqli_query($conn, "SELECT username FROM user WHERE username = '$user'");
        if (mysqli_num_rows($username_check) > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.'); window.history.back();</script>";
            exit();
        }
        
        // Check if passwords match
        if ($pass === $pass2) {
            // Check if password length is at least 8 characters
            if (strlen($pass) < 8) {
                echo "<script>alert('Password must be at least 8 characters long.'); window.history.back();</script>";
                exit();
            }

            // Hash the password
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

            // Insert the user into the database
            $sql = "INSERT INTO user     (First_name, Last_name, Email, username, password) 
                    VALUES ('$first_name', '$last_name', '$email', '$user', '$hashed_password')";
            
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Registration successful.'); window.location.href = 'schedule-user.html';</script>";
            } else {
                echo "<script>alert('Registration failed: " . $conn->error . "'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('$email is not a valid email.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('All fields are required.'); window.history.back();</script>";
}

$conn->close();
?>
