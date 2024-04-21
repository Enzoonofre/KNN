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

// Resgata os dados de Funcionário
$data_inicio = $_POST["DataContrato"] ?? "";
$salario = $_POST["salario"] ?? "";
$senha = $_POST["senha"] ?? "";
$cargo = $_POST["cargo"] ?? "";

// Resgata os dados de Médico
$especialidade = $_POST["especialidade"] ?? "";
$crm = $_POST["crm"] ?? "";

$sql1 = <<<SQL
  INSERT INTO Pessoa (nome, sexo, email, 
                       telefone, cep, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO Funcionario (data_inicio, salario, senha, cargo, Codigo)
  VALUES (?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql);
  if (!$stmt1->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado])) {
    throw new Exception('Falha na primeira inserção');
  }

  $codNovoFunc = $pdo->lastInsertId();
  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $data_inicio, $salario, $senha, $cargo, $codNovoFunc
  ])) throw new Exception('Falha na segunda inserção');

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
