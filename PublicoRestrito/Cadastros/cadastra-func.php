<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do Funcionario
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["log"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$data_inicio = $_POST["data_inicio"] ?? "";
$salario = $_POST["salario"] ?? "";
$senha = $_POST["senha"] ?? "";
$cargo = $_POST["cargo"] ?? "";

$sql1 = <<<SQL
  INSERT INTO Funcionario (nome, sexo, email, telefone, cep, logradouro, cidade, estado, data_inicio, salario, senha, cargo)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$nome, $sexo, $email, $telefone, $data_inicio, $salario, $senha, $cargo])) {
    throw new Exception('Falha na inserção do Funcionario');
  }

  // Efetiva as operações
  $pdo->commit();

  header("location: cadastroFunc.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt->errorInfo()[1] === 1062) {
    exit('Dados duplicados: ' . $e->getMessage());
  } else {
    exit('Falha ao cadastrar os dados do Funcionario: ' . $e->getMessage());
  }
}
?>
