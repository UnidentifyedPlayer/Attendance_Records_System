<!DOCTYPE html>
<html>
<head>
    <title>Сведения о посещаемости</title></head>
<body>
<?php
require_once "restart_session.php";
require_once "stud_functions.php";
if(isset($_GET['courseid'])){
    $attendance = get_stud_attendance($link, $_SESSION['roleid'], $_GET['courseid']);
echo"<table><tr>";
foreach($attendance as $record){
    echo "<th>".$record['lecture_date']."</th>";
}
echo"</tr>";
echo"<tr>";
    foreach($attendance as $record){
        echo "<td>".$record['status']."</td>";
    }
echo"</tr></table>";
}
?>

</body>
</html>