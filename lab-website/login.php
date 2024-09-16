<?php
// login.php
include 'db_connection.php'; // Adjust the path as needed

// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user inputs
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        echo "Username and password are required.";
        exit;
    }

    // Prepare SQL statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['type']; // Store user type in session
            
            // Check user type and redirect accordingly
            if ($user['type'] == 'admin') { // Fixed here to match the column name
                header("Location: schedule-admin.html");
            } else if ($user['type'] == 'user') { // Fixed here to match the column name
                header("Location: schedule-user.html");
            }
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $con->close();
}
?>
