<?php
require("env.php");
require("events.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetch the required form data.
    $equip_name = $_REQUEST['select_equip'];
  
    //Verifiy if values are empty.
    if(empty($equip_name)){
      $error = 1;
      $msg = "Não foi introduzido nenhum grupo!";
    } else {
      try {
  
        //Create connection.
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //Set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Query to check certain equipment.
        $sql = "SELECT COUNT(*) FROM EQUIPAMENTO WHERE Nome=:equip_name";
        $search_equip_name = $conn->prepare($sql);
        $search_equip_name->bindParam(':equip_name', $equip_name, PDO::PARAM_STR);
        $search_equip_name->execute();
  
        //Check if Equip Name does exists and delete the record.
        if($search_equip_name->fetchColumn() > 0){
            $sql = "DELETE FROM EQUIPAMENTO WHERE Nome=:equip_name";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":equip_name", $equip_name, PDO::PARAM_STR);
            $del_record = $stmt->execute();
            $msg = "O equipamento $equip_name foi removido com sucesso!";
            new_event("INFO", $msg);
        } else {
            $error = 1;
            $msg = "O equipamento $equip_name não existe!";
        }
  
      } catch(PDOException $conn_error) {
        $error = 1;
        $msg = "Connection failed: " . $conn_error->getMessage();
      }
      
      //Closes DB connection.
      $conn = null;
    }
  } else {
    $error = 1;
    $msg = "Método HTML incorreto!";
  }
  
  
  //Envia a resposta para a página HTML com o AJAX.
  echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));
  ?>