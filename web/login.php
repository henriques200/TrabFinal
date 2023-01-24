<?php
require("env.php");
require("events.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['username'] == $web_user && $_POST['password'] = $web_pass){
        session_start();
        $_SESSION['username'] = $web_user;
        $_SESSION['password'] = $web_pass;
        $_SESSION["loggedin"] = true;

        // Redirect user to welcome page
        header("location: index.html");
    } else {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        $error = 1;
        $msg = "Credenciais Inválidas!";
        new_event("ERRO", "Tentativa de acesso indevido!");
        header("location: login.html");
    }
} else {
    $error = 1;
    $msg = "Método inválido!";
}
?>
