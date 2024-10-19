<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();
$modelo = $_GET['modelo'] ?? '';

$sql = <<<SQL
        SELECT *
        FROM veiculo
        WHERE modelo = ?
       SQL;

try {

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$modelo]);

  $arrayVeiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arrayVeiculos);

} catch (Exception $e) {
  exit("Falha inesperada: " . $e->getMessage());
}

