<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Agenda</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <style>
    body {
      padding-top: 2rem;
    }

    img {
      width: 20px;
    }
  </style>
</head>

<body>

  <div class="container">
    <h3>Agendamentos</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th></th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Data</th>
        <th>Horario</th>
        <th>Codigo Medico (talvez mudar para nome medico dps)</th>
      </tr>

      <?php
      foreach ($arrayAgendamentos as $agendamento) {
        echo <<<HTML
          <tr>
            <td><a href="controlador.php?acao=excluirAgendamento&Data=$agendamento->data">Excluir</a></td> 
            <td>$agendamento->nome</td> 
            <td>$agendamento->sexo</td>
            <td>$agendamento->data</td>
            <td>$agendamento->hora</td>
            <td>$agendamento->codigoMed</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
    <p><a href="../dados.html">Voltar para os dados</a></p>
  </div>

</body>

</html>