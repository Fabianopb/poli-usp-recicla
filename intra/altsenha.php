<html>
<head>
	<title>Poli Recicla - Sistema de Gest�o de Res�duos Laboratoriais da Escola Polit�cnica da USP</title>
	<link rel=stylesheet href="../estilo.css" type="text/css">
</head>
<body>
<div align="center">
<?php
include "../seguranca.php";
Protecao();
?>
<table class="body" width="800" border="0" cellspacing="0" cellpadding="0">

<tr>
	<th colspan="3"><img src="imagens/header.jpg"></th>
</tr>

<tr>
    <td bgcolor="#ccff9a" align="center" width="130">
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
	<td valign="top">		
		<br><a href="buscar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Buscar produto</a><br><br>
		<a href="incluir.php">-&nbsp;&nbsp;&nbsp;&nbsp;Incluir produto</a><br><br>
		<a href="altsenha.php">-&nbsp;&nbsp;&nbsp;&nbsp;Alterar senha</a><br><br>
		<a href="cadastro.php">-&nbsp;&nbsp;&nbsp;&nbsp;Meu cadastro</a><br><br>
		<a href="residuos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Meus res�duos</a><br><br>
		<a href="favoritos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Favoritos</a><br><br>
        <a href="processos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Processos</a><br><br>
        <a href="historico.php">-&nbsp;&nbsp;&nbsp;&nbsp;Hist�rico</a><?php
                $lab = $_SESSION['usuarioLab'];
                $sql = mysql_query("SELECT id FROM historicos WHERE lab = '$lab' AND lido ='0'");
                $nova = mysql_fetch_array($sql);
                if(!empty($nova)) {
                    echo '<img src="imagens/exclamacao.jpg">';
                }
        ?><br><br>
	</td>
	
	<td colspan="2" align="center" valign="top">
		<br><b>Alterar senha</b><br>
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
					N�mero de usu�rio: <input type="text" name="usuarioNumero"><br>
					Senha antiga: <input type="password" name="usuarioSenha"><br>
					Senha nova: <input type="password" name="usuarioNova01"><br>
					Confirmar senha nova: <input type="password" name="usuarioNova02"><br><br>											
			</td></tr></table>
			<input type="submit" value="Alterar">
			</form>
	</td>
</tr>

<table>

</div>
</body>
</html>
