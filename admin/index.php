<html>
<head>
	<title>Poli Recicla - Administra��o do Sistema de Gest�o de Res�duos Laboratoriais da Escola Polit�cnica da USP</title>
	<link rel=stylesheet href="estilo.css" type="text/css">
</head>
<body>
<div align="center">

<table class="body" border="0" cellspacing="0" cellpadding="0" width="800">

<tr>
	<th><img src="imagens/header.jpg"></th>
</tr>

<tr>
	<td align="center">
		<br><b>Login</b><br>
		<font color="red"><?php
			session_start();
			if(isset($_SESSION['erro'])) {
			echo "Login e/ou senha inv�lidos";
			session_unset($_SESSION['erro']);
			session_destroy();
			}			
		?></font>
		<br>
		<table class="body" border="0"><tr><td align="right">
			<form method="post" action="valida.php">
				Administrador: <input type="text" name="adminNome"><br>
				Senha: <input type="password" name="adminSenha"><br>			
		</td></tr></table>
		<input type="submit" value="Entrar">
		</form>
	</td>
</tr>

<table>

</div>
</body>
</html>
		
