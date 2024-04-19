<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dados dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <h3>Dados dos Pacientes</h3>
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Tipo Sanguíneo</th>
            </tr>

            <?php foreach ($arrayPacientes as $paciente) : ?>
                <tr>
                    <td><a href="controlador.php?acao=excluirPaciente&idPaciente=<?= $paciente->id ?>">Excluir</a></td>
                    <td><?= $paciente->nome ?></td>
                    <td><?= $paciente->sexo ?></td>
                    <td><?= $paciente->email ?></td>
                    <td><?= $paciente->telefone ?></td>
                    <td><?= $paciente->peso ?></td>
                    <td><?= $paciente->altura ?></td>
                    <td><?= $paciente->tipo_sanguineo ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
        <p><a href="../dados.html">Voltar para os dados</a></p>
    </div>

</body>

</html>
