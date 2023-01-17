<?php
require("env.php");
require("events.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Fetch the required form data.
  $group_name = $_REQUEST['nome_group'];
  $group_owner = $_REQUEST['dono_group'];
  $phone_number = $_REQUEST['phone_number'];
  $nif = $_REQUEST['nif'];

  //Verifiy if values are empty.
  if(empty($group_name) || empty($group_owner) || empty($phone_number) || empty($nif)){
    $error = 1;
    $msg = "Os valores introduzidos estão incompletos!";
  } else {
    try {

      //Create connection.
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      //Set the PDO error mode to exception.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      //Query to check certain groupname.
      $search_group_name = $conn->query("SELECT COUNT(*) FROM GRUPO WHERE Nome='$group_name'");

      //Check if Group Name already exists.
      if($search_group_name->fetchColumn() > 0){
        $error = 1;
        $msg = "O nome do grupo $group_name já existe!";
      } else {
        //Insert new record.
        $sql_insert_query = "INSERT INTO GRUPO (Nome, Dono, Phone, NIF) VALUES ('$group_name', '$group_owner', '$phone_number', '$nif')";
        $new_record = $conn->exec($sql_insert_query);
        $msg = "O grupo $group_name foi adicionado com sucesso!";
        new_event("INFO", $msg);
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
