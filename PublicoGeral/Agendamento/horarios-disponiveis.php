<?php
var_dump($_POST);
$data = $_POST['data'];
$medico = $_POST['medico'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

// consulta para obter o código do médico
$query = $pdo->prepare('SELECT codmedico FROM Medico WHERE nome = ?');
$query->execute([$medico]);
$codmedico = $query->fetchColumn();
var_dump($codmedico);

// consulta para obter os horários agendados
$query = $pdo->prepare('SELECT horario FROM Agenda WHERE data = ? AND codmedico = ?');
$query->execute([$data, $codmedico]);
$horariosAgendados = $query->fetchAll(PDO::FETCH_COLUMN);
var_dump($horariosAgendados);
// todos os horários possíveis
$horariosPossiveis = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00', '17:00:00'];

// remove os horários agendados dos horários possíveis
$horariosDisponiveis = array_diff($horariosPossiveis, $horariosAgendados);

echo json_encode($horariosDisponiveis);
?>