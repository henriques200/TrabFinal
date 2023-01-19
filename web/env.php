<?php
//Constants
define("LOGFILE", "events.json");

//DB access parameters
$servername = getenv("DB_ADDR");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$dbname = "EQUIP_BD";

//PHP AJAX comunication options
$error = 0;
$msg = "";
$redirect = "";

//Other options
$timezone = getenv("TIMEZONE");

//Check DB access parameters
if(empty($servername)) $servername = "localhost";
if(empty($username)) $username = "root";

//Timezone parameters
if (empty($timezone)) date_default_timezone_set("Europe/Lisbon");
else date_default_timezone_set($timezone);
?>