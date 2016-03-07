<html>
<head>
	<title>Poli Recicla - Administração do Sistema de Gestão de Resíduos Laboratoriais da Escola Politécnica da USP</title>
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
		<br><a href="cadastrar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Cadastrar usuário</a><br><br>
		<a href="buscar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Buscar usuário</a><br><br>
		<a href="listar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Listar usuários</a><br><br>
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
		<?php

		$nome = $_POST['adminNome'];
		$antiga = md5($_POST['adminSenhaAntiga']);
		$nova1 = md5($_POST['adminSenhaNova1']);
		$nova2 = md5($_POST['adminSenhaNova2']);
		
		$sql = mysql_query("SELECT nome FROM administradores WHERE nome = '$nome' AND senha = '$antiga' LIMIT 1");
		$resultado = mysql_fetch_assoc($sql);		
		if(empty($resultado)) {
			$_SESSION['erro1'] = true;
			header("Location: altsenha.php");
			exit();
		}
		else {
			if($nova1 != $nova2) {
				$_SESSION['erro2'] = true;
				header("Location: altsenha.php");
				exit();
			}
			else {
				$sql = mysql_query("UPDATE administradores SET senha = '$nova1' WHERE nome = '$nome' AND senha = '$antiga' LIMIT 1");
				echo "Senha alterada com sucesso.";
			}
		}
		?>	
	</td>
</tr>

<table>

</div>
</body>
</html>
