<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Resgata os dados de Endereco
$data = $_POST['data'];
$horario = $_POST['horario'];
$nomeMed = $_POST['nomeMed'];
$nome = $_POST['nome'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];


try {
  $pdo->beginTransaction();

  // Buscar o Codigo do médico usando o nome
  $sql = "SELECT Codigo FROM Medico WHERE Nome = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nomeMed]);
  $codigoMedico = $stmt->fetchColumn();

  if ($codigoMedico === false) {
      throw new Exception("Médico não encontrado: $nomeMed");
  }

  $sql = "INSERT INTO Agenda (Data, Horario, Nome, Sexo, Email, CodigoMedico) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$data, $horario, $nome, $sexo, $email, $codigoMedico]);

  $pdo->commit();

  header("location: agendarConsulta.html");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($stmt->errorInfo()[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}