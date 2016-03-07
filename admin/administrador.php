<html>
<head>
	<title>Cadastro de administradores</title>	
</head>
<body>
<div align="center">
<?php
include "../conecta.php";
if(isset($_POST['submit'])) {
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);	
	$sql = mysql_query("INSERT INTO administradores VALUES(NULL,'$nome','$email','$senha')");
	if(!$sql) {
		die("Falha ao executar o comando: " . mysql_error());
	}
	else {
		echo "Dados inseridos com sucesso.";
	}
}
?>
	<br>Cadastro de administrador<br>
	<form method="post" action="<?php $PHP_SELF ?>">
		Nome: <input type="text" name="nome"><br>
		e-mail: <input type="text" name="email"><br>
		senha: <input type="password" name="senha"><br>
		<input type="submit" name="submit" value="Cadastrar">
	</form>
</div>
</body>
</html>	
