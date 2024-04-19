<?php

require "conexaoMysql.php";
require "paciente.php";

// resgatar a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {
  
  case "cadastrarPaciente":
    // Resgata os dados do formulário
    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $peso = $_POST["peso"] ?? "";
    $altura = $_POST["altura"] ?? "";
    $tipo_sanguineo = $_POST["tipo_sanguineo"] ?? "";

    // Cria um novo objeto Paciente
    $novoPaciente = new Paciente(
      $nome,
      $sexo,
      $email,
      $telefone,
      $peso,
      $altura,
      $tipo_sanguineo
    );

    // Adiciona o paciente ao banco de dados
    $novoPaciente->addToDatabase($pdo);
    header("location: controlador.php?acao=listarPacientes");
    break;

  //-----------------------------------------------------------------
  case "excluirPaciente":
    $idPaciente = $_GET["idPaciente"] ?? "";
    $pdo = mysqlConnect();
    Paciente::removerPorId($pdo, $idPaciente);
    header("location: controlador.php?acao=listarPacientes");
    break;

  //-----------------------------------------------------------------
  case "listarPacientes":
    $arrayPacientes = Paciente::getAll($pdo);
    
    // O script mostra-pac.php produzirá uma página dinâmica
    // utilizando os dados do array acima ($arrayPacientes)
    include "mostra-pac.php";
    break;

  //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}
