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
		
			$nome = $_POST['residuoNome'];
			$composicao = $_POST['residuoComposicao'];
			$estado = $_POST['residuoEstado'];
			$quantidade = str_replace(",", ".", $_POST['residuoQuantidade']);
			$unidade = $_POST['residuoUnidade'];
			$dia = $_POST['residuoDia'];
			$mes = $_POST['residuoMes'];
			$ano = $_POST['residuoAno'];
			$obs = $_POST['residuoObs'];
			$data = date('Y-m-d');

			if(empty($nome) || empty($quantidade)) {
				$_SESSION['branco'] = true;
				header("Location: incluir.php");
				exit();
			}

			$usuario = $_SESSION['usuarioNome'];
			
			$sql = mysql_query("SELECT * FROM usuarios WHERE nome = '$usuario' LIMIT 1");
			$ident = mysql_fetch_array($sql);

			$funcao = $ident['funcao'];
			$departamento = $ident['departamento'];
			$laboratorio = $ident['laboratorio'];
			$email = $ident['email'];
			$ramal = $ident['ramal'];
					
			$sql = mysql_query("INSERT INTO residuos VALUES(NULL, '$nome', '$composicao', '$estado', '$quantidade', '$unidade', '$dia', '$mes', '$ano', '$obs', '$data', '$usuario', '$funcao', '$departamento', '$laboratorio', '$email', '$ramal')");
			if(!$sql) {
				die("Falha ao executar o comando: " . mysql_error());
			}
			else {
				echo "Produto inserido com sucesso!";
				$mensagem = "Você cadastrou $quantidade $unidade de $nome.";
				$sqlhistoricos = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$laboratorio', '$data')");
			}			
		
		?>
	</td>
</tr>

<table>

</div>
</body>
</html>
