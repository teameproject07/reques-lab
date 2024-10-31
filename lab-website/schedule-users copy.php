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
    <style>
        /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

/* Header Styling */
.site-header {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.site-header h1 {
    font-size: 2em;
}

.site-header nav ul {
    list-style-type: none;
    margin: 20px 0 0;
    padding: 0;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.site-header nav ul li {
    margin: 0 15px;
}

.site-header nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1.1em;
    transition: color 0.3s;
}

.site-header nav ul li a:hover {
    color: #ddd;
}

.site-header form button {
    background: #555;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background 0.3s;
}

.site-header form button:hover {
    background: #777;
}

/* Card Container Styling */
.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    padding: 20px;
}

.card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    width: 200px;
    transition: transform 0.3s;
    cursor: pointer;
}

.card:hover {
    transform: scale(1.05);
}

.card img {
    width: 100%;
    height: auto;
}

.card h2 {
    margin: 10px 0;
    padding: 10px;
    font-size: 1.2em;
    color: #333;
}

/* Modal Styling */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 400px;
    position: relative;
    text-align: center;
}

.modal-content h2 {
    margin-bottom: 20px;
    color: #333;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.5em;
    color: #333;
    cursor: pointer;
}



/* Form Styling */
#labRequestForm p {
    margin-bottom: 10px;
    font-size: 1em;
    color: #555;
}

#labRequestForm input[type="text"],
#labRequestForm input[type="date"],
#labRequestForm input[type="number"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

#labRequestForm .session-inputs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin: 10px 0;
}

#labRequestForm .session-inputs input[type="checkbox"] {
    transform: scale(1.2);
    cursor: pointer;
}

#labRequestForm .submit {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s;
}

#labRequestForm .submit:hover {
    background-color: #555;
}

/* Footer Styling */
.site-footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 20px;
}

.site-footer p {
    font-size: 1em;
    color: #aaa;
}

/* Media Queries */
@media (max-width: 768px) {
    .site-header nav ul {
        flex-direction: column;
    }
    .site-header nav ul li {
        margin: 10px 0;
    }
    .card-container {
        flex-direction: column;
        align-items: center;
    }
    .card {
        width: 100%;
        max-width: 250px;
    }
    .modal-content {
        width: 90%;
        max-width: 350px;
    }
}

@media (max-width: 480px) {
    .site-header h1 {
        font-size: 1.5em;
    }
    .site-header nav ul li a {
        font-size: 1em;
    }
    .card {
        width: 100%;
        max-width: 200px;
    }
    .modal-content {
        width: 90%;
        padding: 15px;
    }
    #labRequestForm input[type="text"],
    #labRequestForm input[type="date"],
    #labRequestForm input[type="number"] {
        padding: 8px;
    }
    #labRequestForm .submit {
        padding: 8px 16px;
    }
}

        .container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    max-width: 300px;
    margin: 0 auto;
  }
  
  .session-button {
    flex: 1 1 30%;
    padding: 15px;
    background-color: #333;
    color: white;
    border: none;
    text-align: center;
    cursor: pointer;
  }
  
  .session-button input[type="checkbox"] {
    display: none;
  }
  
  .session-button.selected {
    background-color: #555;
  }
    </style>
</head>
<body>
<header class="site-header">
    <h1>Lab Access Requests</h1>
    <nav>
        <ul>
            <li><a href="schedule-users copy.php">Home</a></li>
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
        
        <form id="labRequestForm" action="submit-request copy.php" method="post">
            <p>Please enter your information to request access:</p>
            <input type="hidden" id="lab_id" name="lab_id">
            <input type="date" id="date" name="date" required>
            <input type="text" id="subject" name="subject" placeholder="Enter your subject" required>
            <input type="text" id="generation" name="generation" placeholder="Enter your generation" required>
            <input type="text" id="app" name="app" placeholder="Enter your app" required>
            <input type="number" id="numberStudent" name="numberStudent" placeholder="Enter your number of students" required>
            <input type="text" id="other" name="other" placeholder="Other...">

            <!-- Session Selection Buttons -->
            <h3>Select Session (Max 3)</h3>
<div class="container">
  <label class="session-button" id="session1">
    1
    <input type="checkbox" name="selectedSessions[]" value="1" onclick="limitSelection(this)">
  </label>
  <label class="session-button" id="session2">
    2
    <input type="checkbox" name="selectedSessions[]" value="2" onclick="limitSelection(this)">
  </label>
  <label class="session-button" id="session3">
    3
    <input type="checkbox" name="selectedSessions[]" value="3" onclick="limitSelection(this)">
  </label>
  <label class="session-button" id="session4">
    4
    <input type="checkbox" name="selectedSessions[]" value="4" onclick="limitSelection(this)">
  </label>
  <label class="session-button" id="session5">
    5
    <input type="checkbox" name="selectedSessions[]" value="5" onclick="limitSelection(this)">
  </label>
  <label class="session-button" id="session6">
    6
    <input type="checkbox" name="selectedSessions[]" value="6" onclick="limitSelection(this)">
  </label>
</div>
            
            <input type="hidden" id="selectedSessions">
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
