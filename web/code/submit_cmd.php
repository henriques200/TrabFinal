<?php
require("env.php");
require("events.php");

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
    
      //Query to check command codename.
      $sql = "SELECT COUNT(*) FROM COMANDO WHERE Nome_codigo=:nome_codigo";
      $search_codename = $conn->prepare($sql);
      $search_codename->bindParam(':nome_codigo', $codename, PDO::PARAM_STR);
      $search_codename->execute();

      //Check if Command Codename already exists.
      if($search_codename->fetchColumn() > 0){
        $error = 1;
        $msg = "O nome de código $codename já existe!";
      } else {
        //Insert new record.
        $sql = "INSERT INTO COMANDO (Nome_codigo, Comando, Descricao, OS) VALUES (:nome_codigo, :comando, :descricao, :os)";
        $stmt = $conn->prepare($sql);
        $new_record = $stmt->execute([':nome_codigo' => $codename, ':comando' => $cmd, ':descricao' => $cmd_desc, ':os' => $os]);
        $msg = "O comando $codename foi adicionado com sucesso!";
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