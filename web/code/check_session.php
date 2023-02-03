<?php
require("env.php");

session_start();

if (isset($_SESSION['loggedin'])) {
    $ok = 1;
} else {
    header("location: ..\login.php");
    exit();
}
?>