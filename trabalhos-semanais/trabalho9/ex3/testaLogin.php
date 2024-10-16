<?php
require "usuarios.php";

$login = $_POST["login"] ?? "";
$senha = $_POST["senha"] ?? "";

$testeUsuario = new Usuario($login, $senha);

$usuarioExiste = false;

$arrayUsuarios = carregaUsuariosDeArquivo();
foreach ($arrayUsuarios as $usuario) {
  if (strcmp($testeUsuario->login, $usuario->login) == 0 && (password_verify($testeUsuario->senha, $usuario->senha))) {
    $usuarioExiste = true;
    break;
  }
}

if ($usuarioExiste == true) {
  header("location: sucessoLogin.html");
} else {
  header("location: index.html");
}
?>