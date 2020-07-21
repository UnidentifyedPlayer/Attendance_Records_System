<?php
require_once "restart_session.php";
$login = $password = '';
$error = 'Неверный логин или пароль';
if (isset($_POST['login']) && isset($_POST['password'])) {
    $sentlogin = $_POST['login'];
    $sentpassword = $_POST['password'];
    $query = "SELECT * FROM users WHERE login='$sentlogin'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $logon_message = "Checking...";
    if (!$result) {
        $logon_message = $error . $error . $error;
    } else {
        if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo "<div> ".$row['password']."  </div>";
            echo "<div> ".$row['role']."  </div>";
            $result->close();
            if ($row['password'] == $sentpassword) {
                $_SESSION['userid'] = $userid = $row['id'];
                $_SESSION['role'] = $row['role'];
                switch ($row['role']){
                    case 'student': $tabletosearch = 'students'; break;
                    case 'lecturer': $tabletosearch = 'lectueres'; break;
                }
                $query = "SELECT * FROM $tabletosearch WHERE userid='$userid'";
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $_SESSION['roleid'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['surname'] = $row['surname'];

                header("Location: index.php");
            } else {
                $logon_message = $error;
            }
        } else
            $logon_message = $error . $error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> <?php echo "Вход" ?> </title>
    <meta charset="utf-8">
</head>
<body>
<h2> Вход </h2>
<form method="POST">
    <table>
        <tr>
            <th>Пользователь</th>
            <td><input type="text" name="login" value="<?php/* echo $login; */?>"></td>
        </tr>
        <tr>
            <th>Пароль</th>
            <td>
                <input type="password" name="password"/>
            </td>
        </tr>
        <?php
        if (!isset($logon_message)) $logon_message = "Войдите";
        {
            echo '
   				<tr>
    			   <td colspan="2">
    					' . $logon_message . '
   				   </td>
    			</tr>';

        }
        ?>
        <tr>
            <td colspan="2">
                <input type="submit" name="cmd" value="Вход"/>
            </td>
        </tr>
    </table>
</form>
</body>
</html>