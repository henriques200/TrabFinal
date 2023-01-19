<?php
require("./env.php");


function list_all($table){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //Set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        switch($table){
            case "SISTEMA":
                $sql_query = "SELECT * FROM SISTEMA";
                break;
            case "COMANDO":
                $sql_query = "SELECT * FROM COMANDO";
                break;
            case "EQUIPAMENTO":
                $sql_query = "SELECT Nome, Ip_Nome, OS, Grupo FROM EQUIPAMENTO";
                break;
            default:
                $error = 1;
                $msg = "A tabela $table nao existe!";
                echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));
                return;
        }

        //Query to show only the "Nome" contents.
        $search_group_name = $conn->query($sql_query);
    
        //Fetch all rows from the result by returning an array indexed by column.
        $msg = $search_group_name->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $conn_error) {
        $error = 1;
        $msg = "Connection failed: " . $conn_error->getMessage();
    }
    
    //Closes DB connection.
    $conn = null;
    
    //Envia a resposta para a página HTML com o AJAX.
    echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));    
}


?>