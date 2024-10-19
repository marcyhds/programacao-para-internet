<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();
$marca = $_GET['marca'] ?? '';

$sql = <<<SQL
        SELECT DISTINCT modelo
        FROM veiculo
        WHERE marca = ?
       SQL;

try {

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$marca]);

  $arrayModelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrayModelos);

} catch (Exception $e) {
  exit("Falha inesperada: " . $e->getMessage());
}
