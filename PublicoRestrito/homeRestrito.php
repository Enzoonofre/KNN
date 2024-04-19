<?php

require "../PublicoGeral/conexaoMysql.php";
require "../PublicoGeral/Login/sessionVerification.php";

session_start();
exitWhenNotLoggedIn();

$pdo = mysqlConnect();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
  <link rel="stylesheet" href="styleHome.css">
</head>

<body>
  <script>
    alert(document.cookie);
  </script>

  <header>
    <div>
      <img src="imagens/logo2.jpg" alt="Logo Clínica" id="logo">
    </div>
  </header>

  <nav>
    <div class="conteiner">
      <!--<div class="item">
                <a href="HomeRestrito.html">Home</a>
            </div>-->
      <div class="item">
        <a href="Cadastros/cadastroFunc.html">Cadastro de Funcionarios</a>
      </div>
      <div class="item">
        <a href="Cadastros/cadastroPaciente.html">Cadastro de Pacientes</a>
      </div>
      <div class="item">
        <a href="Dados/dados.html">Listagem de Dados</a>
      </div>
    </div>
  </nav>

  <main>
    <h2>Área Restrita</h2>
    <h3>Bem Vindo, <?php echo $_SESSION['user'] ?>! Aqui você consegue:</h3>
    <ul>
      <li>Cadastrar Funcionários</li>
      <li>Cadastrar Paciente</li>
      <li>Ver Listagem de Dados</li>
    </ul>
    <a href="logout.php">SAIR<a>
  </main>

</body>

</html>