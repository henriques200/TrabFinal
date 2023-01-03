<?php
require("env.php");

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

        //Query to check certain groupname.
        $search_codename = $conn->query("SELECT COUNT(*) FROM COMANDO WHERE Nome_codigo='$codename'");
  
        //Check if Group Name does not exists.
        if($search_codename->fetchColumn() > 0){
            //Delete record.
            $sql_insert_query = "DELETE FROM COMANDO WHERE Nome_codigo='$codename'";
            $new_record = $conn->exec($sql_insert_query);
            $msg = "O comando $codename foi removido com sucesso!";
        } else {
            $error = 1;
            $msg = "O nome de código como o comando $codename não existe!";
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