<?php
include "update-profile.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - Edit Mode</title>
    <link rel="stylesheet" href="style/update-profile.css">
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
        <form method="post" enctype="multipart/form-data" action="update-profile.php">
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
