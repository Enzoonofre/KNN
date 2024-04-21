<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$especialidade = $_GET['especialidade'];
$nomeMed = $_GET['nomeMed'];
$data = $_GET['data'];

$sql = <<<SQL
    SELECT a.Horario
    FROM Agenda a
    INNER JOIN Medico m
    ON a.CodigoMedico = m.Codigo
    INNER JOIN Pessoa p
    ON m.Codigo = p.Codigo
    WHERE m.Especialidade = ?
    AND p.Nome = ?
    AND a.Data = ?;
SQL;

$stmt = $pdo->prepare($sql);
$stmt->execute([$especialidade, $nomeMed, $data]);

$horariosIndisponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($horariosIndisponiveis);
?>