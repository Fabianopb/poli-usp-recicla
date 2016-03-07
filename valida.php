<?php
include "seguranca.php";

$numero = $_POST['usuarioNumero'];
$senha = md5($_POST['usuarioSenha']);

if(ValidaUsuario($numero, $senha) == true) {
header("Location: intra/index.php");
}
else {
$_SESSION['erro'] = true;
header("Location: login.php");
}
?>
		