<?php

require "conexaoMysql.php";
require "produto.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {
  
  case "adicionarProduto":
    // recupera os dados do formulário
    $cep = $_POST["cep"] ?? "";
    $logradouro = $_POST["log"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";


    $novoEndereco = new Endereco(
      $cep, $logradouro, $cidade, $estado //criar Endereco.php com uma classe de contrutor adequado
    );

    // adiciona o cliente na tabela do banco de dados
    $novoEndereco->AddToDatabase($pdo);
    header("location: controlador.php?acao=listarEnderecos");
    break;

  //-----------------------------------------------------------------
  case "excluirEndereco":
    $cep = $_GET["cep"] ?? "";
    $pdo = mysqlConnect();
    Endereco::RemoveByNome($pdo, $cep);
    header("location: controlador.php?acao=listarEnderecos");
    break;

  //-----------------------------------------------------------------
  case "listarEnderecos":
    $arrayEnderecos = Endereco::GetFirst30($pdo);
    
    // O script mostra-clientes.php produzirá uma página dinâmica
    // utilizando os dados do array acima ($arrayProdutos)
    include "mostra-enderecos.php";
    break;

  //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}