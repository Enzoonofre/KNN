<?php

function mysqlConnect()
{
  $db_host = "sql213.infinityfree.com";
  $db_username = "if0_36331575";
  $db_password = "9W7CGtUaQc";
  $db_name = "if0_36331575_ppi";

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