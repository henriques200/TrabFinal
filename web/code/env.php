<?php
//DB access parameters
$servername = getenv("DB_ADDR");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbname = "EQUIP_BD";

//Web access parameters
$web_user = getenv("WEB_USER");
$web_pass = getenv("WEB_PASSWORD");

//PHP AJAX comunication options
$error = 0;
$msg = "";
$redirect = "";

//Other options
$timezone = getenv("TIMEZONE");

//Check DB access parameters
if(empty($servername)) $servername = "localhost";
if(empty($username)) $username = "root";

//Check Web access parameters
if(empty($web_user)) $web_user = "root";
if(empty($web_pass)) $web_pass = "root";

//Timezone parameters
if (empty($timezone)) date_default_timezone_set("Europe/Lisbon");
else date_default_timezone_set($timezone);
?>