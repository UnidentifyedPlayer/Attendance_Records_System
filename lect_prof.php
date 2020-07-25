<?php
require_once "restart_session.php";
require_once "lect_functions.php";

$content = "";
$courses = get_tutored_courses($link, $_SESSION['roleid']);
if (count($courses) == 0){
    $content = "<p>Вы не являетесь участником/преподавателем какого-либо курса.</p>";
}
else{
    foreach ($courses as $course) {
        $content = $content."<li><a href='course_info.php?courseid=" . $course['id'] . "'>" . $course['name'] . "</a></li>";
    }
}



?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <title>Блочная верстка в HTML5</title>
    <style>
        div{
            /*margin: 10px;*/
            /*border: 1px solid black;*/
            font-size: 16px;
        }
        #header{
            background-color: #ccc;
            height: 80px;
        }
        #sidebar{
            background-color: #ddd;
            float: left;
            width: 150px;
        }
        #main{
            background-color: #eee;
            margin-left: 170px; /* 150px (ширина сайдбара) + 10px + 10px (2 отступа) */
        }
        #footer{
            background-color: #ccc;
        }
    </style>
</head>
<body>
<div id="header">Шапка сайта<?php require_once "headers/greetings.php"?></div>
<div id="sidebar">Сайдбар <?php require_once "headers/links.php" ?></div>

<div id="main">Основное содержимое
    <?php
    echo "<p> id преподавателя".$_SESSION['roleid']."</p>";
    echo "<p><a href='new_course.php'>Новый курс</a></p>";
    ?>
<ul>
    <?php
    echo $content;
    if(isset($error)) echo $error;
    ?>
</ul>
</div>
</body>
</html>
