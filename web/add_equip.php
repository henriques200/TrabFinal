<?php
    require("./code/check_session.php");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.2.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Adicionar Equipamento</title>
</head>
<body>
    <!--Menu-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/home.png" alt="home" size="25" height="25"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Equipamentos
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="add_equip.php">Adicionar</a></li>
                <li><a class="dropdown-item" href="remove_equip.php">Remover</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="list_equip.php">Verificar / Listar</a></li>
              </ul>
            </li>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Grupos
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="add_group.php">Adicionar</a></li>
                  <li><a class="dropdown-item" href="remove_group.php">Remover</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="list_group.php">Verificar / Listar</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Comandos
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="add_cmd.php">Adicionar</a></li>
                  <li><a class="dropdown-item" href="remove_cmd.php">Remover</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="list_cmd.php">Verificar / Listar</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="code/logout.php">Sair</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">Sobre o projeto</a>
              </li>
            </ul>
        </div>
      </div>
    </nav>
    <!--Conteudo-->
    <div class="container mt-3 p-3 rounded" style="background-color: #e9ecef;">  
        <h3>Introduzir novo equipamento</h3>
        <form id="add_new_equip" novalidate method="POST" action="code/submit_equip.php">
            <div class="form-group">
              <label for="nome_equip">Nome do Equipamento</label>
              <input type="text" class="form-control" id="nome_equip" name="nome_equip" aria-describedby="nome_help" placeholder="Introduz um nome...">
              <small id="nome_help" class="form-text text-muted">Nome conhecido do equipamento</small>
            </div>
            <div class="form-group">
                <label for="ip_equip">IP/FQDN do equipamento</label>
                <input type="text" class="form-control" id="ip_equip" name="ip_equip" aria-describedby="ip_help" placeholder="Introduz um end. IP...">
                <small id="ip_help" class="form-text text-muted">End. IP ou nome de domínio do equipamento</small>
            </div>
            <div class="form-group">
                <label for="user_equip">Utilizador(username)</label>
                <input type="text" class="form-control" id="user_equip" name="user_equip" aria-describedby="user_help" placeholder="Introduz o utilizador...">
                <small id="user_help" class="form-text text-muted">Utizador que o serviço vai aceder remotamente</small>
            </div>
            <div class="form-group">
              <label for="pass_equip">Password</label>
              <input type="password" class="form-control" id="pass_equip" name="pass_equip" placeholder="Password">
            </div>
            <label for="opt_os">Sistema Operativo</label>
            <select id="opt_os" name="opt_os" class="form-select">
                <option selected disabled>Escolhe...</option>
            </select>
            <label for="select_group">Grupo</label>
            <select id="select_group" name="select_group" class="form-select">
                <option selected disabled>Escolhe...</option>
            </select>
            <br>
            <button type="submit" id="submit_equip" class="btn btn-primary">Submeter</button> <!--button p/ teste. submit no final-->
          </form>
    </div>
    <!--Footer-->
    <footer class="text-center p-3">
      <p>© Emanuel Henriques - 2022</p>
    </footer>
    </div>
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.6.1.js"></script>
    <script src="js/add_equip.js"></script>
</body>
</html>