<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

try {

  // $nomeHtmlSpecialChars = htmlspecialchars($nome);
  // $telefoneHtmlSpecialChars = htmlspecialchars($telefone);

  // NÃO FAÇA ISSO! Exemplo de código vulnerável a inj. de S-Q-L
  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES (?, ?);
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $telefone]);

  // Experimente fazer o cadastro de um novo aluno preenchendo 
  // o campo telefone utilizando o texto disponibilizado pelo professor
  // nos slides de aula
  // $pdo->exec($sql);
  header("location: mostra-alunos.php");
  exit();
} catch (Exception $e) {
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
