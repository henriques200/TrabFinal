<?php
include("env.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Fetch the required form data.
  $equip_name = $_REQUEST["nome_equip"];
  $ip_equip = $_REQUEST["ip_equip"];
  $user_equip = $_REQUEST["user_equip"];
  $pass_equip = $_REQUEST["pass_equip"];
  $opt_os = $_REQUEST["opt_os"];
  $select_group = $_REQUEST["select_group"];

  //Verifiy if values are empty.
  if(empty($equip_name) || empty($ip_equip) || empty($user_equip) || empty($pass_equip) || empty($opt_os) || empty($select_group)){
    $error = 1;
    $msg = "Os valores introduzidos estão incompletos!";
  } else {
    try {

      //Create connection.
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      //Set the PDO error mode to exception.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      //Query to check certain groupname.
      $search_equip_name = $conn->query("SELECT COUNT(*) FROM EQUIPAMENTO WHERE Nome='$equip_name'");

      //Check if Equipment already exists.
      if($search_equip_name->fetchColumn() > 0){
        $error = 1;
        $msg = "O equipamento $equip_name já existe!";
      } else {
        //Insert new record.
        $sql_insert_query = "INSERT INTO EQUIPAMENTO (Nome, Ip_Nome, Username, Pass, OS, Grupo) VALUES ('$equip_name', '$ip_equip', '$user_equip', '$pass_equip', '$opt_os', '$select_group')";
        $new_record = $conn->exec($sql_insert_query);
        $msg = "O equipamento $equip_name foi adicionado com sucesso!";
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
