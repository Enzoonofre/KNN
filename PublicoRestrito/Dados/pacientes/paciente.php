<?php

class Paciente
{
  public $nome;
  public $sexo;
  public $email;
  public $telefone;
  public $cep;
  public $logradouro;
  public $cidade;
  public $estado;
  public $peso;
  public $altura;
  public $tipo_sanguineo;

  function __construct($nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado, $peso, $altura, $tipo_sanguineo)
  {
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->email = $email;
    $this->telefone = $telefone;
    $this->cep = $cep;
    $this->logradouro = $logradouro;
    $this->cidade = $cidade;
    $this->estado = $estado;
    $this->peso = $peso;
    $this->altura = $altura;
    $this->tipo_sanguineo = $tipo_sanguineo;
  }

  // Adiciona os dados do objeto (paciente)
  // na tabela paciente do banco de dados
  public function addToDatabase($pdo)
  {
    try {
      $sql = <<<SQL
      INSERT INTO Paciente (nome, sexo, email, telefone, cep, logradouro, cidade, estado, peso, altura, tipo_sanguineo)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      SQL;

      // Utiliza prepared statements para prevenir
      // ataques do tipo SQL Injection
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$this->nome, $this->sexo, $this->email, $this->telefone, $this->cep, $this->logradouro, $this->cidade, $this->estado, $this->peso, $this->altura, $this->tipo_sanguineo]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para retornar todos os pacientes
  // da tabela.
  public static function getAll($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT nome, sexo, email, telefone, cep, logradouro, cidade, estado, peso, altura, tipo_sanguineo
      FROM Paciente
      SQL;

      $stmt = $pdo->query($sql);

      $arrayPacientes = [];
      while ($row = $stmt->fetch()) {
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $cep = htmlspecialchars($row['cep']);
        $logradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
        $peso = htmlspecialchars($row['peso']);
        $altura = htmlspecialchars($row['altura']);
        $tipo_sanguineo = htmlspecialchars($row['tipo_sanguineo']);

        $novoPaciente = new Paciente(
          $nome,
          $sexo,
          $email,
          $telefone,
          $cep,
          $logradouro,
          $cidade,
          $estado,
          $peso,
          $altura,
          $tipo_sanguineo
        );
        $arrayPacientes[] = $novoPaciente;
      }
      return $arrayPacientes;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para excluir um paciente
  public static function removerPorId($pdo, $idPaciente)
  {
    try {
      $sql = <<<SQL
      DELETE FROM Paciente
      WHERE idPaciente = ?
      LIMIT 1
      SQL;

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$idPaciente]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}

?>
