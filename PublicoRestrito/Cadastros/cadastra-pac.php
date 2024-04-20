<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados do Paciente
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["log"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipo_sanguineo = $_POST["tipo_sanguineo"] ?? "";

$sql = <<<SQL
  INSERT INTO Paciente (nome, sexo, email, telefone, cep, logradouro, cidade, estado, peso, altura, tipo_sanguineo)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare($sql);
  if (!$stmt->execute([$nome, $sexo, $email, $telefone, $peso, $altura, $tipo_sanguineo])) {
    throw new Exception('Falha na inserção do Paciente');
  }

  // Efetiva as operações
  $pdo->commit();

  header("location: cadastroPaciente.html");
  exit();
} catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt->errorInfo()[1] === 1062) {
    exit('Dados duplicados: ' . $e->getMessage());
  } else {
    exit('Falha ao cadastrar os dados do Paciente: ' . $e->getMessage());
  }
}
?>
