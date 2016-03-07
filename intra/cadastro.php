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
	
	<td colspan="2" align="center" valign="top">
	<br>Se desejar alterar algum dado, substitua-o no campo correspondente pelo dado novo<br>e por questões de segurança digite sua senha antes de pressionar "Alterar dados"<br><font color="red">Atenção:</font> toda alteração será automaticamente reportada ao administrador.<br><br>
	<?php

	$nome = $_SESSION['usuarioNome'];

	if(isset($_POST['alterado'])) {
		$senha = md5($_POST['usuarioSenha']);
		$sql = mysql_query("SELECT * FROM usuarios WHERE senha = '$senha'");
		$res = mysql_fetch_array($sql);
		if($senha == $res['senha']) {			
			$funcao = $_POST['funcaoAlt'];
			$departamento = $_POST['departamentoAlt'];
			$laboratorio = $_POST['laboratorioAlt'];
			$email = $_POST['emailAlt'];
			$ramal = $_POST['ramalAlt'];

            if($funcao != $res['funcao']) {
				$sql = mysql_query("UPDATE usuarios SET funcao = '$funcao' WHERE nome = '$nome' LIMIT 1");
				echo '<font color="red">Função alterada com sucesso!<br></font>';
				$aux = $res['funcao'];
				$mensagem = "O usuario $nome alterou sua função de $aux para $funcao.";
				$sql = mysql_query("INSERT INTO avisos VALUES(NULL, '0', '$mensagem')");
				$sql = mysql_query("UPDATE residuos SET funcao = '$funcao' WHERE usuario = '$nome'");
			}
			
			if($departamento != $res['departamento']) {
				$sql = mysql_query("UPDATE usuarios SET departamento = '$departamento' WHERE nome = '$nome' LIMIT 1");
				echo '<font color="red">Departamento alterado com sucesso!<br></font>';
                $aux = $res['departamento'];
				$mensagem = "O usuario $nome alterou seu departamento de $aux para $departamento.";
				$sql = mysql_query("INSERT INTO avisos VALUES(NULL, '0', '$mensagem')");
				$sql = mysql_query("UPDATE residuos SET departamento = '$departamento' WHERE usuario = '$nome'");
			}
			
			if($laboratorio != $res['laboratorio']) {
				$sql = mysql_query("UPDATE usuarios SET laboratorio = '$laboratorio' WHERE nome = '$nome' LIMIT 1");
				echo '<font color="red">Laboratório alterado com sucesso!<br></font>';
				$aux = $res['laboratorio'];
				$mensagem = "O usuario $nome alterou seu laboratório de $aux para $laboratorio.";
				$sql = mysql_query("INSERT INTO avisos VALUES(NULL, '0', '$mensagem')");
				$sql = mysql_query("UPDATE residuos SET laboratorio = '$laboratorio' WHERE usuario = '$nome'");
            }
			
			if($email != $res['email']) {
				$sql = mysql_query("UPDATE usuarios SET email = '$email' WHERE nome = '$nome' LIMIT 1");
				echo '<font color="red">e-mail alterado com sucesso!<br></font>';
				$aux = $res['email'];
				$mensagem = "O usuario $nome alterou seu e-mail de $aux para $email.";
				$sql = mysql_query("INSERT INTO avisos VALUES(NULL, '0', '$mensagem')");
				$sql = mysql_query("UPDATE residuos SET email = '$email' WHERE usuario = '$nome'");
			}
			
			if($ramal != $res['ramal']) {
				$sql = mysql_query("UPDATE usuarios SET ramal = '$ramal' WHERE nome = '$nome' LIMIT 1");
				echo '<font color="red">Ramal alterado com sucesso!<br></font>';
				$aux = $res['ramal'];
				$mensagem = "O usuario $nome alterou seu ramal de $aux para $ramal.";
				$sql = mysql_query("INSERT INTO avisos VALUES(NULL, '0', '$mensagem')");
				$sql = mysql_query("UPDATE residuos SET ramal = '$ramal' WHERE usuario = '$nome'");
			}			
		}
		else { echo '<font color="red">Senha incorreta!</font><br>'; }
	}

	$sql = mysql_query("SELECT * FROM usuarios WHERE nome = '$nome' LIMIT 1");
	$usuario = mysql_fetch_array($sql);

	$numero = $usuario['numero'];
	$funcao = $usuario['funcao'];
	$departamento = $usuario['departamento'];
	$laboratorio = $usuario['laboratorio'];
	$email = $usuario['email'];
	$ramal = $usuario['ramal'];

	echo '<table class="body" border="0"><form method="post" action="cadastro.php"><tr><td><b>Nome:</b></td><td>'.$nome.'</td></tr>';
	echo '<tr><td><b>NºUSP:</b></td><td>'.$numero.'</td></tr>';
	echo '<tr><td><b>Função:</b></td><td><input size="30" type="text" value="'.$funcao.'" name="funcaoAlt"></td></tr>';
	echo '<tr><td><b>Departamento:</b></td><td><input size="30" type="text" value="'.$departamento.'" name="departamentoAlt"></td></tr>';
	echo '<tr><td><b>Laboratório:</b></td><td><input size="30" type="text" value="'.$laboratorio.'" name="laboratorioAlt"></td></tr>';
	echo '<tr><td><b>e-mail:</b></td><td><input size="30" type="text" value="'.$email.'" name="emailAlt"></td></tr>';
	echo '<tr><td><b>Ramal:</b></td><td><input size="30" type="text" value="'.$ramal.'" name="ramalAlt"></td></tr>';
	echo '<tr><td><b>Confirmar senha:</b></td><td><input size="30" type="password" name="usuarioSenha"></td></tr></table><br>';
	echo '<input type="hidden" value="1" name="alterado"><input type="submit" value="Alterar dados"></form>';

	?>
	</td>
</tr>

<table>

</div>
</body>
</html>
