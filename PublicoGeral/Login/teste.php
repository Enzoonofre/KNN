<?php
require "../conexaoMysql.php";
require "sessionVerification.php";

session_start();
exitWhenNotLoggedIn();

$pdo = mysqlConnect();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, inicial-scale=1.0">
</head>

<body>
    <h1>DEU CERTO</h1>
    <h2>Dados corretos! Bem Vindo, <?php echo $_SESSION['user'] ?>!</h2>
    <hr>
    <p><strong>Dica:</strong> clique em sair e posteriormente tente acessar esta página digitando diretamente 'home.php' na barra de endereços do navegador</p>
    <a href="logout.php">SAIR<a>
</body>

</html>