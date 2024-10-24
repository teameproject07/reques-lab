<?php 
require "db_connection.php";
$sql = "SELECT * FROM information";
$result = $con->query($sql);
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
                <h3>
                    ព្រះរាជាណាចក្រកម្ពុជា <br>
                    ជាតិ សាសនា ព្រះមហាក្សត្រ
                </h3>
            </div>
            <div class="tital1">
                <h3>
                    សាកលវិទ្យាល័យជាតិបាត់ដំបង <br>
                    មហាវិទ្យាល័យវិទ្យាសាស្ត្រ នឹង បច្ចេកវិទ្យា
                </h3>
            </div>
        </div>
        <div>
            <h3>
                <br>
                សម្រាប់ថ្ងៃទី <span class="date">១៩</span> ​ដល់ថ្ងៃទី <span class="date">២៥</span> ខែ <span class="date">សីហា​</span> ឆ្នាំ <span class="date">២០២៤</span> <span style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលបច្ចេកវិទ្យាព័ត៏មាន</span>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th>អង្គារ</th>
                        <th>ពុធ</th>
                        <th>ប្រហស្បតិ៍</th>
                        <th>សុក្រ</th>
                        <th>សៅរ៍​</th>
                        <th>អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lap14
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                           
                        </td>
                        
                    </tr>
                
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tital3">
            <p>
                ថ្ងៃ សៅរ៍​ ១៣ កើត ខែស្រាពណ៍ ឆ្នាំរោង ឆស័ក ព.ស ២៥៦៧ <br>
                បាត់ដំបង ថ្ងៃទី ១៧ ខែ សីហា ឆ្នាំ ២០២៤ <br>
                អ្នកគ្រប់គ្រងសាលកុំព្យូទ័រ <br>
            </p>
        </div>
    </div>


    <!-- Main Content Section -->
    <div class="table-responsive">
        <div class="titles">
            <div class="tital2">
                <h3>
                    ព្រះរាជាណាចក្រកម្ពុជា <br>
                    ជាតិ សាសនា ព្រះមហាក្សត្រ
                </h3>
            </div>
            <div class="tital1">
                <h3>
                    សាកលវិទ្យាល័យជាតិបាត់ដំបង <br>
                    មហាវិទ្យាល័យវិទ្យាសាស្ត្រ នឹង បច្ចេកវិទ្យា
                </h3>
            </div>
        </div>
        <div>
            <h3>
                <br>
                សម្រាប់ថ្ងៃទី <span class="date">១៩</span> ​ដល់ថ្ងៃទី <span class="date">២៥</span> ខែ <span class="date">សីហា​</span> ឆ្នាំ <span class="date">២០២៤</span> <span style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលសំណង់</span>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th>អង្គារ</th>
                        <th>ពុធ</th>
                        <th>ប្រហស្បតិ៍</th>
                        <th>សុក្រ</th>
                        <th>សៅរ៍​</th>
                        <th>អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tital3">
            <p>
                ថ្ងៃ សៅរ៍​ ១៣ កើត ខែស្រាពណ៍ ឆ្នាំរោង ឆស័ក ព.ស ២៥៦៧ <br>
                បាត់ដំបង ថ្ងៃទី ១៧ ខែ សីហា ឆ្នាំ ២០២៤ <br>
                អ្នកគ្រប់គ្រងសាលកុំព្យូទ័រ <br>
            </p>
        </div>
    </div>

       <!-- Main Content Section -->
       <div class="table-responsive">
        <div class="titles">
            <div class="tital2">
                <h3>
                    ព្រះរាជាណាចក្រកម្ពុជា <br>
                    ជាតិ សាសនា ព្រះមហាក្សត្រ
                </h3>
            </div>
            <div class="tital1">
                <h3>
                    សាកលវិទ្យាល័យជាតិបាត់ដំបង <br>
                    មហាវិទ្យាល័យវិទ្យាសាស្ត្រ នឹង បច្ចេកវិទ្យា
                </h3>
            </div>
        </div>
        <div>
            <h3>
                <br>
                សម្រាប់ថ្ងៃទី <span class="date">១៩</span> ​ដល់ថ្ងៃទី <span class="date">២៥</span> ខែ <span class="date">សីហា​</span> ឆ្នាំ <span class="date">២០២៤</span><span style="color:rgb(53, 75, 199)">&nbsp;&nbsp; សាលទូទៅ</span>
            </h3>
        </div>
        <div class="schedule">
            <table>
                <thead>
                    <tr>
                        <th>ម៉ោង</th>
                        <th colspan="">ច័ន្ទ</th>
                        <th>អង្គារ</th>
                        <th>ពុធ</th>
                        <th>ប្រហស្បតិ៍</th>
                        <th>សុក្រ</th>
                        <th>សៅរ៍​</th>
                        <th>អាទិត្យ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>សេសិនទី១</strong><br>
                            (7:00 - 8:30)<br>
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                        <td>
                            <strong>ឈ្មោះ៖</strong><br>
                            099999999<br>
                            Database<br>
                            lab014
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tital3">
            <p>
                ថ្ងៃ សៅរ៍​ ១៣ កើត ខែស្រាពណ៍ ឆ្នាំរោង ឆស័ក ព.ស ២៥៦៧ <br>
                បាត់ដំបង ថ្ងៃទី ១៧ ខែ សីហា ឆ្នាំ ២០២៤ <br>
                អ្នកគ្រប់គ្រងសាលកុំព្យូទ័រ <br>
            </p>
        </div>
    </div>
    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2024 សាកលវិទ្យាល័យជាតិបាត់ដំបង. រក្សាសិទ្ធគ្រប់យ៉ាង.</p>
        </div>
    </footer>
</body>
</html>