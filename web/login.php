<?php
require("env.php");
require("events.php");

$user = "root";
$pass = "12345";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['username'] == $user && $_POST['password'] = $pass){
        session_start();
        $_SESSION['username'] = $user;
        $_SESSION["loggedin"] = true;

        // Redirect user to welcome page
        //header("location: welcome.php");
    } else {
        $error = 1;
        $msg = "Credenciais Inválidas!";
    }
} else {
    $error = 1;
    $msg = "Método inválido!";
}

?>
