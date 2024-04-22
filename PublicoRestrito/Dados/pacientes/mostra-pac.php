<?php
require 'paciente.php';
require 'conexaoMysql.php';

$pdo = mysqlConnect();

$arrayPacientes = Paciente::GetData($pdo);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dados dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <a href="../../Cadastros/cadastroFuncionario.php">Cadastro de Funcionarios</a>
            </div>
            <div class="item">
                <a href="../../Cadastros/cadastroPaciente.php">Cadastro de Pacientes</a>
            </div>
            <div class="item">
                <a href="../dados.php">Listagem de Dados</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h3>Dados dos Pacientes</h3>
        <table class="table table-striped table-hover">
            <tr>
                <th>Nome</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Tipo Sanguíneo</th>
            </tr>

            <?php
            foreach ($arrayPacientes as $paciente) {
                echo <<<HTML
                <tr>
                    <td>$paciente->nome</td>
                    <td>$paciente->peso</td>
                    <td>$paciente->altura</td>
                    <td>$paciente->tipoSanguineo</td>
                </tr>
            HTML;
            }
            ?>

        </table>
        <p><a href="../dados.php">Voltar para os dados</a></p>
    </div>

</body>

</html>