<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$especialidade = $_GET['especialidade'];

$sql = <<<SQL
    SELECT p.Nome
    FROM Medico m
    INNER JOIN Pessoa p
    ON m.Codigo = p.Codigo
    WHERE m.Especialidade = ?
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$especialidade]);

$medicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($medicos);
?>