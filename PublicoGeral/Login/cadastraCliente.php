<?php



class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}


function checkLogin($pdo, $email, $senha){


  $sql = <<<SQL
    SELECT *
    FROM Funcionario
    INNER JOIN Pessoa ON Funcionario.Codigo = Pessoa.Codigo
    WHERE Pessoa.Email = (:email) AND Funcionario.SenhaHash = (:senha)
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':senha', $senha);
  $stmt->execute();

  if($stmt->fetch(PDO::FETCH_ASSOC)) {
    return true; // Se encontrou um funcionário, retorna true
  } else {
    return false; // Se não encontrou nenhum funcionário, retorna false
  }
}

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"];
$senha = $_POST["senha"];

if (checkLogin($pdo, $email, $senha)){
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams);

  // inicializa a sessão
  session_start();
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $email;

  $response = new RequestResponse(true, 'teste.php');
}
else
  $response = new RequestResponse(false, 'teste2.html');
header('Content-type: application/json');
echo json_encode($response);
