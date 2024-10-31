<?php
session_start();
require "db_connection.php"; // Connect to database

// Check for logged-in user
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    echo "Please log in to submit a lab request.";
    exit;
}

// Get user ID from the database
$userQuery = $con->prepare("SELECT ID FROM users WHERE username = ?");
$userQuery->bind_param("s", $username);
$userQuery->execute();
$userQuery->bind_result($user_id);
$userQuery->fetch();
$userQuery->close();

if (!$user_id) {
    echo "User not found.";
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $generation = $_POST['generation'] ?? '';
    $app = $_POST['app'] ?? '';
    $numberStudent = $_POST['numberStudent'] ?? 0;
    $other = $_POST['other'] ?? '';
    $lab_id = $_POST['lab_id'] ?? 0;
    $sessions = $_POST['selectedSessions'] ?? [];

    // Check if lab exists
    if (!checkIfExists($con, "lab", "ID", $lab_id)) {
        echo "Lab not found.";
        exit;
    }

    // Prepare insert query for each session
    $stmt = $con->prepare("INSERT INTO information (user_id, date, subject, generation, app, number_students, other, session_id, lab_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $allInserted = true;
    foreach ($sessions as $session) {
        // Check if session exists
        if (!checkIfExists($con, "session", "ID", $session)) {
            echo "Session not found.";
            $allInserted = false;
            break;
        }

        // Insert record if session exists
        $stmt->bind_param("issssisii", $user_id, $date, $subject, $generation, $app, $numberStudent, $other, $session, $lab_id);
        if (!$stmt->execute()) {
            $allInserted = false;
            break;
        }
    }

    $stmt->close();
    $con->close();

    // Redirect or show error
    if ($allInserted) {
        header("Location: schedule-user.php");
        exit;
    } else {
        echo "Error submitting request.";
    }
} else {
    echo "Invalid request method.";
}

// Helper function to check existence in a table
function checkIfExists($con, $table, $column, $value) {
    $query = $con->prepare("SELECT COUNT(*) FROM $table WHERE $column = ?");
    $query->bind_param("i", $value);
    $query->execute();
    $query->bind_result($exists);
    $query->fetch();
    $query->close();
    return $exists > 0;
}
?>
