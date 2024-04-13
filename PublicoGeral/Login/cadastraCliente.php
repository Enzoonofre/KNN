<?php
function checkLogin($pdo, $email, $senha){


  $sql = <<<SQL
    SELECT *
    FROM Funcionario
    INNER JOIN Pessoa ON Funcionario.Codigo = Pessoa.Codigo
    WHERE Pessoa.Email = (:email) AND Funcionario.SenhaHash = (:senha)
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':senha', $senha);
  $stmt->execute();

  if($stmt->fetch(PDO::FETCH_ASSOC)) {
    return true; // Se encontrou um funcionário, retorna true
  } else {
    return false; // Se não encontrou nenhum funcionário, retorna false
  }
}

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"];
$senha = $_POST["senha"];

if (checkLogin($pdo, $email, $senha))
  header("location: teste.html");
else
header("location: teste2.html");

