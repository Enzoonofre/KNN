<?php

require "conexaoMysql.php";
require "agendamento.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {

    case "adicionarAgendamento":
        // Resgata os dados de Agendamento
        $nome = $_POST["nome"] ?? "";
        $sexo = $_POST["sexo"] ?? "";
        $data = $_POST["data"] ?? "";
        $hora = $_POST["horario"] ?? "";


        $novoAgendamento = new Agendamento(
            $nome,
            $sexo,
            $data,
            $hora,
            $codigoMed
        );

        // adiciona o cliente na tabela do banco de dados
        $novoAgendamento->AddToDatabase($pdo);
        header("location: controlador.php?acao=listarAgendamentos");
        //header("location: cadastroEnderecos.html");
        break;

    //-----------------------------------------------------------------
    case "excluirAgendamento":
        $cep = $_GET["data"] ?? "";
        $pdo = mysqlConnect();
        Agendamento::RemoveByData($pdo, $data);
        header("location: controlador.php?acao=listarAgendamentos");
        break;

    //-----------------------------------------------------------------
    case "listarAgendamentos":
        $arrayAgendamentos = Agendamento::GetFirst30($pdo);

        // O script mostra-clientes.php produzirá uma página dinâmica
        // utilizando os dados do array acima ($arrayProdutos)
        include "mostra-agendamentos.php";
        break;

    //-----------------------------------------------------------------
    default:
        exit("Ação não disponível");
}