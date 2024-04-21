<?php

class Agendamento
{
  public $nome;
  public $sexo;
  public $data;
  public $hora;
  public $codigoMed;

  function __construct($nome, $sexo, $data, $hora, $codigoMed)
  {
    $this->nome = $nome;
    $this->sexo = $sexo;
    $this->data = $data;
    $this->hora = $hora;
    $this->codigoMed = $codigoMed;
  }

  // Adiciona os dados do objeto (endereco)
  // na tabela endereco do banco de dados
 /* public function AddToDatabase($pdo)
  {
    try {
      $sql = <<<SQL
      -- Repare que a coluna Id foi omitida por ser auto_increment
      INSERT INTO Agenda (Nome, Sexo, Data, Horario, CodigoMedico)
      VALUES (?, ?, ?, ?, ?)
      SQL;

      // Neste caso utilize prepared statements para prevenir
      // ataques do tipo S-Q-L Inj., pois precisamos
      // cadastrar dados fornecidos pelo usuário 
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$this->nome, $this->sexo, $this->data, $this->hora, $this->codigoMed]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }*/

  // Método estático para retornar, na forma de um
  // array de objetos, os 30 enderecos iniciais da tabela.
  // O método retorna os dados sanitizados e com a data
  // de nascimento no formato dia/mês/ano. Métodos estáticos
  // estão associados à classe em si, e não a uma instância.
  // No PHP devem ser chamados com a sintaxe:
  // NomeDaClasse::NomeDoMétodo
  public static function GetData($pdo)
  {
    try {
      $sql = <<<SQL
      SELECT Nome, Sexo, Data, Horario, CodigoMedico
      FROM Agenda
      SQL;

      // Neste exemplo não é necessário utilizar prepared statements
      // porque não há a possibilidade de inj. de S-Q-L, 
      // pois nenhum parâmetro do usuário é utilizado na query SQL. 
      $stmt = $pdo->query($sql);

      $arrayAgendamentos = [];
      while ($row = $stmt->fetch()) {
        // Sanitiza os dados produzidos pelo usuário
        // que oferecem risco de X S S
        $nome = htmlspecialchars($row['Nome']);
        $sexo = htmlspecialchars($row['Sexo']);
        $data = htmlspecialchars($row['Data']);
        $hora = htmlspecialchars($row['Horario']);
        $codigoMed = htmlspecialchars($row['CodigoMedico']);
  

        // Cria um novo objeto do tipo Cliente e adiciona
        // no final do array de clientes
        $novoAgendamento = new Agendamento(
          $nome,
          $sexo,
          $data,
          $hora,
          $codigoMed
        );
        $arrayAgendamentos[] = $novoAgendamento;
      }
      return $arrayAgendamentos;
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }

  // Método estático para excluir um cliente
  // dado o seu CPF
  /*public static function RemoveByData($pdo, $data)
  {
    try {
      $sql = <<<SQL
      DELETE FROM Agenda /*verificar nome no BD da tabela endereco se é igual
      WHERE Data = ?
      LIMIT 1
      SQL;

      // Necessário utilizar prepared statements devido ao parâmetro
      // informado pelo usuário
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$data]);
    } catch (Exception $e) {
      exit('Falha inesperada: ' . $e->getMessage());
    }
  }*/
}