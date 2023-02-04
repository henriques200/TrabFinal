<?php
require("env.php");
require("events.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['username'] == $web_user && $_POST['password'] == $web_pass){
        $_SESSION['username'] = $web_user;
        $_SESSION['password'] = $web_pass;
        $_SESSION['loggedin'] = true;

        // Redirect user to welcome page
        header("location: ..\index.php");
    } else {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        $error = 1;
        $msg = "Credenciais Inválidas!";
        new_event("ERRO", "Tentativa de acesso indevido!");
        header("location: ..\about.php");
    }
} else {
    $error = 1;
    $msg = "Método inválido!";
}
?>
