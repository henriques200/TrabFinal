<?php
require("env.php");
require("events.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetch the required form data.
    $cmd = $_REQUEST["opt_cmd"];
    $opt_equip = $_REQUEST['opt_equip'];

    //Verifiy if values are empty.
    if(empty($cmd) || empty($os)){
        $error = 1;
        $msg = "Os valores obrigatórios estão vazios!";
    } else {
        //Create connection.
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //Set the PDO error mode to exception.
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select :";
        $stmt = $conn->prepare($sql);
        $equip_out = $stmt->execute();
        // - Verificar se o comando e equipamento existe
        //   - proceder a execucao de script passando a identificação do equipamento e codigo do comando
        //     - Procurar o equipamento na base de dados e recolher password
        //     - Executar o comando
        //   - O output e devolvido
    }
} else {
    $error = 1;
    $msg = "Método HTML incorreto!";
}

//Envia a resposta para a página HTML com o AJAX.
echo json_encode(array('error' => $error, 'message' => $msg, 'redirect' => $redirect));
?>