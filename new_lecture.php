<?php
require_once "restart_session.php";
require_once "lect_functions.php";

$content = "";
$courseid = $_GET['courseid'];
$course_info = get_course_info($link, $_GET['courseid']);
$students=get_course_stud_names($link, $_GET['courseid']);
$content.="
<form method='POST'>
<input type='date' name='date'>
<input type='submit' name='Сохранить' value='Сохранить'>";
foreach($students as $student){
    $select_id = $student['id'];
$content.="<div>".$student['name']." ".$student['surname']."
<select name ='$select_id'>
<option value='был'>был</option>
<option value='не был'>не был</option>
</select>

";
}
$content.="</form>";

if(isset($_POST['date']))
{
    $date = $_POST['date'];
    $query ="";
    foreach($students as $student){
        $id = $student['id'];
        $status = $_POST["$id"];
        $query .= "
        INSERT INTO attend_records 
        VALUES (NULL,'$courseid','$id',STR_TO_DATE('$date','%Y-%m-%d'),'$status')";
    }
    $result = mysqli_query($link, $query);
    if($result) {
        header("Location: course_info.php?courseid=$courseid");
    }
    else{
        $error = "Ошибка при добавлении сведений о занятии";
    }
}

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
    if(isset($error)){
        echo "<p>'$error'</p>";
    }
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

