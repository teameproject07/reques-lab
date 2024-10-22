<?php
require "db_connection.php"; // Include your database connection

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $generation = $_POST['generation'];
    $app = $_POST['app'];
    $numberStudent = $_POST['numberStudent'];
    $other = $_POST['other'];
    $sessions = $_POST['selectedSessions']; // Sessions will be a comma-separated string

    // Prepare SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO information (date, subject, generation, app, number_students, other, session_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $date, $subject, $generation, $app, $numberStudent, $other, $sessions);

    // Execute and handle the response
    if ($stmt->execute()) {
        // Success response
        echo json_encode(["success" => true]);
    } else {
        // Error response
        echo json_encode(["success" => false, "error" => $con->error]);
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
