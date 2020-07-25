<?php
require_once "restart_session.php";
require_once "lect_functions.php";




$idx = 0;
$groups = get_groups($link);
//if(isset($_POST['add_group'])){
//    $chosen_groups[$idx] = $_POST['group'];
//}

$content = "";
$content.="<select name='groups_for_choice'>";
foreach ($groups as $group){
    $groupid= $group['id'];
    $groupnum = $group['groupnum'];
    $coursenum = $group['course_year'];
    $content.="<option value=$groupid>$groupnum г $coursenum курс</option>";
}
$content.="</select>";

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
<form name="myForm">
<div>
<div>
    Группы
    <?php
    echo $content;
    if(isset($error)) echo $error;
    ?>
    <p><input type="button" name="addButton" value="Добавить" /></p>
</div>
<div>
    Выбранные группы
    <select name="chosen_groups">
    </select>
    <p><input type="button" name="removeButton" value="Удалить" /></p>
</div>
</div>
</form>

<script>
    var addButton = myForm.addButton,
        removeButton = myForm.removeButton,
        groupsToChoseSelect = myForm.groups_for_choice;
        chosenGroupSelect = myForm.chosen_groups;
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
        var selectedIndex = chosenGroupSelect.options.selectedIndex;
        // получаем текст для элемента
        var text = chosenGroupSelect.options[selectedIndex].text;
        // получаем значение для элемента
        var value = chosenGroupSelect.options[selectedIndex].value;
        // создаем новый элемент
        var newOption = new Option(text, value);
        groupsToChoseSelect.options.add(newOption);
        // удаляем элемент
        chosenGroupSelect.options[selectedIndex].remove();
    }
    addButton.addEventListener("click", addOption);
    removeButton.addEventListener("click", removeOption);
</script>
</body>
</html>
