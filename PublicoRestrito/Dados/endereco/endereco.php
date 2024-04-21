<?php

class Endereco
{
  public $cep;
  public $logradouro;
  public $cidade;
  public $estado;

  function __construct($cep, $logradouro, $cidade, $estado)
  {
    $this->cep = $cep;
    $this->logradouro = $logradouro;
    $this->cidade = $cidade;
    $this->estado = $estado;
  }

  public static function GetData($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT cep, logradouro, cidade, estado
      FROM Endereco
      SQL;

      // Neste exemplo não é necessário utilizar prepared statements
      // porque não há a possibilidade de inj. de S-Q-L, 
      // pois nenhum parâmetro do usuário é utilizado na query SQL. 
      $stmt = $pdo->query($sql);

      $arrayEnderecos = [];
      while ($row = $stmt->fetch()) {
        // Sanitiza os dados produzidos pelo usuário
        // que oferecem risco de X S S
        $cep = htmlspecialchars($row['cep']);
        $logradouro = htmlspecialchars($row['logradouro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
  

        // Cria um novo objeto do tipo Cliente e adiciona
        // no final do array de clientes
        $novoEndereco = new Endereco(
          $cep,
          $logradouro,
          $cidade,
          $estado
        );
        $arrayEnderecos[] = $novoEndereco;
      }
      return $arrayEnderecos;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}