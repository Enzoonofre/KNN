<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados de Agendamento
$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$especialidade = $_POST["especialidade"] ?? "";
$nomeMed = $_POST["nomeMed"] ?? "";
$data = $_POST["data"] ?? ""; 
$hora = $_POST["horario"] ?? ""; 

// Obtenha o código do médico usando o nome e a especialidade
$sqlMedico = <<<SQL
  SELECT Medico.Codigo FROM Medico
  JOIN Funcionario ON Medico.Codigo = Funcionario.Codigo
  JOIN Pessoa ON Funcionario.Codigo = Pessoa.Codigo
  WHERE Pessoa.Nome = ? AND Medico.Especialidade = ?
SQL;

$stmtMedico = $pdo->prepare($sqlMedico);
$stmtMedico->execute([$nomeMed, $especialidade]);
$medico = $stmtMedico->fetch();

// Se não encontramos um médico correspondente, saia com um erro
if (!$medico) exit('Médico não encontrado');

$codigoMed = $medico['Codigo'];

$sql1 = <<<SQL
  INSERT INTO Agenda (Data, Horario, nome, sexo, email, CodigoMedico)
  VALUES (?, ?, ?, ?, ?, ?)
SQL;

$stmt1 = null;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $data, $hora, $nome, $sexo, $email, $codigoMed
  ])) throw new Exception('Falha na primeira inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: agendarConsulta.php");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt1) {
    $errorInfo = $stmt1->errorInfo();
    exit('Falha ao cadastrar os dados: ' . $e->getMessage() . '. SQL error: ' . $errorInfo[2]);
  } else {
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
  }
}
/*catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt1->errorInfo()[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}*/

//NAO ESTA COMPLETAMENTE CERTO AINDA => Codigo de Agenda e Horario estao com erro