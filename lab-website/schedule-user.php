<?php
require "db_connection.php"; // Include your database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Requests</title>
    <link rel="stylesheet" href="style/schedule-user.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            $sql = "SELECT * FROM lab"; // Replace 'lab' with your actual table name
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                // Loop through each lab record
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card request-lab">';
                    echo '<img src="https://cdn-icons-png.flaticon.com/512/4675/4675642.png" alt="Lab Image">';
                    echo '<h2>' . htmlspecialchars($row["name_lab"]) . '</h2>';
                    
                    // Check for lab_status key and output its value
                    if (isset($row["lab_status"])) {
                        if ($row["lab_status"] == "closed") {
                            echo '<p>The lab is closed.</p>';
                        } else {
                            echo '<p>The lab is open.</p>';
                        }
                    } else {
                        echo '<p>No lab status information available.</p>';
                    }
                    echo '<button type="button" onclick="openCustomAlert()">Request Access</button>'; // Button to open the modal
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
    <div id="customAlert" class="modal" style="display: none;">
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
                <button class="session-btn" data-session-id="1" onclick="selectSession(this)">1</button>
                <button class="session-btn" data-session-id="2" onclick="selectSession(this)">2</button>
                <button class="session-btn" data-session-id="3" onclick="selectSession(this)">3</button>
                <h3>Afternoon</h3>
                <br>
                <button class="session-btn" data-session-id="4" onclick="selectSession(this)">4</button>
                <button class="session-btn" data-session-id="5" onclick="selectSession(this)">5</button>
                <button class="session-btn" data-session-id="6" onclick="selectSession(this)">6</button>
            </div>
    
            <button type="button" onclick="submitRequest()" class="submit">Submit</button>
        </div>
    </div>

    <!-- Include external JavaScript file -->
    <script>
        function submitRequest() {
            const date = document.getElementById('date').value;
            const subject = document.getElementById('subject').value;
            const generation = document.getElementById('generation').value;
            const app = document.getElementById('app').value;
            const numberStudent = document.getElementById('numberStudent').value;
            const other = document.getElementById('other').value;
            
            // Collect selected session buttons
            const selectedSessions = Array.from(document.querySelectorAll('.session-btn.selected'))
                                          .map(btn => btn.dataset.sessionId);

            // Check if the maximum of 3 sessions is selected
            if (selectedSessions.length > 3) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You can select a maximum of 3 sessions!',
                });
                return;
            }

            // Prepare data for AJAX request
            const requestData = {
                date,
                subject,
                generation,
                app,
                numberStudent,
                other,
                session_id: selectedSessions
            };

            // Send data to PHP using fetch
            fetch('submit_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success!', 'Your request has been submitted.', 'success');
                    closeCustomAlert(); // Close the modal after submission
                } else {
                    Swal.fire('Error!', 'There was a problem submitting your request.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'There was an error with the request.', 'error');
            });
        }

        function selectSession(btn) {
            btn.classList.toggle('selected');
            alert(`Session ${btn.dataset.sessionId} selected!`);
        }

        function closeCustomAlert() {
            document.getElementById("customAlert").style.display = "none";
        }

        function openCustomAlert() {
            document.getElementById("customAlert").style.display = "block";
        }
    </script>
</body>
</html>
