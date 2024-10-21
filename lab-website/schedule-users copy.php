<?php
// Database Connection
// $servername = "localhost";
// $username = "your_db_username";
// $password = "your_db_password";
// $dbname = "your_database";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
require "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Requests</title>
    <!-- <link rel="stylesheet" href="style/schedule-user.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reset some default styles */
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

.container {
    width: 80%;
    margin: 0 auto;
    max-width: 1200px;
}

a {
    text-decoration: none;
    color: inherit;
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
    margin-bottom: 10px;
    font-weight: 600;
}

.site-header nav ul {
    list-style: none;
}

.site-header nav ul li {
    display: inline-block;
    margin-right: 20px;
}

.site-header nav ul li a {
    color: white;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.site-header nav ul li a:hover {
    color: #FFD700; /* Gold color for hover */
}

button {
    font-size: 1.1rem;
    background-color: #4CAF50;
    color: white;
    padding: auto;
    border: none;
    cursor: pointer;
}

button:hover {
    color: #FFD700;
}

/* Profile Card Styles */
.profile-card {
    max-width: 600px;
    margin: 30px auto;
    background-color: #888686;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
}

/* Card Container */
.card-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 2em;
    gap: 2em;
}

/* Card Styling */
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

.card p {
    font-size: 1em;
    color: #666;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    cursor: pointer;
}

.table-request {
    color: #333;
    text-decoration: none;
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
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.modal button:hover {
    background-color: #778cf5;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 1.5em;
    cursor: pointer;
}

/* Session buttons styling */
.session-buttons {
    display: flex;
    justify-content: space-around;
    margin-top: 1em;
    margin-bottom: 20px;
}

.session-btn {
    padding: 0.8em 1.5em;
    background-color: #eee;
    border: 1px solid #ccc;
    cursor: pointer;
}

.session-btn.selected {
    background-color: #3d74e4;
    color: white;
}

.session-btn:hover {
    background-color: #ddd;
}

.modal button.submit {
    background-color: #1d56a6;
    text-align: center;
    width: 100%;
    padding: 15px 0;
    font-size: 20px;
    border-radius: 10px;
    border: none;
    color: #f7f5f5;
}

.modal button.submit:hover {
    background-color: #253848;
}

/* Footer Styles */
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

.site-footer p {
    margin: 0;
}

/* Responsive Styling */

/* For smartphones (max-width: 600px) */
@media (max-width: 600px) {
    .card-container {
        flex-direction: column;
        align-items: center;
    }

    .card .table-request {
        width: 100%;
        max-width: 350px;
    }

    .modal {
        width: 95%;
    }

    .session-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 10px;
    }

    nav a {
        margin: 0 0.5em;
        font-size: 1em;
    }

    .modal input,
    .modal button {
        font-size: 16px;
        padding: 0.5em;
    }

    footer {
        font-size: 0.9em;
    }
}

/* For tablets (601px to 768px) */
@media (min-width: 601px) and (max-width: 768px) {
    .card-container {
        flex-direction: row;
        justify-content: space-evenly;
    }

    .card .table-request {
        width: 45%;
    }

    .modal {
        width: 80%;
        max-width: 600px;
    }

    nav a {
        margin: 0 1em;
        font-size: 1.05em;
    }

    .session-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 10px;
    }

    footer {
        padding: 0.5em;
        font-size: 1em;
    }
}

/* For tablets and small desktops (769px to 1024px) */
@media (min-width: 769px) and (max-width: 1024px) {
    .card-container {
        justify-content: space-between;
    }

    .card .table-request {
        width: 30%;
    }

    .modal {
        width: 75%;
        max-width: 700px;
    }

    nav a {
        margin: 0 1em;
        font-size: 1.1em;
    }

    .session-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 10px;
    }
}

/* For larger screens (min-width: 1025px) */
@media (min-width: 1025px) {
    .card-container {
        justify-content: center;
    }

    .card {
        width: 250px;
    }

    nav a {
        font-size: 1.2em;
    }

    .modal {
        width: 60%;
        max-width: 700px;
    }

    .session-buttons {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 10px;
    }

    footer {
        font-size: 1.1em;
        padding: 1.5em 0;
    }
}

    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="site-header">
        <div class="container">
            <h1>Welcome to Request Lab</h1>
            <nav>
                <ul>
                    <li><a href="schedule-user.html">Home</a></li>
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
        </div>
    </header>

    <!-- Main Content Section -->
    <main>
        <div class="card-container">
            <?php
            // Fetch data from the database
            $sql = "SELECT * FROM lab"; // Replace 'labs' with your actual table name
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Loop through each lab record
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card request-lab">';
                    echo '<img src="https://cdn-icons-png.flaticon.com/512/4675/4675642.png" alt="Lab Image">';
                    echo '<h2>' . htmlspecialchars($row["name_lab"]) . '</h2>';
                    if ($row["lab_status"] == "closed") {
                        echo '<p>The lab is closed.</p>';
                    } else {
                        echo '<p>The lab is open.</p>';
                    }
                    echo '</div>';
                }
            } else {
                echo '<p>No lab records found.</p>';
            }

            // Close the database connection
            $con->close();
            ?>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 Dong Darong. All rights reserved.</p>
        </div>
    </footer>

    <!-- Custom Alert Modal -->
    <div id="customAlert" class="modal">
        <div class="modal-content">
            <h2>Request Lab Access</h2>
            <span class="close-btn" aria-label="Close" onclick="closeCustomAlert()">&times;</span>
            <p>Please enter your information to request access:</p>
            <input type="date" id="date">
            <input type="text" id="subject" placeholder="Enter your subject">
            <input type="text" id="generation" placeholder="Enter your generation">
            <input type="text" id="app" placeholder="Enter your app">
            <input type="number" id="numberStudent" placeholder="Enter your number of students">
            <input type="text" id="other" placeholder="Other...">
    
            <!-- Session Selection Buttons -->
            <p>Select Session (Max 3)</p>
            <div class="session-buttons">
                <button class="session-btn" onclick="selectSession(this)">1</button>
                <button class="session-btn" onclick="selectSession(this)">2</button>
                <button class="session-btn" onclick="selectSession(this)">3</button>
                <h3>Afternoon</h3>
                <br>
                <button class="session-btn" onclick="selectSession(this)">4</button>
                <button class="session-btn" onclick="selectSession(this)">5</button>
                <button class="session-btn" onclick="selectSession(this)">6</button>
            </div>
    
            <button type="button" onclick="submitRequest()" class="submit">Submit</button>
        </div>
    </div>

    <!-- Include external JavaScript file -->
    <script >
        let selectedSessions = [];

// Function to open the custom alert modal and clear previous requests
function openCustomAlert() {
    resetForm(); // Clear the form and reset session selections
    document.getElementById("customAlert").style.display = "flex";
}

// Function to close the custom alert modal
function closeCustomAlert() {
    document.getElementById("customAlert").style.display = "none";
}

// Function to reset the form and clear session selections
function resetForm() {
    // Clear all input fields
    document.getElementById("date").value = "";
    document.getElementById("subject").value = "";
    document.getElementById("generation").value = "";
    document.getElementById("app").value = "";
    document.getElementById("numberStudent").value = "";
    document.getElementById("other").value = "";

    // Clear selected sessions
    selectedSessions = [];
    document.querySelectorAll('.session-btn').forEach(function(button) {
        button.classList.remove('selected'); // Remove the 'selected' class from all session buttons
    });
}

// Function to select/deselect a session
function selectSession(button) {
    const maxSessions = 3;
    const sessionNumber = button.textContent.trim();

    if (selectedSessions.includes(sessionNumber)) {
        // Deselect the session
        selectedSessions = selectedSessions.filter(num => num !== sessionNumber);
        button.classList.remove('selected');
    } else if (selectedSessions.length < maxSessions) {
        // Select the session
        selectedSessions.push(sessionNumber);
        button.classList.add('selected');
    } else {
        Swal.fire('Maximum 3 sessions can be selected.');
    }
}

// Function to handle the submission of the alert form
function submitRequest() {
    const date = document.getElementById("date").value;
    const subject = document.getElementById("subject").value;
    const generation = document.getElementById("generation").value;
    const app = document.getElementById("app").value;
    const numberStudent = document.getElementById("numberStudent").value;
    const other = document.getElementById("other").value;

    // Validate form fields
    if (date && subject && generation && app && numberStudent && selectedSessions.length > 0) {
        Swal.fire({
            position: "top-center",
            icon: "success",
            title: "Your request was successfully submitted",
            showConfirmButton: false,
            timer: 1500
        });
        closeCustomAlert();
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Please fill in all fields and select at least one session."
        });
    }
}

// Attach click event to 'request-lab' boxes
document.querySelectorAll('.request-lab').forEach(function(card) {
    card.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default action if card contains a link
        openCustomAlert(); // Show the custom alert modal
    });
});

    </script>
</body>
</html>