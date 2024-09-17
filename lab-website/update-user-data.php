<?php
include 'db_connection.php';

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
    $full_name = $con->real_escape_string($_POST['full_name']);
    $email = $con->real_escape_string($_POST['email']);
    $phone = $con->real_escape_string($_POST['phone']);
    $gender = $con->real_escape_string($_POST['gender']);
    $dob = $con->real_escape_string($_POST['DOB']);
    $position = $con->real_escape_string($_POST['position']);
    $address = $con->real_escape_string($_POST['address']);
    
    // Handle the file upload
    $photo = $_FILES['photo']['name'];
    $target_dir = "uploads/";
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($photo, PATHINFO_EXTENSION));

    // Check if the photo is uploaded
    if (!empty($photo)) {
        $target_file = $target_dir . basename($photo);

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

        // Move uploaded file if everything is okay
        if ($uploadOk == 1 && move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            // Update photo in the database
            $photo_sql = ", photo=?";
        } else {
            $uploadOk = 0;
            echo "Sorry, your file was not uploaded.";
        }
    } else {
        // Keep the existing photo if no new file was uploaded
        $photo_sql = "";
    }

    // Building the SQL query
    if (!empty($photo_sql)) {
        $sql = "UPDATE users SET 
                    full_name=?, 
                    email=?, 
                    phone=?, 
                    gender=?, 
                    DOB=?, 
                    position=?, 
                    address=?, 
                    photo=?
                WHERE username=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssssss', $full_name, $email, $phone, $gender, $dob, $position, $address, $photo, $username);
    } else {
        $sql = "UPDATE users SET 
                    full_name=?, 
                    email=?, 
                    phone=?, 
                    gender=?, 
                    DOB=?, 
                    position=?, 
                    address=?
                WHERE username=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssssss', $full_name, $email, $phone, $gender, $dob, $position, $address, $username);
    }

    // Execute the query and check for errors
    if ($stmt->execute()) {
        // echo "Profile updated successfully!";
        header("Location: profile.php");
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

$con->close();
