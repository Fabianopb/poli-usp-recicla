<?php

function gerarSenha ($tamanho, $letras, $numeros)
{
$letr = "abcdefghijklmnopqrstuwxyz";
$numer = "0123456789";

$base = '';
$base .= ($letras) ? $letr : '';
$base .= ($numeros) ? $numer : '';

srand((float) microtime() * 10000000);
$senha = '';
for ($i = 0; $i < $tamanho; $i++) {
$senha .= substr($base, rand(0, strlen($base)-1), 1);
}
return $senha;
}

?>

		