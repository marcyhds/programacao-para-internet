<?php

$cep = $_GET['cep'] ?? '';

// retorna as cidades em formato de texto se valor de cep corresponde a alguma das opções e retorna erro caso o contrario
if ($cep == '38400-100')
  echo 'Uberlândia';
else if ($cep == '38700-000')
  echo 'Patos de Minas';
else {
  http_response_code(404);
  echo "$cep is not available";
}