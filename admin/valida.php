<html>
<head>
	<title>Poli Recicla - Administra��o do Sistema de Gest�o de Res�duos Laboratoriais da Escola Polit�cnica da USP</title>
</head>
<body>
<?php
include "seguranca.php";
$nome = $_POST['adminNome'];
$senha = md5($_POST['adminSenha']);
if(ValidaAdmin($nome, $senha) == true) {
header("Location: inicio.php");
}
else {
$_SESSION['erro'] = true;
header("Location: index.php");
}
?>
</body>
</html>
		