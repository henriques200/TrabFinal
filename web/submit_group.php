<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $group_name = $_REQUEST['nome_group'];
    $group_owner = $_REQUEST['dono_group'];
    echo "<p>Nome Grupo: " . $group_name;
    echo "<p>Dono: " . $group_owner;
}
?>
