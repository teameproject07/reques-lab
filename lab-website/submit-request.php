<?php
require "db_connection.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Extract data from the form POST request
    $date = $_POST['date'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $generation = $_POST['generation'] ?? '';
    $app = $_POST['app'] ?? '';
    $numberStudent = $_POST['numberStudent'] ?? 0;
    $other = $_POST['other'] ?? '';
    $sessions = $_POST['selectedSessions'] ?? '';

    // Prepare SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO information (date, subject, generation, app, number_students, other, session_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $date, $subject, $generation, $app, $numberStudent, $other, $sessions);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Success: show a SweetAlert success message and then redirect
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Request successfully submitted!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'schedule-user.php';
                }
            });
        </script>";
    } else {
        // Error: output the error for debugging
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an issue submitting your request: " . $con->error . "'
            });
        </script>";
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();

} else {
    // Handle invalid request methods
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
