<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Funcionários Cadastrados</title>
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
    <h3>Funcionários Cadastrados</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th></th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Data de Início</th>
        <th>Salário</th>
        <th>Cargo</th>
        <th>Especialidade</th>
        <th>CRM</th>
      </tr>

      <?php
      foreach ($arrayFuncionarios as $funcionario) {
        echo <<<HTML
          <tr>
            <td>$funcionario->nome</td> 
            <td>$funcionario->sexo</td>
            <td>$funcionario->email</td>
            <td>$funcionario->telefone</td>
            <td>$funcionario->cep</td> 
            <td>$funcionario->logradouro</td>
            <td>$funcionario->cidade</td>
            <td>$funcionario->estado</td>
            <td>$funcionario->data_inicio</td>
            <td>$funcionario->salario</td>
            <td>$funcionario->cargo</td>
            <td>$funcionario->especialidade</td>
            <td>$funcionario->crm</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
    <p><a href="../dados.html">Voltar para os dados</a></p>
  </div>

</body>

</html>