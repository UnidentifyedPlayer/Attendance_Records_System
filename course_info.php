<?php
require_once "restart_session.php";
require_once "lect_functions.php";

$content = "";
$error = "";
$dates = get_course_dates($link, $_GET['courseid']);
$students = get_course_stud_names($link, $_GET['courseid']);
$attendance = get_course_attendance($link, $_GET['courseid']);
$content .= "<table><tr><th>Студенты</th>";
foreach ($dates as $date) {
    $content .= " <th>" . $date[0] . "</th>";
}

foreach ($students as $student) {
    $content .= "<tr><td>" . $student['name'] . " " . $student['middle_name'] . " " . $student['surname'] . "</td>";
    $cur_studid = $student['id'];
    $dateidx = 0;
    foreach ($attendance as $record) {
    if(($record['lecture_date']== $dates[$dateidx][0]) && ($student['id']== $record['studentid'])){
        $content .= "<td>".$record['status']."</td>";
        $dateidx++;
        if($dateidx>= count($dates)){break;}
    }
    }

    $content .= "</tr>";
}
$content .= "</tr></table>";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Блочная верстка в HTML5</title>
    <style>
        div {
            /*margin: 10px;*/
            /*border: 1px solid black;*/
            font-size: 16px;
        }

        #header {
            background-color: #ccc;
            height: 80px;
        }

        #sidebar {
            background-color: #ddd;
            float: left;
            width: 150px;
        }

        #main {
            background-color: #eee;
            margin-left: 170px; /* 150px (ширина сайдбара) + 10px + 10px (2 отступа) */
        }

        #footer {
            background-color: #ccc;
        }
    </style>
</head>
<body>
<div id="header">Шапка сайта<?php require_once "headers/greetings.php" ?></div>
<div id="sidebar">Сайдбар <?php require_once "headers/links.php" ?></div>

<div id="main">Основное содержимое

    <?php echo "<p> id преподавателя" . $_SESSION['roleid'] . "</p>";
    echo "<p><a href='new_lecture.php?courseid=".$_GET['courseid']."'>Новая лекция</a></p>";
    ?>
    <ul>
        <?php
        echo $content;
        if (isset($error)) echo $error;
        ?>
    </ul>
</div>
</body>
</html>
