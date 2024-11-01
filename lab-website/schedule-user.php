<?php

require "db_connection.php"; // Include your database connection
// session_start();
// $username = $_SESSION['username'] ?? ''; // Fetch username from session
// if (empty($username)) {
//     echo "Session username not set or empty.";
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Requests</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/schedule-user.css">
    <style>
/* Reset styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Container setup */
.container {
    width: 80%;
    margin: 0 auto;
    max-width: 1200px;
}

/* Anchor and Button Styles */
a {
    text-decoration: none;
    color: inherit;
}

button {
    font-size: 1.1rem;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    transition: color 0.3s;
}

button:hover {
    color: #FFD700;
}

/* Header Styles */
.site-header {
    background-color: #4CAF50;
    padding: 15px 0;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.site-header h1 {
    color: white;
    font-size: 2rem;
    font-weight: 600;
}

.site-header nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
}

.site-header nav ul li {
    margin: 0 15px;
}

.site-header nav ul li a {
    color: white;
    font-size: 1.1rem;
}

.site-header nav ul li a:hover {
    color: #FFD700;
}

/* Profile Card */
.profile-card {
    max-width: 600px;
    margin: 30px auto;
    background-color: #888686;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

/* Card Styles */
.card-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 2em;
    gap: 2em;
}

.card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 250px;
    padding: 1em;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card img {
    max-width: 150px;
    margin-bottom: 1em;
}

.card h2 {
    font-size: 1.4em;
    margin-bottom: 0.5em;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Modal Styling */
.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    padding: 2em;
    z-index: 1000;
}

.modal-content h2 {
    margin-bottom: 1em;
}

.modal input {
    width: 100%;
    padding: 0.8em;
    margin: 0.5em 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.modal button {
    padding: 0.8em 1.2em;
    background-color: #333;
    color: white;
    border-radius: 4px;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 1.5em;
    cursor: pointer;
}

/* Session Button Styling */
.session-container {
    font-family: Arial, sans-serif;
}

.session-container label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.session-inputs {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.session {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #4b5057;
    color: #fff;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    text-align: center;
    user-select: none;
}
.session:hover{
    background-color: #7caff2;
}
.session.selected{
    background-color: #17438a;
    color: white;
}
.session input[type="checkbox"] {
    display: none;
    
}

.session input[type="checkbox"]:checked + label {
    background-color: #945454;
}

/* Footer Styling */
.site-footer {
    text-align: center;
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    font-size: 1rem;
    position: fixed;
    width: 100%;
    bottom: 0;
}

/* Responsive Styles */
@media (max-width: 600px) {
    .card-container {
        flex-direction: column;
        align-items: center;
    }

    .modal {
        width: 95%;
    }

    .session-inputs {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
}

@media (min-width: 601px) and (max-width: 768px) {
    .card-container {
        justify-content: space-evenly;
    }

    .modal {
        width: 80%;
        max-width: 600px;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .card-container {
        justify-content: space-between;
    }

    .modal {
        width: 75%;
        max-width: 700px;
    }
}

@media (min-width: 1025px) {
    .card-container {
        justify-content: center;
    }

    .modal {
        width: 60%;
        max-width: 700px;
    }
}

    </style>
</head>
<body>
<header class="site-header">
    <h1>Lab Access Requests</h1>
    <nav>
        <ul>
            <li><a href="schedule-user.php">Home</a></li>
            <li><a href="Contact.html">Contact</a></li>
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
        <a href="table-request-Afternoon.php">
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
            <div class="session-container">
    <label>Select Session (Max 3)</label>
    <div class="session-inputs">
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="1" onclick="limitSelection(this)">
            1
        </label>
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="2" onclick="limitSelection(this)">
            2
        </label>
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="3" onclick="limitSelection(this)">
            3
        </label>
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="4" onclick="limitSelection(this)">
            4
        </label>
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="5" onclick="limitSelection(this)">
            5
        </label>
        <label class="session">
            <input type="checkbox" name="selectedSessions[]" value="6" onclick="limitSelection(this)">
            6
        </label>
    </div>
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

    // Uncheck all session checkboxes
    document.querySelectorAll('.session-inputs input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
        checkbox.closest('label').classList.remove('selected');
    });

    document.getElementById('selectedSessions').value = '';
}

function limitSessionSelection(checkbox) {
    const maxSelections = 3;
    const selectedCheckboxes = document.querySelectorAll("input[name='selectedSessions[]']:checked");

    if (selectedCheckboxes.length > maxSelections) {
        checkbox.checked = false; // Uncheck the checkbox if it exceeds the limit
        Swal.fire('You can select a maximum of 3 sessions.');
    } else {
        checkbox.closest('label').classList.toggle('selected', checkbox.checked);
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

// Attach the limitSessionSelection function to checkboxes
document.querySelectorAll("input[name='selectedSessions[]']").forEach(checkbox => {
    checkbox.addEventListener('click', function() {
        limitSessionSelection(this);
    });
});

</script>

</body>
</html>

