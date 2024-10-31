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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Requests</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/schedule-user.css">
</head>
<body>
<header class="site-header">
    <h1>Lab Access Requests</h1>
    <nav>
        <ul>
            <li><a href="schedule-user.php">Home</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="About.html">About</a></li>
            <li><a href="Profile.php">Profile</a></li>
            <li>
                <form action="logout.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<main>
    <div class="card-container">
        <a href="b.php">
            <div class="card">
                <img src="https://cdn-icons-png.flaticon.com/512/4675/4675642.png" alt="Lab Image">
                <h2>Table Request</h2>
            </div>
        </a>
        <?php
        // Fetch lab data from the database
        $sql = "SELECT * FROM lab";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="card request-lab" data-lab-id="' . htmlspecialchars($row["ID"]) . '">';
                echo '<img src="' . htmlspecialchars($row["image-lab"]) . '" alt="Lab Image">';
                echo '<h2>' . htmlspecialchars($row["name_lab"]) . '</h2>';
                echo '</div>';
            }
        } else {
            echo '<p>No lab records found.</p>';
        }
        $con->close();
        ?>
    </div>
</main>

<!-- Custom Alert Modal -->
<div id="customAlert" class="modal">
    <div class="modal-content">
        <h2>Request Lab Access</h2>
        <span class="close-btn" aria-label="Close" onclick="closeCustomAlert()">&times;</span>
        
        <form id="labRequestForm" action="submit-request.php" method="post">
            <p>Please enter your information to request access:</p>
            <input type="hidden" id="lab_id" name="lab_id">
            <input type="date" id="date" name="date" required>
            <input type="text" id="subject" name="subject" placeholder="Enter your subject" required>
            <input type="text" id="generation" name="generation" placeholder="Enter your generation" required>
            <input type="text" id="app" name="app" placeholder="Enter your app" required>
            <input type="number" id="numberStudent" name="numberStudent" placeholder="Enter your number of students" required>
            <input type="text" id="other" name="other" placeholder="Other...">

            <!-- Session Selection Buttons -->
            <p>Select Session (Max 3)</p>
            <div class="session-inputs">
            <input type="checkbox" name="selectedSessions[]" value="1" onclick="limitSelection(this)">
            <input type="checkbox" name="selectedSessions[]" value="2" onclick="limitSelection(this)">
            <input type="checkbox" name="selectedSessions[]" value="3" onclick="limitSelection(this)">
            <input type="checkbox" name="selectedSessions[]" value="4" onclick="limitSelection(this)">
            <input type="checkbox" name="selectedSessions[]" value="5" onclick="limitSelection(this)">
            <input type="checkbox" name="selectedSessions[]" value="6" onclick="limitSelection(this)">
            </div>
            
            <input type="hidden" id="selectedSessions" >
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>
</div>

<footer class="site-footer">
    <p>Lab Access © 2023</p>
</footer>

<script>
let selectedSessions = [];

function openCustomAlert() {
    resetForm();
    document.getElementById("customAlert").style.display = "flex";
}

function closeCustomAlert() {
    document.getElementById("customAlert").style.display = "none";
}

function resetForm() {
    document.getElementById("date").value = "";
    document.getElementById("subject").value = "";
    document.getElementById("generation").value = "";
    document.getElementById("app").value = "";
    document.getElementById("numberStudent").value = "";
    document.getElementById("other").value = "";
    selectedSessions = [];
    document.querySelectorAll('.session-inputs input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
    document.getElementById('selectedSessions').value = '';
}

function limitSelection(checkbox) {
    const maxSelections = 3;
    const selectedCheckboxes = document.querySelectorAll("input[name='selectedSessions[]']:checked");

    if (selectedCheckboxes.length > maxSelections) {
        checkbox.checked = false; // Uncheck the checkbox if it exceeds the limit
        Swal.fire('You can select a maximum of 3 sessions.');
    }
}

document.querySelectorAll('.request-lab').forEach(card => {
    card.addEventListener('click', function(event) {
        event.preventDefault();
        const labId = this.getAttribute('data-lab-id');  // Make sure each card has this attribute
        document.getElementById("lab_id").value = labId;
        openCustomAlert();
    });
});
</script>

</body>
</html>
