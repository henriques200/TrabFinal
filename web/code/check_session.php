<?php
require("env.php");

session_start();

if (session_status() == PHP_SESSION_ACTIVE) {
    $ok = 1;
} else {
    header("location: login.php");
    exit();
}
?>