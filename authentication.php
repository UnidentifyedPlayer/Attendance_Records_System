<?php
require_once "restart_session.php";
$login = $password = '';
$error = 'Неверный логин или пароль';
if (isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE login=$login";
    $result = mysqli_query($link, $query);

    if ($result) {
        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            if ($row['password'] == $password) {
                $_SESSION['userid'] = $row['id'];
                $_SESSION['role'] = $row['role'];

                header("Location: index.php");
            }
        } else
            $logon_message = $error;
    } else {
        $logon_message = $error;
    }
} else {
    $logon_message = "Авторизируйтесь в системе для работы с сайтом";
    header("Location: index.php");
}
?>