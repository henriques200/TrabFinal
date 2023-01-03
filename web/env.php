<?php
$servername = getenv("SRV_ADDR");
$username = getenv("WEB_USER");
$password = getenv("WEB_PASSWORD");
$dbname = getenv("DBNAME");
$error = 0;
$msg = "";
$redirect = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EQUIP_BD";

/*
if(is_null($servername)) $servername = "localhost";
if(is_null($username)) $username = "root";
if(is_null($password)) $password = "";
if(is_null($dbname)) $dbname = "EQUIP_BD";
*/

?>