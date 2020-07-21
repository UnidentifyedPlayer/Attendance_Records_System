<?php
session_start();
if (isset($_SESSION['role'])) {
    switch($_SESSION['role']){
    case 'student': $redirect_url = 'stud_prof.php'; break;
    default :$redirect_url = 'main.php';
    }
} else {
    $redirect_url = 'login.php';
}
header('HTTP/1.1 200 OK');
if ($redirect_url)
    header("Location: $redirect_url");
exit();
?>
