<?php
//DB access parameters
$servername = getenv("DB_ADDR");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbname = "EQUIP_BD";

//PHP AJAX comunication options
$error = 0;
$msg = "";
$redirect = "";

//Check DB access parameters
if(empty($servername)) $servername = "localhost";
if(empty($username)) $username = "root";

?>