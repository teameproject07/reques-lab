<?php
include 'php/db_connection.php';

// Start session and fetch the username
session_start();
$username = $_SESSION['username'] ?? '';

// Fetch user data
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $first_name = $con->real_escape_string($_POST['firstname']);
    $last_name = $con->real_escape_string($_POST['lastname']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);
    $gender = $con->real_escape_string($_POST['gender']);
    $dob = $con->real_escape_string($_POST['DOB']);
    $position = $con->real_escape_string($_POST['position']);
    $address = $con->real_escape_string($_POST['address']);

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

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - Edit Mode</title>
    <!-- <link rel="stylesheet" href="style/Input-info.css"> -->
    <style>
        /* Base styles for larger screens (desktops) */
/* Base styles for larger screens (desktops) */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    width: 80%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.profile-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px; /* Limit the width */
    margin: 40px auto; /* Center the card */
    transition: box-shadow 0.3s ease-in-out;
}

.profile-info {
    display: flex;
    flex-direction: column;
    gap: 20px; /* Use gap for spacing */
}

.info-item {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 8px;
}

input[type="text"],
input[type="email"],
input[type="date"],
select,
input[type="file"] {
    width: 100%;
    padding: 12px; /* Increase padding */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px; /* Increase font size */
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="date"]:focus,
select:focus {
    border-color: #4CAF50; /* Highlight border on focus */
    outline: none;
}

/* Style for hiding the default file input */
input[type="file"] {
    display: none; /* Hide the default input */
}

/* Style for the custom file input label */
.custom-file-upload {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    font-weight: bold;
    border: none;
    text-align: center;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.custom-file-upload:hover {
    background-color: #388E3C; /* Darker shade on hover */
}

/* Button styling */
.save-button {
    display: inline-block;
    padding: 12px 20px; /* Increase padding */
    background-color: #008CBA;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px; /* Increase font size */
    border: none;
    text-align: center;
    transition: background-color 0.3s ease;
    margin-top: 20px; /* Add margin for spacing */
}

.save-button:hover {
    background-color: #005f73; /* Darker shade on hover */
}

/* Responsive Styles */

/* Tablets and smaller screens */
@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    .profile-card {
        padding: 15px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    select,
    .save-button {
        font-size: 14px;
        padding: 10px; /* Adjust padding */
        
    }

    .custom-file-upload {
        width: 95%;
        text-align: center;
        padding: 12px; /* Adjust padding */
    }
    /* .save-button{
        text-align: center;
    } */
}

/* Mobile phones */
@media (max-width: 480px) {
    .container {
        width: 100%;
        padding: 10px;
    }

    .profile-card {
        padding: 10px;
        margin-top: 20px;
    }

    h1 {
        font-size: 22px;
        text-align: center;
    }

    .info-item {
        margin-bottom: 12px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    select {
        font-size: 14px;
        padding: 8px;
    }

    .save-button {
        font-size: 16px;
        padding: 12px;
        width: 100%;
    }
}


    </style>
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
                    <input type="file" id="photo" name="photo" onchange="previewImage(event)">
                    <img id="preview" src="#" alt="Image Preview" style="display: none; margin-top: 10px; width: 100px; border-radius: 50%;"/> <!-- Image preview -->
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
    <script src="javaScript/Input-info.js">
       
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }


    </script>
</body>
</html>
