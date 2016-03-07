<html>
<head>
	<title>Poli Recicla - Sistema de Gestão de Resíduos Laboratoriais da Escola Politécnica da USP</title>
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
		<a href="residuos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Meus resíduos</a><br><br>
		<a href="favoritos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Favoritos</a><br><br>
        <a href="processos.php">-&nbsp;&nbsp;&nbsp;&nbsp;Processos</a><br><br>
        <a href="historico.php">-&nbsp;&nbsp;&nbsp;&nbsp;Histórico</a><?php
                $lab = $_SESSION['usuarioLab'];
                $sql = mysql_query("SELECT id FROM historicos WHERE lab = '$lab' AND lido ='0'");
                $nova = mysql_fetch_array($sql);
                if(!empty($nova)) {
                    echo '<img src="imagens/exclamacao.jpg">';
                }
        ?><br><br>
	</td>
	
	<td colspan="2" align="center">
		<?php
		
		$numero = $_POST['usuarioNumero'];
		$antiga = md5($_POST['usuarioSenha']);
		$nova01 = md5($_POST['usuarioNova01']);
		$nova02 = md5($_POST['usuarioNova02']);
		
		$sql = mysql_query("SELECT numero FROM usuarios WHERE numero = '$numero' AND senha = '$antiga' LIMIT 1");
		$resultado = mysql_fetch_assoc($sql);		
		if(empty($resultado)) {
			$_SESSION['erro1'] = true;
			header("Location: altsenha.php");
			exit();
		}
		else {
			if($nova01 != $nova02) {
				$_SESSION['erro2'] = true;
				header("Location: altsenha.php");
				exit();
			}
			else {
				$sql = mysql_query("UPDATE usuarios SET senha = '$nova01' WHERE numero = '$numero' AND senha = '$antiga' LIMIT 1");
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
