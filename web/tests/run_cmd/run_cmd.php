<?php
require("env.php");
require("events.php");

//Create connection.
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//Set the PDO error mode to exception.
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function check_db($command, $equipment, $conn){
    //Query to check certain equipment.
    $sql = "SELECT COUNT(*) FROM EQUIPAMENTO WHERE Nome=:equip_name";
    $search_equip_name = $conn->prepare($sql);
    $search_equip_name->bindParam(':equip_name', $equipment, PDO::PARAM_STR);
    $search_equip_name->execute();

    if($search_equip_name->fetchColumn() > 0){
        //Query to check command codename.
        $sql = "SELECT COUNT(*) FROM COMANDO WHERE Nome_codigo=:nome_codigo";
        $search_codename = $conn->prepare($sql);
        $search_codename->bindParam(':nome_codigo', $command, PDO::PARAM_STR);
        $search_codename->execute();
        if($search_codename->fetchColumn() > 0){
            return true;
        }
    } else {
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Fetch the required form data.
    $cmd = $_REQUEST['opt_cmd'];
    $opt_equip = $_REQUEST["opt_equip"];

    print_r($_POST);

    //Verifiy if values are empty.
    if(empty($cmd) || empty($os)){
        $error = 1;
        $msg = "Os valores obrigatórios estão vazios!";
    } else {
        $values_exists = check_db($cmd, $opt_equip, $conn);
        if($values_exists) {
            $exec_cmd = escapeshellcmd("python3 run_cmd.py $opt_equip $cmd");
            $exec_output = shell_exec($exec_cmd);
            $msg = $exec_output;
        } else {
            $error = 1;
            $msg = "Os valores introduzidos não existem na BD!";
        }
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