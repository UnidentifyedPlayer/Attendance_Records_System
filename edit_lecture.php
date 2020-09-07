<?php
require_once "restart_session.php";
require_once "lect_functions.php";

$content = "";
$date = $_GET['lect_date'];
$courseid = $_GET['courseid'];
$course_info = get_course_info($link, $_GET['courseid']);
$students= get_course_stud_names($link, $_GET['courseid']);
$lect_info = get_lect_info($link, $_GET['courseid'], $_GET['lect_date']);
$content.="
<form method='POST'>
<input type='hidden' name='date' value = '$date'>
<input type='submit' name='Сохранить' value='Сохранить'>";
for($i = 0; $i < count($students);$i++){
    $select_id = $students[$i]['id'];
    $content.="<div>".$students[$i]['name']." ".$students[$i]['surname']."
<select name ='$select_id'>";
if($lect_info[$i]['status']=='был') {
    $str = "<option value='был' selected>был</option>
<option value='не был'>не был</option>";
}
else{
    $str = "<option value='был'>был</option>
<option value='не был' selected>не был</option>";
}
$str = $str."</select></div>";
$content.=$str;
}

$content.="</form>";

if(isset($_POST['date']))
{
    $query =" ";
    for($i = 0; $i < count($students);$i++){
        $id = $students[$i]['id'];
        $status = $_POST["$id"];
        echo "<div> $courseid , $id , '$status' </div>";
        $query = "
        UPDATE  attend_records 
        SET status='$status' WHERE id = '$id'; ";
        $result = mysqli_query($link, $query);
    }
    //$result = mysqli_query($link, $query);
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
    <?php
    echo $content;
    if (isset($error)) echo $error;
    ?>
</div>
<div>
    <?php echo"<a href='course_info.php?courseid=$courseid'>Назад к профилю курса</a>"?>
</div>
</body>
</html>

