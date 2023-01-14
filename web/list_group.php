<?php
require("env.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //Set the PDO error mode to exception.
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Query to show all table contents.
    $search_group_name = $conn->query("SELECT * FROM GRUPO");

    //Fetch all rows from the result by returning an array indexed by column.
    $msg = $search_group_name->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $conn_error) {
    $error = 1;
    $msg = "Connection failed: " . $conn_error->getMessage();
}

//Closes DB connection.'
$conn = null;

//Envia a resposta para a página HTML com o AJAX.
echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));
?>