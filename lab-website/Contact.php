<?php
// Check for logged-in user
// if (isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];
// } else {
//     echo "Please log in to submit a lab request.";
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style/Contact-page.css"> <!-- Assuming your CSS file is named styles.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
        <!-- Header Section -->
        <header class="site-header">
            <div class="container">
                <h1>Contact Us</h1>
                <nav>
                    <ul>
                        <li><a href="schedule-user.php">Home</a></li>
                        <li><a href="Contact.php">Contact</a></li>
                        <li><a href="About.php">About</a></li>
                        <li><a href="Profile.php">Profile</a></li>
                        <li>
                            <form action="logout.php" method="post">
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

    <section class="contact-section">
        <h3>Get in Touch</h3>
        <p>If you have any questions or inquiries, feel free to contact us using the form below.</p>

        <form class="contact-form" action="send-mail.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        
            <button type="submit">Send Message</button>
        </form>
        
    </section>
    

    <!-- Question Mark Icon and Info Overlay -->
<div class="info-container">
    <div class="info-icon" onclick="toggleInfo()"><i class="fa-solid fa-question"></i></div>
    <div class="info-overlay" id="infoOverlay">
        <div class="info-content">
            <span class="close-btn" onclick="toggleInfo()">&times;</span>
            <h2>About This Website</h2>
            <p>This website is designed to provide information and services to our users. If you have any questions or need assistance, feel free to reach out using the contact form.</p>
        </div>
    </div>
</div>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 Dong Darong. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://web.facebook.com/rong453" target="_blank" class="facebook-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://t.me/Dong_Darong13" target="_blank" class="telegram-icon">
                    <i class="fab fa-telegram-plane"></i>
                </a>
            </div>
        </div>
    </footer>
    <script>
        function toggleInfo() {
    var overlay = document.getElementById('infoOverlay');
    if (overlay.style.display === 'flex') {
        overlay.style.display = 'none';
    } else {
        overlay.style.display = 'flex';
    }
}

    // Function to get query parameters from URL
    function getQueryParams() {
        let params = {};
        let search = window.location.search.substring(1);
        let pairs = search.split("&");
        for (let i = 0; i < pairs.length; i++) {
            let pair = pairs[i].split("=");
            params[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1] || "");
        }
        return params;
    }

    // Get query parameters
    const params = getQueryParams();

    // If the success parameter is present, show appropriate message
    if (params.success === 'true') {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Message sent successfully!",
            showConfirmButton: false,
            timer: 1500
        });
        
    } else if (params.success === 'false') {
        alert("Failed to send message. Please try again.");
    }
</script>



    
</body>
</html>
