<?php
if (isset($_SESSION['role']))
    echo "<p>Hello, " . $_SESSION['role'] . " " . $_SESSION['surname'] . " " . $_SESSION['name'] . " !<p>";
else
    echo "<p>error occurred in assigning role<p>";
?>