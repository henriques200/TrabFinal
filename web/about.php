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
    <title>Sobre o projeto...</title>
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
                <li><a class="dropdown-item" href="rem_equip.php">Remover</a></li>
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
                  <li><a class="dropdown-item" href="rem_group.php">Remover</a></li>
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
                  <li><a class="dropdown-item" href="rem_cmd.php">Remover</a></li>
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
        <div class="row">
          <div class="col">
            <h3>Sobre o Projeto...</h3>
            <p>Este projeto consiste na construção de um site, utilizando o que foi aprendido nas aulas da cadeia de TI II.</p>
            <p>Na realização do projeto utilizou-se as seguintes tecnologias:</p>
            <ul>
                <li>HTML</li>
                <li>Javascript</li>
                <li>CSS</li>
                <li>PHP</li>
                <li>SQL</li>
            </ul>
            <p>Também se usou outras tecnologias na realização do site tais como:</p>
            <ul>
                <li>Bootstrap 5</li>
                <li>Jquery</li>
                <li>Docker</li>
            </ul>
            <h5>Desenvolvido por:</h5>
            <p>Emanuel Henriques</p>
            <p>ISTEC - Engenharia Informática - Turma 2A - Número 2414</p>
            <h5>Orientado e avaliado por:</h5>
            <p>José Neves</p>
            <p>Cadeia de Tecnologias da Internet II</p>
            <h5>Repositório GitHub:</h5>
            <p><a href="https://github.com/henriques200/TrabFinal" target="_blank" rel="noopener noreferrer">henriques200/TrabFinal</a></p>
          </div>
        </div>
    </div>
    <!--Footer-->
    <footer class="text-center p-3">
      <p>© Emanuel Henriques - 2022</p>
    </footer>
    </div>
    <script src="bootstrap-5.2.2-dist/js/bootstrap.bundle.js"></script>
    <script src="js/jquery-3.6.1.js"></script>
</body>
</html>