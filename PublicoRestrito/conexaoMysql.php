<?php

function mysqlConnect()
{
  $db_host = "sql109.infinityfree.com";
  $db_username = "if0_35771761";
  $db_password = "rQpubmCDA2f";
  $db_name = "if0_35771761_trab_ppi";

  /*
  Criei um outro BD pq n sabia como mudar o antigo kk. Mas não mudei nada demais não, só
  adicionei a tabela Endereco(tirei da tabela Pessoa). Por isso, os dados abaixo não funcionam mais.
  $db_host = "sql109.infinityfree.com";
  $db_username = "if0_35771761";
  $db_password = "rQpubmCDA2f";
  $db_name = "if0_35771761_trab_ppi";*/

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
?>
