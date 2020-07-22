<!DOCTYPE html>
<html>
<head>
    <title> Личный кабинет </title>
    <meta charset="utf-8">
</head>
<body>
<?php require_once "links.php";
    require_once "restart_session.php";
    require_once "stud_functions.php";
?>
<ul>
    <?php
    if (isset($_SESSION['role'])) {
        $courses = get_assigned_courses($link, $_SESSION['roleid']);

        foreach ($courses as $course) {
            echo "<li><a href='stud_attendance.php?courseid=" . $course['courseid'] . "'>" . $course['course_name'] . "</a></li>";
        }
    }
    ?>
</ul>
</body>
</html>