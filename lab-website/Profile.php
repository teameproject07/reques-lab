<?php
include 'db_connection.php';

// Check database connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Start session and fetch username
session_start();
$username = $_SESSION['username'] ?? ''; // Fetch username from session
if (empty($username)) {
    echo "Session username not set or empty.";
    exit;
}

// Initialize $user to avoid undefined variable warnings
$user = [];

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $con->prepare($sql);
if (!$stmt) {
    die("Failed to prepare statement: " . $con->error);
}
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style/Profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Header Section -->
    <header class="site-header">
        <div class="container">
            <h1>My Profile Page</h1>
            <nav>
                <ul>
                    <li><a href="schedule-user.html">Home</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Profile.php">Profile</a></li>
                    <li><form action="logout.php" method="post">
                        <button type="submit">Logout</button>
                    </form></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <!-- Profile Card Section -->
    <div class="profile-card">
        <div class="profile-header">
            <img src="<?php echo 'uploads/' . htmlspecialchars($user['photo']); ?>" alt="Profile Image" class="profile-img">
            <div class="update-icon" title="Update Profile Picture">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <div class="profile-name">
                <h2><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></h2>
                <p><?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <button class="edit-button">Edit</button>
        </div>
        <div class="profile-info">
            <div class="info-item">
                <span>Email:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="info-item">
                <span>Phone:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['phone']); ?></p>
            </div>
            <div class="info-item">
                <span>Gender:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['gender']); ?></p>
            </div>
            <div class="info-item">
                <span>Date of Birth:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['DOB']); ?></p>
            </div>
            <div class="info-item">
                <span>Position:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['position']); ?></p>
            </div>
            <div class="info-item">
                <span>Address:</span>
                <p class="info-value"><?php echo htmlspecialchars($user['address']); ?></p>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 Dong Darong. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.querySelector('.edit-button').addEventListener('click', function() {
            window.location.href = "Input-info.php";
        });
    </script>
</body>
</html>
