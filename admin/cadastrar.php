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
		<br><b>Cadastrar novo usu�rio</b><br>
		<font color="red">
		<?php
		if(isset($_SESSION['branco'])) {
			unset($_SESSION['branco']);
			echo "Todos os campos devem ser preenchidos!";
		}
		if(isset($_SESSION['repetido'])) {
			unset($_SESSION['repetido']);
			echo "Este usu�rio j� foi cadastrado!";
		}
		?>
		</font>
		<br>
		<table class="body" border="0"><tr><td align="right">
			<form method="post" action="cadastrado.php">
				Nome completo: <input type="text" name="usuarioNome" size="30"><br>
				N�USP: <input type="text" name="usuarioNumero" size="30"><br>
				Fun��o: <input type="text" name="usuarioFuncao" size="30"><br>
				Departamento: <input type="text" name="usuarioDep" size="30"><br>
				Laborat�rio: <input type="text" name="usuarioLab" size="30"><br>
				e-mail: <input type="text" name="usuarioMail" size="30"><br>
				ramal: <input type="text" name="usuarioRamal" size="30"><br><br>
		</td></tr></table>				
				<input type="submit" value="Cadastrar"><br><br>
			</form>
		<font color="red">Aten��o! Confira todos os dados antes de confirmar o cadastro.<br>Uma senha ser� gerada automaticamente e enviada para o e-mail cadastrado do usu�rio.</font>
	</td>
</tr>

<table>

</div>
</body>
</html>
