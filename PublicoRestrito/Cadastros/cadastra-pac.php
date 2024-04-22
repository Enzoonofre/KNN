<?php

require "../Dados/funcionarios/conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados de Pessoa
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

// Resgata os dados de Paciente
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipoSanguineo = $_POST["tipo_sanguineo"] ?? "";

try {
  $pdo->beginTransaction();
  // Insere dados na tabela Pessoa
  $sql = <<<SQL
  INSERT INTO Pessoa (Nome, Sexo, Email, Telefone)
  VALUES (?, ?, ?, ?)
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $sexo, $email, $telefone]);
  $codigo_pessoa = $pdo->lastInsertId();

  $sql = <<<SQL
INSERT INTO Endereco (Codigo, CEP, Logradouro, Cidade, Estado)
VALUES (?, ?, ?, ?, ?)
SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$codigo_pessoa, $cep, $logradouro, $cidade, $estado]);


  // Insere dados na tabela Funcionario
  $sql = <<<SQL
      INSERT INTO Paciente (Codigo, Peso, Altura, TipoSanguineo)
      VALUES (?, ?, ?, ?)
  SQL;
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$codigo_pessoa, $peso, $altura, $tipoSanguineo]);

  // Efetiva as operações
  $pdo->commit();

  header("location: cadastroPaciente.php");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();

  exit('Falha ao cadastrar os dados do Paciente: ' . $e->getMessage());

}
?>