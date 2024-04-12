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

  // Adiciona os dados do objeto (endereco)
  // na tabela endereco do banco de dados
  public function AddToDatabase($pdo)
  {
    try {
      $sql = <<<SQL
      -- Repare que a coluna Id foi omitida por ser auto_increment
      INSERT INTO endereco (cep, logradouro, cidade, estado)
      VALUES (?, ?, ?, ?)
      SQL;

      // Neste caso utilize prepared statements para prevenir
      // ataques do tipo S-Q-L Inj., pois precisamos
      // cadastrar dados fornecidos pelo usuário 
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$this->cep, $this->logradouro, $this->cidade, $this->estado]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para retornar, na forma de um
  // array de objetos, os 30 enderecos iniciais da tabela.
  // O método retorna os dados sanitizados e com a data
  // de nascimento no formato dia/mês/ano. Métodos estáticos
  // estão associados à classe em si, e não a uma instância.
  // No PHP devem ser chamados com a sintaxe:
  // NomeDaClasse::NomeDoMétodo
  public static function GetFirst30($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT cep, logradouro, cidade, estado
      FROM endereco
      LIMIT 30
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
        $logradouro = htmlspecialchars($row['log']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
  

        // Cria um novo objeto do tipo Cliente e adiciona
        // no final do array de clientes
        $novoEndereco = new Endereco(
          $cep,
          $logradouro,
          $cidade,
          $estado,
        );
        $arrayEnderecos[] = $novoEndereco;
      }
      return $arrayEnderecos;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para excluir um cliente
  // dado o seu CPF
  public static function RemoveByCEP($pdo, $cep)
  {
    try {
      $sql = <<<SQL
      DELETE FROM endereco /*verificar nome no BD da tabela endereco se é igual*/
      WHERE cep = ?
      LIMIT 1
      SQL;

      // Necessário utilizar prepared statements devido ao parâmetro
      // informado pelo usuário
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$cep]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }
}