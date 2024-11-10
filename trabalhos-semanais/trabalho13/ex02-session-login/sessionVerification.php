<?php

function exitWhenNotLoggedIn()
{ 
  // verifica se usuario esta logado
  if (!isset($_SESSION['loggedIn'])) {
    // redireciona para pagina de login
    header("Location: index.html");
    // encerra o script
    exit();  
  }
}
