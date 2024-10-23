<?php
require "db_connection.php"; // Include your database connection
 // Include your database query
// Ensure the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Extract data from the form POST request
    $date = $_POST['date'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $generation = $_POST['generation'] ?? '';
    $app = $_POST['app'] ?? '';
    $numberStudent = $_POST['numberStudent'] ?? 0;
    $other = $_POST['other'] ?? '';
    $lab_id = $_POST['lab_id']?? 0; // Add the lab ID if needed for your application
    
    // Extract the selected sessions, and ensure it's sanitized before inserting into the DB
    $sessions = $_POST['selectedSessions'] ?? '';
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO information (date, subject, generation, app, number_students, other, session_id, lab_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Bind the parameters to the statement
    $stmt->bind_param("ssssisss", $date, $subject, $generation, $app, $numberStudent, $other, $sessions, $lab_id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        
        // Send a JSON response back (success message can be customized or a redirect can be handled here)
        // echo json_encode(["success" => true, "message" => "Request successfully submitted!"]);
    //     echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'>
    // Swal.fire({
    //     icon: 'error',
    //     title: 'Error!',
    //     text: 'Please fill out all fields and select up to 3 sessions.',
    // });
    // </script>";
    header("Location: schedule-users copy.php");
    } else {
        // In case of an error, output the error for debugging
        echo json_encode(["success" => false, "error" => $con->error]);
    }

    // Close the statement and the connection
    $stmt->close();
    $con->close();

} else {
    // Handle invalid request methods
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}


