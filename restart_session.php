<?php
    session_start();
    require_once "connection.php";
    $link = mysqli_connect($host, $user, $password, $database);
?>
