<?php
require "db_connection.php";
// Create a DateTime object for today
$today = new DateTime();

// Clone the object to calculate start date (Monday of the current week)
$startDate = clone $today;
$startDate->modify('monday this week');

// Clone the object to calculate end date (Sunday of the current week)
$endDate = clone $today;
$endDate->modify('sunday this week');

// Format the dates for the SQL query
$startDateFormatted = $startDate->format('Y-m-d');
$endDateFormatted = $endDate->format('Y-m-d');

// Modify SQL to group by lab_id, date, and session_id, use MIN(ID), and filter for IT and Network labs
$sql = "SELECT MIN(i.ID) as min_id, i.*, u.full_name, u.phone, l.name_lab, i.subject
        FROM information i
        JOIN users u ON i.user_id = u.ID
        JOIN lab l ON i.lab_id = l.ID
        WHERE i.date BETWEEN '$startDateFormatted' AND '$endDateFormatted'
        AND (l.name_lab = 'Lab civil')  /* Filter only IT and Network labs */
        GROUP BY i.lab_id, i.date, i.session_id
        ORDER BY i.date, i.session_id ASC";

$result = $con->query($sql);

if (!$result) {
    die("Query failed: " . $con->error);
}

$schedule = [
    'Monday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Tuesday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Wednesday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Thursday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Friday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Saturday' => ['session4' => [], 'session5' => [], 'session6' => []],
    'Sunday' => ['session4' => [], 'session5' => [], 'session6' => []],
];

// Fetch data and populate schedule
while ($row = $result->fetch_assoc()) {
    // Determine the day of the week
    $dayOfWeek = date('l', strtotime($row['date']));

    // Map the session_id to your session keys
    $sessionMapping = [
        4 => 'session4',    // 02:00 - 03:30
        5 => 'session5',    // 03:40 - 04:50
        6 => 'session6'     // 05:00 - 06:30
    ];

    $sessionKey = $sessionMapping[$row['session_id']] ?? null;

    // If the session key is valid and the day exists in the schedule
    if ($sessionKey && array_key_exists($dayOfWeek, $schedule)) {
        // Append the data if it's a different lab_id or unique entry
        $schedule[$dayOfWeek][$sessionKey][] = $row;
    }
}




