<?php
require_once "restart_session.php";
require_once "lect_functions.php";


//if(isset($_POST['add_group'])){
//    $chosen_groups[$idx] = $_POST['group'];
//}
if (isset($courseid)) {
    if (isset($_GET['courseid'])) {
        $courseid = $_GET['courseid'];
    } else {
        $error = "Вы не авторизированы";
    }
}

if (isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['course_name'])) {
    $lectid = $_SESSION['roleid'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    $course_name = $_POST['course_name'];
    $query = "INSERT INTO courses VALUES(NULL,'$lectid','$course_name','$year', '$semester')";
    if (mysqli_query($link, $query)) {
        header("Location: lect_prof.php");
    } else {
        $error = "Неудача при попытке добавить новый курс";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <title>Блочная верстка в HTML5</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="header">Шапка сайта<?php require_once "headers/greetings.php" ?></div>
<div id="sidebar">Сайдбар <?php require_once "headers/links.php" ?></div>

<div id="main">Основное содержимое
    <?php
    if (isset($error))
        echo "
    <div>
        $error
    </div>
    " ?>
    <form name="create_course" method="post">
        <div>
            <div>
                Название курса
                <p><input type='text' name="course_name"></p>
            </div>
            <div>
                Год
                <input type="number" name="year" min="2000" max="9999">
            </div>
            <div>
                Семестр
                <div>
                    <select name="semester">
                    <option value=1>1</option>
                    <option value=2>2</option>
                </select>
                </div>
            </div>
            <div>
                <p><input type="submit" name="Создать курс"</p>
            </div>
        </div>
    </form>
    <?php
    echo "<p> id преподавателя" . $_SESSION['roleid'] . "</p>";
    ?>
</div>
</body>
</html>
