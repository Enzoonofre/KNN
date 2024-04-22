<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Listagem de dados</title>
    <link rel="stylesheet" href="style2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <div class="item_header">
            <img src="imagens/logo2.jpg" alt="Logo Clínica" id="logo">
        </div>
    </header>

    <nav>
        <div class="conteiner">
            <div class="item">
                <a href="../homeRestrito.php">Home</a>
            </div>
            <div class="item">
                <a href="../Cadastros/cadastroFuncionario.php">Cadastro de Funcionarios</a>
            </div>
            <div class="item">
                <a href="../Cadastros/cadastroPaciente.php">Cadastro de Pacientes</a>
            </div>
        </div>
    </nav>

    <main>
        <div class="conteiner2">
            <label for="selecione">Selecione a opção desejada:</label>
            <select name="opc" id="selecione">
                <option value="" selected>Selecione</option>
                <option value="funcionarios/mostra-func.php">Funcionarios Cadastrados</option>
                <option value="pacientes/mostra-pac.php">Pacientes Cadastrados</option>
                <option value="endereco/mostra-enderecos.php">Endereços Auxiliares</option>
                <option value="agendamentos/mostra-agendamentos.php">Agendamentos realizados por
                    clientes</option>
                <?php if (isset($_SESSION['is_doctor'])): ?>
                    <option value="meusAgendamentos/mostra-agendamentos.php" id="campoMed">Meus Agendamentos</option>
                <?php endif; ?>
            </select>

            <button type="submit" id="btn">OK</button>
        </div>
    </main>

    <footer>
        <address>Avenida João Naves de Ávila 2121, Santa Mônica, Uberlândia</address>
    </footer>

    <script src="redirecionamento.js"></script>
</body>

</html>