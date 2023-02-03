<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
header("location:../login.html"); //to redirect back to "login.html" after logging out
exit();
?>