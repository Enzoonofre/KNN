<?php
  require "agendamentoMedico.php";
  require "conexaoMysql.php";
  $pdo = mysqlConnect();

  session_start();
  $email = $_SESSION['user'];

  $arrayAgendamentosMedico = AgendamentoMedico::GetData($pdo, $email);
?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <header>
    <div class="item_header">
      <img src="../imagens/logo2.jpg" alt="Logo Clínica" id="logo">
    </div>
  </header>

  <nav>
    <div class="conteiner">
      <div class="item">
        <a href="../../homeRestrito.php">Home</a>
      </div>
      <div class="item">
        <a href="../../Cadastros/cadastroFunc.html">Cadastro de Funcionarios</a>
      </div>
      <div class="item">
        <a href="../../Cadastros/cadastroPaciente.html">Cadastro de Pacientes</a>
      </div>
      <div class="item">
        <a href="../dados.php">Listagem de Dados</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h3>Agendamentos</h3>
    <table class="table table-striped table-hover">
      <tr>
        <!--<th></th>-->
        <th>Nome</th>
        <th>Sexo</th>
        <th>Data</th>
        <th>Horario</th>
        <th>Codigo Medico</th>
      </tr>

      <?php
      foreach ($arrayAgendamentosMedico as $agendamentoMedico) {
        echo <<<HTML
          <tr>
            <!--<td></td>-->
            <td>$agendamentoMedico->nome</td> 
            <td>$agendamentoMedico->sexo</td>
            <td>$agendamentoMedico->data</td>
            <td>$agendamentoMedico->hora</td>
            <td>$agendamentoMedico->codigoMed</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
    <p><a href="../dados.php">Voltar para os dados</a></p>
  </div>

</body>

</html>