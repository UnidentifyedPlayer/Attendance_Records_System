<?php
require_once "restart_session.php";
require_once "lect_functions.php";


$idx = 0;
$groups = get_groups($link);
//if(isset($_POST['add_group'])){
//    $chosen_groups[$idx] = $_POST['group'];
//}
if(!isset($courseid)){
    if(isset($_GET['courseid'])){
        $courseid = $_GET['courseid'];
    }
}

$content = "";
$content .= "<select name='groups_for_choice'>";
foreach ($groups as $group) {
    $groupid = $group['id'];
    $groupnum = $group['groupnum'];
    $coursenum = $group['course_year'];
    $content .= "<option value=$groupid>$groupnum г $coursenum курс</option>";
}
$content .= "</select>";

if(isset($_POST['chosen_groups'])){
    echo"<br>вут? что-то пришло</br>";
    $groups = $_POST['chosen_groups'];
    $query = "SELECT id FROM students WHERE ";
    foreach ($groups as $group) {
        $query .=" groupid = '$group' OR";
    }
    $query = mb_substr($query,0,mb_strlen($query)-2);
    $result = mysqli_query($link, $query);
    if(is_bool($result)){
        $error = "Не были получены студенты из этих групп";
    }
    else{
        $students = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($students as $student){
            $studid = $student['id'];
            $query = "INSERT INTO curriculum_history VALUES(NULL, '$studid', '$courseid')";
            $result = mysqli_query($link,$query);
            if(!$result){
                revert_changes($link, $students, $courseid);
                $error = "Во время добавления студентов к курсу произошла ошибка, был сделан откат";
                break;
            }
        }
        if(!isset($error))
        header("Location: course_info.php?courseid=$courseid");

    }

}
else{
    echo "нихрена не дошло. Фиг тебе. Думай ещё";
}
function revert_changes($link,$students, $courseid){
    foreach($students as $student){
        $studid = $student['id'];
        $query = "DELETE FROM curriculum_history WHERE studentid='$studid' AND courseid='$courseid'";
        mysqli_query($link,$query);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <title> Запись на курс </title>
    <meta charset="utf-8">
</head>
<body>
<?php require_once "headers/links.php";
?>
<form name="myForm" method="post">
    <div>
        <div>
            Добавление студентов на курс
        </div>
        <div>
            Группы
            <?php
            echo $content;
            if (isset($error)) echo $error;
            ?>
            <p><input type="button" name="addButton" value="Добавить"/></p>
        </div>
        <div>
            Выбранные группы
            <select name="chosen_groups[]" id="chosen_groups" size="5" multiple>
            </select>
            <p><input type="button" name="removeButton" value="Удалить"/></p>
        </div>
        <div>
            <p><input type="submit" name="submitButton" value="Добавить студентов"/></p>
        </div>
    </div>
</form>

<script>
    var addButton = myForm.addButton,
        removeButton = myForm.removeButton,
        submitButton = myForm.submitButton,
        groupsToChoseSelect = myForm.groups_for_choice;
    chosenGroupSelect = document.getElementById("chosen_groups");

    function addOption() {
        var selectedIndex = groupsToChoseSelect.options.selectedIndex;
        // получаем текст для элемента
        var text = groupsToChoseSelect.options[selectedIndex].text;
        // получаем значение для элемента
        var value = groupsToChoseSelect.options[selectedIndex].value;
        // создаем новый элемент
        var newOption = new Option(text, value);
        chosenGroupSelect.options.add(newOption);
        // удаляем элемент
        groupsToChoseSelect.options[selectedIndex].remove();
    }

    function removeOption() {
        var len = chosenGroupSelect.options.length;
        var selectedIndex = 0;
        for (var n = len - 1; n >= 0; n--) {
            if (chosenGroupSelect.options[n].selected == true) {
                selectedIndex = n;
                var text = chosenGroupSelect.options[selectedIndex].text;
                // получаем значение для элемента
                var value = chosenGroupSelect.options[selectedIndex].value;
                // создаем новый элемент
                var newOption = new Option(text, value);
                groupsToChoseSelect.options.add(newOption);
                // удаляем элемент
                chosenGroupSelect.options[selectedIndex].remove();
            }
        }
        // получаем текст для элемента

    }

    function submit() {
        var len = chosenGroupSelect.options.length;
        for (var n = len - 1; n >= 0; n--) {
            chosenGroupSelect.options[n].selected = true;
        }
        myForm.submit();
    }

    addButton.addEventListener("click", addOption);
    removeButton.addEventListener("click", removeOption);
    submitButton.addEventListener("click", submit);
</script>
</body>
</html>

