<?php

class Paciente
{
  public $nome;  
  public $peso;
  public $altura;
  public $tipoSanguineo;

  function __construct($nome, $peso, $altura, $tipoSanguineo)
  {
    $this->nome = $nome;
    $this->peso = $peso;
    $this->altura = $altura;
    $this->tipoSanguineo = $tipoSanguineo;
  }

  public static function GetData($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT Nome, Peso, Altura, TipoSanguineo
      FROM Pessoa JOIN Paciente ON Paciente.Codigo = Pessoa.Codigo
      SQL;

      // Neste exemplo não é necessário utilizar prepared statements
      // porque não há a possibilidade de inj. de S-Q-L, 
      // pois nenhum parâmetro do usuário é utilizado na query SQL. 
      $stmt = $pdo->query($sql);

      $arrayPacientes = [];
      while ($row = $stmt->fetch()) {
        // Sanitiza os dados produzidos pelo usuário
        // que oferecem risco de X S S
        $nome = htmlspecialchars($row['nome']);
        $peso = htmlspecialchars($row['peso']);
        $altura = htmlspecialchars($row['altura']);
        $tipoSanguineo = htmlspecialchars($row['tipo_sanguineo']);
  

        // Cria um novo objeto do tipo Cliente e adiciona
        // no final do array de clientes
        $novoPaciente = new Paciente(
            $nome,
            $peso,
            $altura,
            $tipoSanguineo
        );
        $arrayPacientes[] = $novoPaciente;
      }
      return $arrayPacientes;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}