<?php
$con = new mysqli('localhost', 'root', '', 'request_lab');

if (isset($_POST['add'])) {
        $sql = "INSERT INTO information (`Date`, `Lab_id`, `major`, `Generation`, 
        `tc_name`, `start_time`,  `session_id`,`App`,  `Number_student`, `Subject`, `Other`) 
    VALUES('$_POST[date]',' $_POST[school]', '$_POST[major]', '$_POST[class]','$_POST[teacher]', 
    '$_POST[session]', '$_POST[NumberSession]', '$_POST[app]', '$_POST[students]', '$_POST[subject]', '$_POST[other]')";
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM request WHERE ID=$_GET[id]";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
    $date = $row['Date'];
    $School = $row['Lab_id'];
    $major = $row['major'];
    $class = $row['Generation'];
    $teacher = $row['tc_name'];
    $NumberSession = $row['session_id'];
    $app = $row['App'];
    $Students = $row['Number_student'];
    $subject = $row['Subject'];
    $other = $row['Other'];
   }
    $con->query($sql);
    header('Location: schedule-user.html');
}
?>  