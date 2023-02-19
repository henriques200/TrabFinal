<?php
require("env.php");
require("events.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetch the required form data.
    $group_name = $_REQUEST['select_group'];
  
    //Verifiy if values are empty.
    if(empty($group_name)){
      $error = 1;
      $msg = "Não foi introduzido nenhum grupo!";
    } else {
      try {
        //Create connection.
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //Set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Query to check certain groupname.
        $sql = "SELECT COUNT(*) FROM GRUPO WHERE Nome=:group_name";
        $search_group_name = $conn->prepare($sql);
        $search_group_name->bindParam(':group_name', $group_name, PDO::PARAM_STR);
        $search_group_name->execute();
  
        //Check if Group Name does exists and delete record.
        if($search_group_name->fetchColumn() > 0){
            $sql = "DELETE FROM GRUPO WHERE Nome=:group_name";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":group_name", $group_name, PDO::PARAM_STR);
            $del_record = $stmt->execute();
            $msg = "O grupo $group_name foi removido com sucesso!";
            new_event("INFO", $msg);
        } else {
            $error = 1;
            $msg = "O grupo $group_name não existe!";
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