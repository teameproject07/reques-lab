<?php

require "db_connection.php";
session_start();
$username = $_SESSION['username'] ?? ''; // Fetch username from session
if (empty($username)) {
    echo "Session username not set or empty.";
    exit;
}

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
        <a href="schedule-user.php" class="back-button">&larr;</a>
        <h1>តារាងកាលវិភាគប្រើប្រាស់បន្ទប់ប្រើប្រាស់កុំព្យូទ័រ ( វេនព្រឹក )</h1>
        <div class="menu">
            <a href="table-request-morning.php">វេនព្រឹក</a>
            <a href="table-request-Afternoon.php">វេនរសៀល</a>
            <a href="Profile.php">Profile</a>
        </div>
    </div>

 <!-- Main Content Section -->
 <div class="table-responsive" >
        
        <div>
            <h3>
                <br>
                <?php
                 require_once "table-morning-IT-NW.php";
                 if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន (lab IT , lab Network)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date" style="color:red;"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន (lab IT , lab Network)</span>
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
                <?php
                 require_once "table-morning-010-013.php";
                 if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលទូទៅ (lab010 , lab013)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date" style="color:red;"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលទូទៅ (lab010 , lab013)</span>
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
                <?php
                 require_once "table-morning-lab-civil.php";
                 if ($startDateFormatted === $endDateFormatted): ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $startDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $startDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលសំណងសុីវិល (lab civil)</span>
                <?php else: ?>
                    សម្រាប់ថ្ងៃទី <span class="date" style="color:red;"><?php echo $startDate->format('d'); ?></span> ​ដល់ថ្ងៃទី <span
                        class="date" style="color:red;"><?php echo $endDate->format('d'); ?></span> ខែ <span
                        class="date" style="color:red;"><?php echo $endDate->format('m'); ?></span> ឆ្នាំ <span
                        class="date" style="color:red;"><?php echo $endDate->format('Y'); ?></span> <span
                        style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលសំណង់សុីវិល (lab civil)</span>
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
   
