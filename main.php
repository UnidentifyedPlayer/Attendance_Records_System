<!DOCTYPE html>
<html>
<head>
    <title> <?php echo "Вход" ?> </title>
    <meta charset="utf-8">
</head>
<body>
<?php
require_once "restart_session.php";
if (isset($_SESSION['role']))
    echo "<p>Hello, " . $_SESSION['role'] . " " . $_SESSION['surname'] . " " . $_SESSION['name'] . " !<p>";
else
    echo "<p>error occurred in assigning role<p>";
?>

</body>
</html>