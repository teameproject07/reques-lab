<?php

require "db_connection.php"; // Include your database connection
session_start();
$username = $_SESSION['username'] ?? ''; // Fetch username from session
if (empty($username)) {
    echo "Session username not set or empty.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
    <link rel="stylesheet" href="style/About.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <!-- Header Section -->
    <header class="site-header">
        <div class="container">
            <h1>About</h1>
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

    <!-- Main Content Section -->
    <main class="about-content">
        <section class="introduction">
            <h2>សូមស្វាគមន៍មកកាន់គេហទំព័ររបស់យើង</h2>
            <p>ពួកយើងជាសិស្សជំនាញ បច្ចេកវិទ្យាព័ត៍មាន។ ពួកយើងមានបំណងចង់ជួយសម្រួលដល់អ្នកគ្រូ លោកគ្រូមានភាពងាយស្រួលក្នុងការស្នើរសុំប្រើប្រាស់សាលកុំព្យូរទ័រ។</p>
        </section>

        <section class="mission">
            <h2>បេសកកម្មរបស់យើង</h2>
            <p>បេសកកម្មរបស់យើងគឺផ្តល់នូវឱកាសឱ្យគ្រប់គ្នាបង្កើតការផ្លាស់ប្តូរដ៏ល្អសម្រាប់សង្គម។ ពួកយើងគាំទ្រការអភិវឌ្ឍបច្ចេកវិទ្យា និងចំណេះដឹងថ្មីៗក្នុងពិភពលោកបច្ចេកវិទ្យា។</p>
        </section>

        <section class="vision">
            <h2>ចក្ខុវិស័យរបស់យើង</h2>
            <p>យើងបង្កើតវេបសាយមួយនេះឡើងដើម្បីផ្តល់ភាពអាយស្រួលដល់ការស្នើរសុំប្រើប្រាស់សាលកុំព្យូទ័រ និងការច្នៃប្រឌិតថ្មីៗ។ ពួកយើងនឹងបន្តការជំរុញការបង្កើតនិងអភិវឌ្ឍវិស័យនេះជានិច្ច។</p>
        </section>

        <section class="team">
            <h2>ក្រុមការងាររបស់យើង</h2>
            <p>ក្រុមការងាររបស់យើងមានកម្លាំងផ្តោតលើការច្នៃប្រឌិត និងការប្តេជ្ញាក្នុងការបំពេញបេសកកម្មរបស់យើង។</p>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 Dong Darong. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
