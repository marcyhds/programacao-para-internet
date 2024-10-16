<?php

require "usuarios.php";

$login = $_POST["login"] ?? "";
$senha = $_POST["senha"] ?? "";

$novoUsuario = new Usuario($login, password_hash(($senha), PASSWORD_DEFAULT));
$novoUsuario->SalvaEmArquivo();

header("location: listaUsuarios.php");

?>