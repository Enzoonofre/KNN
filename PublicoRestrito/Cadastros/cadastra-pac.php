<?php

require "../conexaoMysql.php";
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
$tipo_sanguineo = $_POST["tipo_sanguineo"] ?? "";

$sql1 = <<<SQL
  INSERT INTO Pessoa (nome, sexo, email, 
                       telefone, cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO Paciente 
    (peso, altura, tipo_sanguineo, codigo_pessoa)
  VALUES (?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $nome, $sexo, $email, $telefone, $cep,
    $logradouro, $cidade, $estado
  ])) throw new Exception('Falha na primeira inserção');

  $codNovoPaciente = $pdo->lastInsertId();
  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $peso, $altura, $tipo_sanguineo, $codNovoPaciente
  ])) throw new Exception('Falha na segunda inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: cadastroPaciente.html");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt1->errorInfo()[1] === 1062) {
    exit('Dados duplicados: ' . $e->getMessage());
  } else {
    exit('Falha ao cadastrar os dados do Paciente: ' . $e->getMessage());
  }
}
?>
