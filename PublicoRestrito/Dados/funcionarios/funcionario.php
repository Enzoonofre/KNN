<?php

class Funcionario
{
  public $nome;
  public $sexo;
  public $email;
  public $telefone;
  public $data_inicio;
  public $salario;
  public $senha;
  public $cargo;

  function __construct($nome, $sexo, $email, $telefone, $data_inicio, $salario, $senha, $cargo)
  {
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->email = $email;
    $this->telefone = $telefone;
    $this->data_inicio = $data_inicio;
    $this->salario = $salario;
    $this->senha = $senha;
    $this->cargo = $cargo;
  }

  // Adiciona os dados do objeto (funcionário)
  // na tabela funcionario do banco de dados
  public function addToDatabase($pdo)
  {
    try {
      $sql = <<<SQL
      -- Repare que a coluna Id foi omitida por ser auto_increment
      INSERT INTO Funcionario (nome, sexo, email, telefone, data_inicio, salario, senha, cargo)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)
      SQL;

      // Neste caso utilize prepared statements para prevenir
      // ataques do tipo S-Q-L Inj., pois precisamos
      // cadastrar dados fornecidos pelo usuário 
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$this->nome, $this->sexo, $this->email, $this->telefone, $this->data_inicio, $this->salario, $this->senha, $this->cargo]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para retornar todos os funcionários
  // da tabela.
  public static function getAll($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT nome, sexo, email, telefone, data_inicio, salario, senha, cargo
      FROM Funcionario
      SQL;

      // Neste exemplo não é necessário utilizar prepared statements
      // porque não há a possibilidade de inj. de S-Q-L, 
      // pois nenhum parâmetro do usuário é utilizado na query SQL. 
      $stmt = $pdo->query($sql);

      $arrayFuncionarios = [];
      while ($row = $stmt->fetch()) {
        // Sanitiza os dados produzidos pelo usuário
        // que oferecem risco de XSS
        $nome = htmlspecialchars($row['nome']);
        $sexo = htmlspecialchars($row['sexo']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $data_inicio = htmlspecialchars($row['data_inicio']);
        $salario = htmlspecialchars($row['salario']);
        $senha = htmlspecialchars($row['senha']);
        $cargo = htmlspecialchars($row['cargo']);

        // Cria um novo objeto do tipo Funcionario e adiciona
        // no final do array de funcionários
        $novoFuncionario = new Funcionario(
          $nome,
          $sexo,
          $email,
          $telefone,
          $data_inicio,
          $salario,
          $senha,
          $cargo
        );
        $arrayFuncionarios[] = $novoFuncionario;
      }
      return $arrayFuncionarios;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para excluir um funcionário
  // dado o seu ID
  public static function removeById($pdo, $idFuncionario)
  {
    try {
      $sql = <<<SQL
      DELETE FROM Funcionario
      WHERE idFuncionario = ?
      LIMIT 1
      SQL;

      // Necessário utilizar prepared statements devido ao parâmetro
      // informado pelo usuário
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$idFuncionario]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}
