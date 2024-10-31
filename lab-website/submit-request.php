<?php
require "db_connection.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'] ?? '';  // Assuming date and other fields are collected elsewhere in the form
    $subject = $_POST['subject'] ?? '';
    $generation = $_POST['generation'] ?? '';
    $app = $_POST['app'] ?? '';
    $numberStudent = $_POST['numberStudent'] ?? 0;
    $other = $_POST['other'] ?? '';
    $lab_id = $_POST['lab_id'] ?? 0;

    // Retrieve selected sessions from form
    $sessions = $_POST['selectedSessions'] ?? [];

    // Prepare the SQL statement to insert each session separately
    $stmt = $con->prepare("INSERT INTO information (date, subject, generation, app, number_students, other, session_id, lab_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Track if all insertions are successful
    $allInserted = true;

    foreach ($sessions as $session) {
        $stmt->bind_param("ssssissi", $date, $subject, $generation, $app, $numberStudent, $other, $session, $lab_id);

        if (!$stmt->execute()) {
            $allInserted = false;
            break;
        }
    }

    $stmt->close();
    $con->close();

    // Redirect if successful, or show an error message
    if ($allInserted) {
        header("Location: schedule-user.php");
    } else {
        echo "Error: Unable to submit your request.";
    }
} else {
    echo "Invalid request method.";
}
?>
