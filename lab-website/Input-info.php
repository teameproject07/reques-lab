<?php
include 'php/db_connection.php';

// Start session and fetch the username
session_start();
$username = $_SESSION['username'] ?? '';

// Fetch user data
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $first_name = $conn->real_escape_string($_POST['firstname']);
    $last_name = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['DOB']);
    $position = $conn->real_escape_string($_POST['position']);
    $address = $conn->real_escape_string($_POST['address']);

    // Handle the file upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($photo);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if directory exists, create if not
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Check file size
    if ($_FILES['photo']['size'] > 500000) {
        $uploadOk = 0;
        echo "Sorry, your file is too large.";
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $uploadOk = 0;
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    if ($uploadOk == 1 && move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
        // Use prepared statements for SQL query
        $stmt = $conn->prepare("UPDATE users SET 
                first_name=?, 
                last_name=?, 
                email=?, 
                phone=?, 
                gender=?, 
                date_time=?, 
                position=?, 
                address=?, 
                photo=? 
                WHERE username=?");
        $stmt->bind_param('sssssssss', $first_name, $last_name, $email, $phone, $gender, $dob, $position, $address, $photo, $username);

        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        $stmt->close();
    } else if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - Edit Mode</title>
    <link rel="stylesheet" href="style/Input-info.css">
</head>
<body>
    <!-- Header Section -->
    <header class="site-header">
        <div class="container">
            <h1>Edit Profile Page</h1>
        </div>
    </header>
    
    <!-- Profile Card Section -->
    <div class="profile-card">
        <form method="post" enctype="multipart/form-data">
            <div class="profile-info">
                <!-- Form Fields -->
                <div class="info-item">
                    <label for="firstname">First name:</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="lastname">Last name:</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required readonly>
                </div>
                <div class="info-item">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male" <?php echo ($user['gender'] ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($user['gender'] ?? '') == 'Female' ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($user['gender'] ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
                <div class="info-item">
                    <label for="DOB">Date of Birth:</label>
                    <input type="date" id="dob" name="DOB" value="<?php echo htmlspecialchars($user['DOB'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="position">Position:</label>
                    <input type="text" id="position" name="position" value="<?php echo htmlspecialchars($user['position'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>" required>
                </div>
                <div class="info-item">
                    <label for="photo" class="custom-file-upload">Choose File</label>
                    <input type="file" id="photo" name="photo" style="display:none;">
                </div>
                <div class="info-item">
                    <button type="submit" class="save-button">Save</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 Dong Darong. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Form Validation -->
    <script src="javaScript/Input-info.js"></script>
</body>
</html>
