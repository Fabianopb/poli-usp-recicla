<html>
<head>
	<title>Poli Recicla - Sistema de Gestão de Resíduos Laboratoriais da Escola Politécnica da USP</title>
	<link rel=stylesheet href="estilo.css" type="text/css">
</head>
<body>
<div align="center">

<table class="body" width="800" border="0" cellspacing="0" cellpadding="0">

<tr>
	<th colspan="2"><img src="intra/imagens/header.jpg"></th>
</tr>

<tr>
    <td bgcolor="#ccff9a" align="center" width="130">
    <b>MENU</b>
	</td>
    <td width="670"></td></tr>
<tr>
    <td valign="top">
    <br><a href="login.php">-&nbsp;&nbsp;&nbsp;&nbsp;Entrar</a><br><br>
	<a href="info.php">-&nbsp;&nbsp;&nbsp;&nbsp;Informações</a><br><br>
	<a href="contato.php">-&nbsp;&nbsp;&nbsp;&nbsp;Contato</a>
	</td>
	
	<td align="center">
		<b>Login</b><br>
		<font color="red"><?php
		session_start();
		if(isset($_SESSION['erro'])) {
			echo "Login e/ou senha inválidos";
			unset($_SESSION['erro']);
			session_destroy();
		}
		?></font>
		<br>
		<table border="0"><tr><td align="right">
			<form class="body" method="post" action="valida.php">
				NºUSP: <input type="text" size="20" name="usuarioNumero"><br>
				Senha: <input type="password" size="20" name="usuarioSenha"><br>
		</td></tr></table>		
		<input class="form" type="submit" value="Entrar"><br><br>
		</form>
		<a href="esqueci.php">Esqueci minha senha</a>
	</td>
</tr>

<table>

</div>
</body>
</html>
