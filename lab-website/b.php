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

// Modify SQL to group by lab_id, date, and session_id and use MIN(ID)
$sql = "SELECT MIN(i.ID) as min_id, i.*, u.full_name, u.phone, l.name_lab, i.subject
        FROM information i
        JOIN users u ON i.user_id = u.ID
        JOIN lab l ON i.lab_id = l.ID
        WHERE i.date BETWEEN '$startDateFormatted' AND '$endDateFormatted'
        GROUP BY i.lab_id, i.date, i.session_id
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

// Fetch data and populate schedule
while ($row = $result->fetch_assoc()) {
    // Determine the day of the week
    $dayOfWeek = date('l', strtotime($row['date']));

    // Map the session_id to your session keys
    $sessionMapping = [
        1 => 'session1',    // 07:00 - 08:30
        2 => 'session2',    // 09:00 - 10:20
        3 => 'session3'     // 10:30 - 12:00
    ];

    $sessionKey = $sessionMapping[$row['session_id']] ?? null;

    // If the session key is valid and the day exists in the schedule
    if ($sessionKey && array_key_exists($dayOfWeek, $schedule)) {
        // Append the data if it's a different lab_id or unique entry
        $schedule[$dayOfWeek][$sessionKey][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <!-- <link rel="stylesheet" href="style/table-request.css"> -->
</head>
<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

@font-face {
    font-family: 'KhmerOS';
    src: url('fonts/Khmer-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

/* Body Styling */
body {
    font-family: 'KhmerOS', Arial, sans-serif;
    background-color: #f3f4f6;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* Header Styling */
.header {
    background: linear-gradient(135deg, #2980b9, #2c3e50);
    color: white;
    padding: 20px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
}

.header h1 {
    margin: 0;
    font-size: 26px;
}

.header .menu {
    display: flex;
    gap: 20px;
}

.header .menu a, .header .back-button {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 8px 15px;
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.2);
    transition: background-color 0.3s ease;
}

.header .menu a:hover, .header .back-button:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

/* Schedule Table */
.schedule {
    width: 100%;
    margin: 20px 0;
}

.schedule table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
}

.schedule th, .schedule td {
    padding: 10px 8px; /* Adjusted for tighter padding */
    text-align: center;
    border: 1px solid #ddd;
    transition: background-color 0.2s ease;
    font-size: 14px;
}

.schedule th {
    background-color: #2c3e50;
    color: white;
}

.schedule td {
    background-color: #ffffff;
    font-size: 14px;
}

.schedule tr:nth-child(even) td {
    background-color: #f9f9f9;
}

.schedule tr:hover td {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow on hover */
    background-color: #eaf3fa;
}

/* Table Responsive Container */
.table-responsive {
    width: 95%;
    padding: 15px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    margin-bottom: 70px;
    overflow-x: auto;
}

/* Titles and Other Text */
h3 {
    color: #34495e;
    text-align: center;
    line-height: 1.6;
    margin: 25px 0;
    font-size: 22px;
    font-weight: bold;
}

p {
    color: #555;
    text-align: center;
    line-height: 1.6;
    margin: 20px 0;
    font-size: 15px;
}

/* Footer Styling */
.site-footer {
    background-color: #34495e;
    text-align: center;
    padding: 15px 0;
    width: 100%;
    color: #ecf0f1;
    position: fixed;
    bottom: 0;
}

.site-footer a {
    color: #ecf0f1;
    text-decoration: none;
    transition: color 0.3s;
}

.site-footer a:hover {
    color: #d1e0e0;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .header h1 {
        font-size: 24px;
    }
    .schedule th, .schedule td {
        padding: 10px;
        font-size: 14px;
    }
    .table-responsive {
        padding: 20px;
        margin: 15px;
    }
}

@media (max-width: 768px) {
    .header h1 {
        font-size: 22px;
    }
    .header {
        flex-direction: column;
        padding: 15px;
        text-align: center;
    }
    .header .menu {
        flex-direction: row;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 10px; /* Centering adjustment */
        text-align: center;
    }
    .header .menu a {
        font-size: 14px;
    }
    .schedule th, .schedule td {
        padding: 10px;
        font-size: 13px;
    }
    h3 {
        font-size: 18px;
    }
    p {
        font-size: 13px;
    }
}

@media (max-width: 576px) {
    .header h1 {
        font-size: 20px;
        margin-bottom: 10px;
    }
    .header .menu {
        flex-direction: column;
        gap: 10px;
    }
    .header .menu a {
        font-size: 13px;
    }
    .schedule th, .schedule td {
        padding: 8px;
        font-size: 12px;
    }
    .table-responsive {
        padding: 15px;
        margin: 10px;
    }
    h3 {
        font-size: 16px;
    }
    p {
        font-size: 12px;
    }
}

@media (max-width: 480px) {
    .header h1 {
        font-size: 18px;
    }
    .header {
        padding: 12px;
    }
    .header .menu a {
        font-size: 12px;
    }
    .schedule th, .schedule td {
        padding: 8px;
        font-size: 11px;
    }
    h3 {
        font-size: 14px;
    }
    p {
        font-size: 11px;
    }
}

</style>
<body>
    <!-- Header Section -->
    <div class="header">
        <a href="schedule-user.php" class="back-button">&larr;</a>
        <h1>តារាងកាលវិភាគប្រើប្រាស់បន្ទប់ប្រើប្រាស់កុំព្យូទ័រ ( វេនរសៀល )</h1>
        <div class="menu">
            <a href="table-request-morning.html">វេនព្រឹក</a>
            <a href="table-request-Afternoon.html">វេនរសៀល</a>
            <a href="Profile.php">Profile</a>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="table-responsive" >
        
        <div>
            <h3>
                <br>
                <?php if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន (lab IT,lab Network)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន (lab IT,lab Network)</span>
                <?php endif; ?>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th colspan="">អង្គារ</th>
                        <th colspan="">ពុធ</th>
                        <th colspan="">ប្រហស្បតិ៍</th>
                        <th colspan="">សុក្រ</th>
                        <th colspan="">សៅរ៍</th>
                        <th colspan="">អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (['session1' => 'សេសិនទី១', 'session2' => 'សេសិនទី២', 'session3' => 'សេសិនទី៣'] as $sessionId => $sessionTitle): ?>
                        <tr>
                            <td><strong><?php echo $sessionTitle; ?></strong><br>(<?php echo $sessionId === 'session1' ? '7:00 - 8:30' : ($sessionId === 'session2' ? '9:00 - 10:20' : '10:30 - 12:00'); ?>)<br></td>
                            <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                                <td>
                                    <?php if (!empty($schedule[$day][$sessionId])): ?>
                                        <table>
                                            <tr>
                                                <?php foreach ($schedule[$day][$sessionId] as $Data): ?>
                                                    <td>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['full_name']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['phone']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['name_lab']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['subject']}</strong><br>"; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    <?php else: ?>
                                       <strong>ទំនេរ</strong> 
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="table-responsive" >
        
        <div>
            <h3>
                <br>
                <?php if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលសំណងសុីវិល (lab civil)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលសំណងសុីវិល (lab civil)</span>
                <?php endif; ?>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th colspan="">អង្គារ</th>
                        <th colspan="">ពុធ</th>
                        <th colspan="">ប្រហស្បតិ៍</th>
                        <th colspan="">សុក្រ</th>
                        <th colspan="">សៅរ៍</th>
                        <th colspan="">អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (['session1' => 'សេសិនទី១', 'session2' => 'សេសិនទី២', 'session3' => 'សេសិនទី៣'] as $sessionId => $sessionTitle): ?>
                        <tr>
                            <td><strong><?php echo $sessionTitle; ?></strong><br>(<?php echo $sessionId === 'session1' ? '7:00 - 8:30' : ($sessionId === 'session2' ? '9:00 - 10:20' : '10:30 - 12:00'); ?>)<br></td>
                            <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                                <td>
                                    <?php if (!empty($schedule[$day][$sessionId])): ?>
                                        <table>
                                            <tr>
                                                <?php foreach ($schedule[$day][$sessionId] as $Data): ?>
                                                    <td>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['full_name']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['phone']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['name_lab']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['subject']}</strong><br>"; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    <?php else: ?>
                                       <strong>ទំនេរ</strong> 
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="table-responsive" >
        
        <div>
            <h3>
                <br>
                <?php if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលទូទៅ (lab010,lab13)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលទូទៅ​ (lab010,lab13)</span>
                <?php endif; ?>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th colspan="">អង្គារ</th>
                        <th colspan="">ពុធ</th>
                        <th colspan="">ប្រហស្បតិ៍</th>
                        <th colspan="">សុក្រ</th>
                        <th colspan="">សៅរ៍</th>
                        <th colspan="">អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (['session1' => 'សេសិនទី១', 'session2' => 'សេសិនទី២', 'session3' => 'សេសិនទី៣'] as $sessionId => $sessionTitle): ?>
                        <tr>
                            <td><strong><?php echo $sessionTitle; ?></strong><br>(<?php echo $sessionId === 'session1' ? '7:00 - 8:30' : ($sessionId === 'session2' ? '9:00 - 10:20' : '10:30 - 12:00'); ?>)<br></td>
                            <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                                <td>
                                    <?php if (!empty($schedule[$day][$sessionId])): ?>
                                        <table>
                                            <tr>
                                                <?php foreach ($schedule[$day][$sessionId] as $Data): ?>
                                                    <td>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['full_name']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['phone']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['name_lab']}</strong><br>"; ?>
                                                        <?php echo "<strong style='line-height: 1.5;'>{$Data['subject']}</strong><br>"; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </table>
                                    <?php else: ?>
                                       <strong>ទំនេរ</strong> 
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
