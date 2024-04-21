<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$sql = 'SELECT Nome FROM Pessoa INNER JOIN Medico ON Pessoa.Codigo = Medico.Codigo';
$stmt = $pdo->query($sql);
$medicos = $stmt->fetchAll();

$sql2 = 'SELECT DISTINCT Especialidade FROM Medico';
$stmt2 = $pdo->query($sql2);
$especialidades = $stmt2->fetchAll();
?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Agendamento</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, inicial-scale=1.0">
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
                <a href="../Home/Home.html">Home</a>
            </div>
            <div class="item">
                <a href="../Galeria/Galeria.html">Galeria</a>
            </div>
            <div class="item">
                <a href="../Login/login.html">Login</a>
            </div>
            <div class="item">
                <a href="../NovoEndereco/cadastroEnderecos.html">Cadastro de endereço</a>
            </div>
        </div>
    </nav>

    <main>
        <h2>Agendamento</h2>

        <form name="consulta" action="cadastra-agendamento.php" method="post">
            <fieldset>
                <legend>Dados Pessoais</legend>

                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" minlength="2" maxlength="50" autofocus>
                    <span></span>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email">
                    <span></span>
                </div>
                <div>
                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo">
                        <option value="" selected>Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <div>
                    <!--Verificar por que o foreach repete duas vezes a especialidade-->
                    <label for="especialidade"> Especialidade médica:</label>
                    <select name="especialidade" id="especialidade">
                        <option value="" selected>Selecione</option>
                        <?php foreach ($especialidades as $especialidade): ?>
                            <option value="<?= $especialidade['Especialidade']; ?>"><?= $especialidade['Especialidade']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="nomeMed">Nome médico:</label>
                    <select name="nomeMed" id="nomeMed">
                        <option value="" selected>Selecione</option>
                        <?php foreach ($medicos as $medico): ?>
                            <option value="<?= htmlspecialchars($medico['Nome'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($medico['Nome'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="data">Data consulta:</label>
                    <input type="date" id="data" name="data">
                </div>
                <div>
                    <!--Adicionar horario ao banco de dados-->
                    <label for="horario">Horário:</label>
                    <select name="horario" id="horario">
                        <option value="" selected>Selecione</option>
                        <!--<option value="08:00:00">8:00</option>
                        <option value="09:00:00">9:00</option>
                        <option value="10:00:00">10:00</option>
                        <option value="11:00:00">11:00</option>
                        <option value="12:00:00">12:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="14:00:00">14:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="16:00:00">16:00</option>
                        <option value="17:00:00">17:00</option>-->
                    </select>
                </div>
            </fieldset>

            <button type="submit" id="botao">Agendar</button>

        </form>

    </main>

    <footer>
        <address>Avenida João Naves de Ávila 2121, Santa Mônica, Uberlândia</address>
    </footer>

    <script>
        document.getElementById('nomeMed').addEventListener('change', function () {
            var medico = this.value;
            var data = document.getElementById('data').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'horarios-disponiveis.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (this.status == 200) {
                    var horarios = JSON.parse(this.responseText);
                    var select = document.getElementById('horario');
                    select.innerHTML = '';
                    for (var i = 0; i < horarios.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = horarios[i];
                        opt.innerHTML = horarios[i];
                        select.appendChild(opt);
                    }
                }
            };
            xhr.send('data=' + data + '&medico=' + medico);
        });
    </script>
</body>


</html>