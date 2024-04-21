<?php

function mysqlConnect()
{
  $db_host = "sql109.infinityfree.com";
  $db_username = "if0_35771761";
  $db_password = "rQpubmCDA2f";
  $db_name = "if0_35771761_trab_ppi";

  /*
  Criei um outro BD pq n sabia como mudar o antigo kk. Mas não mudei nada demais não, só
  adicionei a tabela Endereco(tirei da tabela Pessoa). Por isso, os dados abaixo não funcionam mais.
  $db_host = "sql109.infinityfree.com";
  $db_username = "if0_35771761";
  $db_password = "rQpubmCDA2f";
  $db_name = "if0_35771761_trab_ppi";*/

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}

$pdo = mysqlConnect();

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os valores dos campos do formulário
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $data_inicio = $_POST['data_inicio'];
    $salario = $_POST['salario'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo'];

    // Verifica se o cargo selecionado é "Funcionário Médico" para capturar os campos adicionais
    if ($cargo == "medico") {
        $especialidade = $_POST['especialidade'];
        $crm = $_POST['crm'];
    }
}

  // Inicia uma transação
  $pdo->beginTransaction();

  try{
    // Insere dados na tabela Pessoa
  $sql = <<<SQL
  INSERT INTO Pessoa (Nome, Sexo, Email, Telefone)
  VALUES (?, ?, ?, ?)
  SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $sexo, $email, $telefone]);
$codigo_pessoa = $pdo->lastInsertId();

$sql = <<<SQL
INSERT INTO Endereco (codigo_pessoa, CEP, Logradouro, Cidade, Estado)
VALUES (?, ?, ?, ?, ?)
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$codigo_pessoa, $cep, $logradouro, $cidade,$estado]);


// Insere dados na tabela Funcionario
$sql = <<<SQL
      INSERT INTO Funcionario (Codigo, DataContrato, Salario, SenhaHash)
      VALUES (?, ?, ?, ?)
  SQL;
$stmt = $pdo->prepare($sql);
$stmt->execute([$codigo_pessoa, $data_inicio, $salario, $senha]);

// Se o cargo for "medico", insere dados na tabela Medico
if ($cargo == "medico") {

    // Insere dados na tabela Medico
    $sql = <<<SQL
      INSERT INTO Medico (Codigo, Especialidade, CRM)
      VALUES (?, ?, ?)
      SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$codigo_pessoa, $especialidade, $crm]);
}

// Confirma a transação
$pdo->commit();
echo "Cadastro realizado com sucesso!";
header("location: cadastroFunc.html");
exit();
  }
  
    
 catch(PDOException $e) {
    // Caso ocorra algum erro, reverte a transação e exibe uma mensagem de erro
    $pdo->rollBack();
    echo "Erro: " . $e->getMessage();
}