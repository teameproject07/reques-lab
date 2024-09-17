<?php
include "update-user-data.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - Edit Mode</title>
    <style>
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
            max-width: 600px;
            margin: 40px auto;
            transition: box-shadow 0.3s ease-in-out;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
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
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="file"] {
            display: none;
        }

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
            margin-top: 10px;
        }

        .save-button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #008CBA;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            margin-top: 20px;
        }

        /* Responsive Styles */
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
            select {
                font-size: 14px;
                padding: 10px;
            }

            .custom-file-upload {
                width: 95%;
                text-align: center;
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            .profile-card {
                padding: 10px;
                margin-top: 20px;
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
        <form method="post" enctype="multipart/form-data" action="update-user-data.php">
            <div class="profile-info">
                <!-- Form Fields -->
                <div class="info-item">
                    <label for="fullname">Full name:</label>
                    <input type="text" id="fullname" name="full_name" value="<?php echo htmlspecialchars($user['full_name'] ?? ''); ?>" required>
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
                        <option value="male" <?php echo ($user['gender'] === 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($user['gender'] === 'female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="info-item">
                    <label for="dob">Date of Birth:</label>
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
                    <label for="photo">Profile Photo:</label>
                    <img id="profile-pic-preview" src="<?php echo 'uploads/' . ($user['photo'] ?? 'default.jpg'); ?>" alt="Profile Picture" width="100">
                    <input type="file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
                    <label for="photo" class="custom-file-upload">Upload Image</label>
                </div>
            </div>

            <input type="submit" class="save-button" value="Save Changes">
        </form>
    </div>

    <script>
        // Preview uploaded image
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('profile-pic-preview');
                preview.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
