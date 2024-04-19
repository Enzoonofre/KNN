<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Endereços cadastrados</title>

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
        <a href="../../HomeRestrito.html">Home</a>
      </div>
      <div class="item">
        <a href="../../Cadastros/cadastroFunc.html">Cadastro de Funcionarios</a>
      </div>
      <div class="item">
        <a href="../../Cadastros/cadastroPaciente.html">Cadastro de Pacientes</a>
      </div>
      <div class="item">
        <a href="../dados.html">Listagem de Dados</a>
      </div>
    </div>
  </nav>

  <div class="container">
    <h3>Endereços Cadastrados</h3>
    <table class="table table-striped table-hover">
      <tr>
        <th></th>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Cidade</th>
        <th>Estado</th>
      </tr>

      <?php
      foreach ($arrayEnderecos as $endereco) {
        echo <<<HTML
          <tr>
            <td><a href="controlador.php?acao=excluirEndereco&cep=$endereco->cep">Excluir</a></td> 
            <td>$endereco->cep</td> 
            <td>$endereco->logradouro</td>
            <td>$endereco->cidade</td>
            <td>$endereco->estado</td>
          </tr>      
        HTML;
      }
      ?>

    </table>
    <p><a href="../dados.html">Voltar para os dados</a></p>
  </div>

</body>

</html>