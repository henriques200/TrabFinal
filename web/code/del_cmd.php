<?php
require("env.php");
require("events.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetch the required form data.
    $codename = $_REQUEST['select_cmd'];
  
    //Verifiy if values are empty.
    if(empty($codename)){
      $error = 1;
      $msg = "Não foi introduzido nenhum comando!";
    } else {
      try {
  
        //Create connection.
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //Set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Query to check command codename.
        $sql = "SELECT COUNT(*) FROM COMANDO WHERE Nome_codigo=:nome_codigo";
        $search_codename = $conn->prepare($sql);
        $search_codename->bindParam(':nome_codigo', $codename, PDO::PARAM_STR);
        $search_codename->execute();
  
        //Check if Group Name does exists and delete the record.
        if($search_codename->fetchColumn() > 0){
            $sql = "DELETE FROM COMANDO WHERE Nome_codigo=:codename";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":codename", $codename, PDO::PARAM_STR);
            $del_record = $stmt->execute();
            $msg = "O comando $codename foi removido com sucesso!";
            new_event("INFO", $msg);
        } else {
            $error = 1;
            $msg = "O comando c/ o código $codename não existe!";
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