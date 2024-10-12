<?php
require "db_connection.php"; // Include your database connection

// Read the JSON input from the request
$data = json_decode(file_get_contents("php://input"), true);

// Extract data from the request
$date = $data['date'];
$subject = $data['subject'];
$generation = $data['generation'];
$app = $data['app'];
$numberStudent = $data['numberStudent'];
$other = $data['other'];
$sessions = implode(',', $data['session_id']); // Convert sessions array to a string

// Prepare SQL statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO information (date, subject, generation, app, number_students, other, session_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiss", $date, $subject, $generation, $app, $numberStudent, $other, $sessions);

if ($stmt->execute()) {
    // Send a JSON response back to the JavaScript
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $con->error]);
}

// Close the statement and the connection
$stmt->close();
$con->close();
?>
