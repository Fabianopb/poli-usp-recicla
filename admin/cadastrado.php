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
		include "autosenha.php";
		
		$nome = $_POST['usuarioNome'];
		$numero = $_POST['usuarioNumero'];
		$funcao = $_POST['usuarioFuncao'];
		$departamento = $_POST['usuarioDep'];
		$laboratorio = $_POST['usuarioLab'];
		$email = $_POST['usuarioMail'];
		$ramal = $_POST['usuarioRamal'];
		$senha = gerarSenha(8, true, true);
		$codif = md5($senha);
		
		if(empty($nome) || empty($numero) || empty($funcao) || empty($departamento) || empty($laboratorio) || empty($email) || empty($ramal)) {
			$_SESSION['branco'] = true;
			header("Location: cadastrar.php");
			exit();
		}

		$sqla = mysql_query("SELECT numero FROM usuarios WHERE numero = '$numero' LIMIT 1");
		$res = mysql_fetch_assoc($sqla);

		if($res['numero'] == $numero) {
			$_SESSION['repetido'] = true;
			header("Location: cadastrar.php");
		}
		else {
			$sqlb = mysql_query("INSERT INTO usuarios VALUES(NULL,'$nome','$numero','$funcao','$departamento','$laboratorio','$email','$ramal','$codif')");
			if(!$sqlb) {
				die("Falha ao executar o comando: " . mysql_error());
			}
			else {
				echo "Usuário cadastrado com sucesso. Senha gerada: $senha";
			}
		}
		?>
		
	</td>
</tr>

<table>

</div>
</body>
</html>
