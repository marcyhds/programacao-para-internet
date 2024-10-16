<?php

class Usuario
{
  public $login;
  public $senha;

  function __construct($login, $senha)
  {
    $this->login = $login;
    $this->senha = $senha;
  }

  public function SalvaEmArquivo()
  {
    $arq = fopen("usuarios.txt", "a");

    fwrite($arq, "{$this->login};{$this->senha}\n");

    fclose($arq);
  }
}

function carregaUsuariosDeArquivo()
{
  $arrayUsuarios = [];

  $arq = fopen("usuarios.txt", "r");
  if (!$arq)
    return $arrayUsuarios;

  while (!feof($arq)) {
    $usuario = trim(fgets($arq));

    if ($usuario != "") {
      list($login, $senha) = array_pad(explode(';', $usuario), 2, null);

      $novoUsuario = new Usuario($login, $senha);
      $arrayUsuarios[] = $novoUsuario;
    }
  }

  fclose($arq);
  return $arrayUsuarios;
}

?>