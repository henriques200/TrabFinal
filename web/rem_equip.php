<?php
require("env.php");

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

        //Query to check certain groupname.
        $search_group_name = $conn->query("SELECT COUNT(*) FROM EQUIPAMENTO WHERE Nome='$equip_name'");
  
        //Check if Equip Name does not exists.
        if($search_group_name->fetchColumn() > 0){
            //Delete record.
            $sql_insert_query = "DELETE FROM EQUIPAMENTO WHERE Nome='$equip_name'";
            $new_record = $conn->exec($sql_insert_query);
            $msg = "O equipamento $equip_name foi removido com sucesso!";
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