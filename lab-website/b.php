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

$sql = "SELECT i.*, u.full_name, u.phone, l.name_lab, i.subject
        FROM information i 
        JOIN users u ON i.user_id = u.ID 
        JOIN lab l ON i.lab_id = l.ID
        WHERE i.date BETWEEN '$startDateFormatted' AND '$endDateFormatted'
        ORDER BY i.date, i.session_id ASC";
$result = $con->query($sql);

if (!$result) {
    die("Query failed: " . $con->error);
}


$schedule = [
    'Monday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Tuesday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Wednesday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Thursday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Friday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Saturday' => ['session1' => [], 'session2' => [], 'session3' => []],
    'Sunday' => ['session1' => [], 'session2' => [], 'session3' => []],
];


// Existing code...
while ($row = $result->fetch_assoc()) {
    // Determine the day of the week
    $dayOfWeek = date('l', strtotime($row['date']));

    // Map the session_id to your session keys
    $sessionMapping = [
        1 => 'session1',           // 07:00 - 08:30
        2 => ['session1', 'session2'], // 07:00 - 10:20
        3 => ['session1', 'session2', 'session3'], // 07:00 - 12:00
    ];

    $sessionKeys = $sessionMapping[$row['session_id']] ?? null;

    if ($sessionKeys && array_key_exists($dayOfWeek, $schedule)) {
        // If it's a single session key, wrap it in an array for consistency
        if (!is_array($sessionKeys)) {
            $sessionKeys = [$sessionKeys];
        }

        // Append the row to the session array for each session key
        foreach ($sessionKeys as $sessionKey) {
            $schedule[$dayOfWeek][$sessionKey][] = $row;
        }
    }
}

// The rest of your code remains unchanged...



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="style/table-request.css">
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <a href="schedule-user.html" class="back-button">&larr;</a>
        <h1>តារាងកាលវិភាគប្រើប្រាស់បន្ទប់ប្រើប្រាស់កុំព្យូទ័រ ( វេនរសៀល )</h1>
        <div class="menu">
            <a href="table-request-morning.html">វេនព្រឹក</a>
            <a href="table-request-Afternoon.html">វេនរសៀល</a>
            <a href="#">ទាញយក PDF file</a>
            <a href="Profile.php">Profile</a>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="table-responsive">
        <div class="titles">
            <div class="tital2">
                <h3>ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
            </div>
            <div class="tital1">
                <h3>សាកលវិទ្យាល័យជាតិបាត់ដំបង <br> មហាវិទ្យាល័យវិទ្យាសាស្ត្រ នឹង បច្ចេកវិទ្យា</h3>
            </div>
        </div>
        <div>
            <h3>
                <br>
                <?php if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន</span>
                <?php endif; ?>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th>ច័ន្ទ</th>
                        <th>អង្គារ</th>
                        <th>ពុធ</th>
                        <th>ប្រហស្បតិ៍</th>
                        <th>សុក្រ</th>
                        <th>សៅរ៍​</th>
                        <th>អាទិត្យ</th>
                    </tr>
                </thead>
               <tbody>
    <?php foreach (['session1' => 'សេសិនទី១', 'session2' => 'សេសិនទី២', 'session3' => 'សេសិនទី៣'] as $sessionId => $sessionTitle): ?>
        <tr>
            <td><strong><?php echo $sessionTitle; ?></strong><br>(<?php echo $sessionId === 'session1' ? '7:00 - 8:30' : ($sessionId === 'session2' ? '9:00 - 10:20' : '10:30 - 12:00'); ?>)<br></td>
            <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                <td>
                    <?php if (!empty($schedule[$day][$sessionId])): ?>
                        <?php foreach ($schedule[$day][$sessionId] as $Data): ?>
                            
                            <?php echo  "<strong>ឈ្មោះ៖</strong>{$Data['full_name']}" ?><br>
                            <?php echo "<strong>លេខទូរស័ព្ទ៖</strong> {$Data['phone']}" ?><br>
                            <?php echo "<strong>បន្ទប់៖</strong> {$Data['name_lab']}<br>"?>
                            <?php echo "<strong>មុខវិជ្ជា</strong> {$Data['subject']}<br>"?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        គ្មានទិន្នន័យ
                    <?php endif; ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>

</html>