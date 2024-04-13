<?php

require "../PublicoRestrito/Dados/endereco/conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados de Endereco
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["log"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";


$sql1 = <<<SQL
  INSERT INTO Endereco (cep, logradouro, cidade, 
                       estado)
  VALUES (?, ?, ?, ?)
  SQL;


try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $cep, $logradouro, $cidade, $estado
  ])) throw new Exception('Falha na primeira inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: cadastroEnderecos.html");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt1->errorInfo()[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}