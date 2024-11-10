<?php

require "conexaoMysql.php";

class LoginResult
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation)
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}

// função que verifica as credenciais de login
function checkUserCredentials($pdo, $email, $senha)
{
  // consulta sql que busca o hash da senha armazenada no bd
  $sql = <<<SQL
    SELECT senhaHash
    FROM cliente
    WHERE email = ?
    SQL;

  try {
    // É necessário utilizar prepared statements por incluir
    // parâmetros informados pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]); // passa o email como parametro na consulta sql
    $senhaHash = $stmt->fetchColumn(); // pega a hash retornada

    if (!$senhaHash) 
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    if (!password_verify($senha, $senhaHash))
      return false; // email e/ou senha incorreta
      
    // email e senha corretos
    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();
if (checkUserCredentials($pdo, $email, $senha)) {
  // Define o parâmetro 'httponly' para o cookie de sessão, para que o cookie
  // possa ser acessado apenas pelo navegador nas requisições http (e não por código JavaScript).
  // Aumenta a segurança evitando que o cookie de sessão seja roubado por eventual
  // código JavaScript proveniente de ataq. X S S.
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams);
  
  session_start(); // inicia sessão
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $email;
  $response = new LoginResult(true, 'home.php'); // prepara resposta sucesso com redirecionamento
} 
else
  $response = new LoginResult(false, ''); 

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);