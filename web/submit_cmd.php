<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EQUIP_BD";
$error = 0;
$msg = "";
$redirect = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Fetch the required form data.
  $codename = $_REQUEST['codename'];
  $cmd = $_REQUEST['cmd'];
  $cmd_desc = $_REQUEST['cmd_desc'];
  $os = $_REQUEST['opt_os'];

  //Verifiy if values are empty.
  if(empty($codename) || empty($cmd) || empty($os)){
    $error = 1;
    $msg = "Os valores obrigatórios estão vazios!";
  } else {
    try {

      //Create connection.
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      //Set the PDO error mode to exception.
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      //Query to check certain groupname.
      $search_codeaname = $conn->query("SELECT COUNT(*) FROM COMANDO WHERE Nome='$codename'");

      //Check if Command Codename already exists.
      if($search_codeaname->fetchColumn() > 0){
        $error = 1;
        $msg = "O nome de código $codename já existe!";
      } else {
        //Insert new record.
        $sql_insert_query = "INSERT INTO COMANDO (Nome_codigo, Comando, Descricao, OS) VALUES ('$codename', '$cmd', '$cmd_desc', '$os')";
        $new_record = $conn->exec($sql_insert_query);
        $msg = "O comando $codename foi adicionado com sucesso!";
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