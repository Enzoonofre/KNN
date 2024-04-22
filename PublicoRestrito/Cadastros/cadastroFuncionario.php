<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial scale=1">
    <meta name="description" content="Página de Cadastro para Funcionários">
    <link rel="stylesheet" href="styleFuncPac.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Página de Cadastro para Funcionários</title>
</head>

<body>

    <header>
        <div>
            <div class="item_header">
                <img src="../imagens/logo2.jpg" alt="Logo Clínica" id="logo">
            </div>

        </div>
    </header>

    <nav>
        <div class="conteiner2">
            <div class="item">
                <a href="../homeRestrito.php">Home</a>
            </div>
            <div class="item">
                <a href="cadastroPaciente.php">Cadastro de Pacientes</a>
            </div>
            <div class="item">
                <a href="../Dados/dados.php">Listagem de Dados</a>
            </div>
        </div>
    </nav>

    <main>
        <form action="cadastraFunc.php" method="post" class="validation-form">

            <fieldset class="container">
                <legend>DADOS NECESSÁRIOS</legend>
                <div>
                    <div>
                        <label for="nome" class="form-label">Nome completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div>
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo" required>
                            <option value="" selected disabled hidden>Selecione o sexo</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                        </select>
                    </div>
                    <div>
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="\d{10,11}"
                            required>
                    </div>
                    <div>
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-\d{3}" required>
                    </div>
                    <div>
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                    </div>
                    <div>
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                    </div>
                    <div>
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="">Selecione</option>
                            <option value="AC">Acre</option>
                            <option value="AL">Alagoas</option>
                            <option value="AP">Amapá</option>
                            <option value="AM">Amazonas</option>
                            <option value="BA">Bahia</option>
                            <option value="CE">Ceará</option>
                            <option value="DF">Distrito Federal</option>
                            <option value="ES">Espírito Santo</option>
                            <option value="GO">Goiás</option>
                            <option value="MA">Maranhão</option>
                            <option value="MT">Mato Grosso</option>
                            <option value="MS">Mato Grosso do Sul</option>
                            <option value="MG">Minas Gerais</option>
                            <option value="PA">Pará</option>
                            <option value="PB">Paraíba</option>
                            <option value="PR">Paraná</option>
                            <option value="PE">Pernambuco</option>
                            <option value="PI">Piauí</option>
                            <option value="RJ">Rio de Janeiro</option>
                            <option value="RN">Rio Grande do Norte</option>
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="RO">Rondônia</option>
                            <option value="RR">Roraima</option>
                            <option value="SC">Santa Catarina</option>
                            <option value="SP">São Paulo</option>
                            <option value="SE">Sergipe</option>
                            <option value="TO">Tocantins</option>
                        </select>
                    </div>
                    <div>
                        <label for="data_inicio" class="form-label">Data de Início do Contrato</label>
                        <input type="date" class="form-control" id="data_inicio" name="DataContrato" required>
                    </div>
                    <div>
                        <label for="salario" class="form-label">Salário</label>
                        <input type="text" class="form-control" id="salario" name="salario" required>
                    </div>
                    <div>
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <label for="cargo">Cargo</label>
                    <select class="form-control" id="cargo" name="cargo" required>
                        <option value="" selected disabled hidden>Selecione o cargo</option>
                        <option value="comum">Funcionário Comum</option>
                        <option value="medico">Funcionário Médico</option>
                    </select>
                </div>
                <div id="medicoCampos" style="display: none;">
                    <div>
                        <label for="especialidade">Especialidade</label>
                        <input type="text" class="form-control" id="especialidade" name="especialidade">
                    </div>
                    <div>
                        <label for="crm">CRM</label>
                        <input type="text" class="form-control" id="crm" name="crm">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" id="botao">Cadastrar</button>
                </div>
            </fieldset>
        </form>
    </main>

    <footer class="foot">
        <address>Avenida João Naves de Ávila 2121, Santa Mônica, Uberlândia</address>
    </footer>

    <script>
        function buscaCidade(cep) {

            if (cep.length != 9) return;

            let xhr = new XMLHttpRequest();
            xhr.open("GET", "baseEndereco.php?cep=" + cep);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);

                    // Definindo os valores dos elementos com base na resposta do servidor
                    document.querySelector("#logradouro").value = responseData.logradouro_base;
                    document.querySelector("#cidade").value = responseData.cidade_base;

                    var estadoSelect = document.getElementById("estado");

                    // Iterando sobre as opções para encontrar a correspondente ao valor desejado
                    for (var i = 0; i < estadoSelect.options.length; i++) {
                        if (estadoSelect.options[i].value === responseData.estado_base) {
                            // Definindo a opção como selecionada
                            estadoSelect.options[i].selected = true;
                            break; // Saindo do loop, pois já encontramos e selecionamos a opção desejada
                        }
                    }
                } else {
                    console.error('Erro ao carregar dados do servidor.');
                }
            };
            xhr.onerror = function () {
                console.log("Erro de rede");
            };

            xhr.send();
        }

        window.onload = function () {
            const inputCep = document.querySelector("#cep");
            inputCep.onkeyup = () => buscaCidade(inputCep.value);
        }
    </script>

    <script src="script.js"></script>
</body>



</html>