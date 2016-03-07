<html>
<head>
	<title>Poli Recicla - Administração do Sistema de Gestão de Resíduos Laboratoriais da Escola Politécnica da USP</title>
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
		