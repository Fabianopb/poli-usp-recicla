<html>
<head>
	<title>Poli Recicla - Administra��o do Sistema de Gest�o de Res�duos Laboratoriais da Escola Polit�cnica da USP</title>
	<link rel=stylesheet href="estilo.css" type="text/css">
</head>
<body>
<div align="center">
<?php
include "seguranca.php";
Protecao();
?>
<table class="body" width="800" border="0" cellspacing="0" cellpadding="0">

<tr>
	<th colspan="3"><img src="imagens/header.jpg"></th>
</tr>

<tr>
    <td bgcolor="#efd2aa" align="center" width="130">
    <b>MENU</b>
	</td>
    <td width="620">
		<?php Identifica(); ?>
	</td>
	<td width="50">
	<a href="logout.php">Sair</a>&nbsp;&nbsp;<img src="imagens/sair.jpg">
	</td>
</tr>

<tr>
	<td rowspan="2" valign="top">		
		<br><a href="cadastrar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Cadastrar usu�rio</a><br><br>
		<a href="buscar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Buscar usu�rio</a><br><br>
		<a href="listar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Listar usu�rios</a><br><br>
		<a href="altsenha.php">-&nbsp;&nbsp;&nbsp;&nbsp;Alterar senha</a><br><br>
		<a href="avisos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Avisos</a><?php
           $sql = mysql_query("SELECT id FROM avisos WHERE lido = '0'");
           $novas = mysql_num_rows($sql);
           if($novas != 0) {
               echo '<img src="imagens/exclamacao.jpg">';
           }
        ?><br><br>
	</td>
	<td align="center" colspan="2">
		<br><b>Alterar minha senha</b><br>
		<font color="red">
		<?php
		if(isset($_SESSION['erro1'])) {
			unset($_SESSION['erro1']);
			echo "Usu�rio e/ou senha inv�lidos.";
		}
		if(isset($_SESSION['erro2'])) {
			unset($_SESSION['erro2']);
			echo 'Os campos "Senha nova" e "Confirmar nova senha" devem ser iguais.';
		}
		?>
		</font>
		<br>
		<table class="body" border="0"><tr><td align="right">
			<form method="post" action="alterado.php">
				Nome de usu�rio: <input type="text" name="adminNome" size="30"><br>
				Senha antiga: <input type="password" name="adminSenhaAntiga" size="30"><br>
				Senha nova: <input type="password" name="adminSenhaNova1" size="30"><br>
				Confirmar nova senha: <input type="password" name="adminSenhaNova2" size="30"><br><br>				
		</td></tr></table>				
				<input type="submit" value="Alterar">
			</form>		
	</td>
</tr>

<table>

</div>
</body>
</html>
