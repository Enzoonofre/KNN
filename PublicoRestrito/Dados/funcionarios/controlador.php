<?php

require "conexaoMysql.php";
require "funcionario.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {
  
  case "adicionarFuncionario":
    // recupera os dados do formulário
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

    // Cria um novo funcionário com os dados fornecidos
    $novoFuncionario = new Funcionario(
      $nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado, $data_inicio, $salario, $senha, $cargo
    );

    // Adiciona o funcionário ao banco de dados
    $novoFuncionario->addToDatabase($pdo);
    header("location: controlador.php?acao=listarFuncionarios");
    break;

  //-----------------------------------------------------------------
  case "excluirFuncionario":
    $idFuncionario = $_GET["idFuncionario"] ?? "";
    $pdo = mysqlConnect();
    Funcionario::removeById($pdo, $idFuncionario);
    header("location: controlador.php?acao=listarFuncionarios");
    break;

  //-----------------------------------------------------------------
  case "listarFuncionarios":
    $arrayFuncionarios = Funcionario::getAll($pdo);
    
    // O script mostra-func.php produzirá uma página dinâmica
    // utilizando os dados do array acima ($arrayFuncionarios)
    include "mostra-func.php";
    break;

  //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}
