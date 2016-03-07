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
		
		$busca = str_replace(" ", "%", $_POST['palavraChave']);
		$local = $_POST['localBusca'];
		$nome = $_SESSION['usuarioNome'];
		$sql = mysql_query("SELECT laboratorio FROM usuarios WHERE nome = '$nome'");
		$resultado = mysql_fetch_array($sql);
		$meulab = $resultado['laboratorio'];
		
		if(empty($busca)) {
			$_SESSION['vazio'] = true;
			header("Location: buscar.php");
			exit();
		}		
		if($local == 'Todos') {
			$sql = mysql_query("SELECT * FROM residuos WHERE (laboratorio != '$meulab' AND quantidade != '0') AND (nome LIKE '%$busca%' OR composicao LIKE '%$busca%') ORDER BY nome");
		}
		else {
			$sql = mysql_query("SELECT * FROM residuos WHERE departamento = '$local' AND nome LIKE '%$busca%' OR composicao LIKE '%$busca%' ORDER BY nome");
		}				
		$total = mysql_num_rows($sql);
		if ($total == 0) { echo "Sua busca não retornou resultados."; exit();}
		if ($total == 1) { echo "Sua busca retornou 1 resultado"; echo '<br><br>'; }
		if ($total > 1) { echo "Sua busca retornou $total resultados."; echo '<br><br>'; }

		$i = 1;		

		while($linha = mysql_fetch_array($sql)) {
			$data = explode("-", $linha['data']);
            echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td valign="top"><a href="favoritos.php?residuo='.$linha['nome'].'&laboratorio='.$linha['laboratorio'].'" title="Adicionar a meus favoritos"><img src="imagens/favorito.jpg" border="0"></a><br><a href="processos.php?residuobus='.$linha['nome'].'&laboratorio='.$linha['laboratorio'].'" title="Solicitar produto"><img src="imagens/solicitar.jpg" border="0"></a></td>';
			echo '<td><table class="produto" border="1" cellspacing="0" cellpadding="3" width="600"><tr><td width="10" rowspan="6"><b>'.$i.'</b></td><td><b>Substância: </b>'.$linha['nome'].'</td><td colspan="2"><b>Quantidade: </b>'.$linha['quantidade']." ".$linha['unidade']." em estado ".$linha['estado']."</td></tr>";
			echo '<tr><td><b>Composição: </b>'.$linha['composicao'].'</td><td><b>Cadastrado em: </b>'.$data[2].'/'.$data[1].'/'.$data[0].'</td><td><b>Válido até: </b>'.$linha['dia'].'/'.$linha['mes'].'/'.$linha['ano'].'</td></tr>';
			echo '<tr><td colspan="3"><b>Localização: </b>'.$linha['laboratorio']." no departamento do ".$linha['departamento']."</td></tr>";
			echo '<tr><td colspan="3"><b>Responsável: </b>'.$linha['funcao']." ".$linha['usuario']."</td></tr>";
            echo '<tr><td colspan="3"><b>obs.: </b>'.$linha['obs'].'</td></tr>';
            echo '<tr><td colspan="3">Contato no ramal '.$linha['ramal']." ou no e-mail ".$linha['email']."</td></tr></table></td></tr><br>";
			echo '</table>';
			$i++;
		}

		?>		
	</td>
</tr>

<table>

</div>
</body>
</html>
