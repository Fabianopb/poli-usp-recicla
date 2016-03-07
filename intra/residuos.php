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
	<br><b>Resíduos cadastrados por mim</b><br><br>
	<form method="post" action="residuos.php">
	Busca nos meus resíduos <input type="text" size="30" name="busca"> <input type="submit" value="Buscar">
	</form>
	<?php
	$usuario = $_SESSION['usuarioNome'];
	if(isset($_POST['busca'])) {
				
		$busca = str_replace(" ", "%", $_POST['busca']);

		$sql = mysql_query("SELECT * FROM residuos WHERE usuario = '$usuario' AND (nome LIKE '%$busca%' OR composicao LIKE '%$busca%') ORDER BY data DESC");
	
		$total = mysql_num_rows($sql);
		if ($total == 0) { echo "Não foram encontrados resultados."; exit();}
		if ($total == 1) { echo "Foi encontrado 1 resultado."; echo '<br><br>'; }
		if ($total > 1) { echo "Foram encontrados $total resultados."; echo '<br><br>'; }		
	
		$i = 1;	

		while($linha = mysql_fetch_array($sql)) {
			$data = explode("-", $linha['data']);
            echo '<table border="0" cellspacing="0" cellpadding="0">
                         <tr>
                             <td valign="top"><a href="residuos.php?id='.$linha['id'].'&residuo='.$linha['nome'].'" title="Excluir resíduo"><img src="imagens/excluir.jpg" border="0"></a>
                             </td>
                             <td>';
            echo '<table class="produto" cellspacing="0" cellpadding="3" border="1" width="600"><tr><td rowspan="4" width="10"><b>'.$i.'</b></td><td><b>Substância: </b>'.$linha['nome'].'</td><td><b>Quantidade: </b>'.$linha['quantidade'].' '.$linha['unidade'].' em estado '.$linha['estado'].'</td></tr>';
			echo '<tr><td colspan="2"><b>Composição: </b>'.$linha['composicao'].'</td></tr>';
			echo '<tr><td><b>Cadastrado em: </b>'.$data[2].'/'.$data[1].'/'.$data[0].'</td><td><b>Válido até: </b>'.$linha['dia'].'/'.$linha['mes'].'/'.$linha['ano'].'</td></tr>';
			echo '<tr><td colspan="2"><b>obs.: </b>'.$linha['obs'].'</td></tr></table><br>
                             </td>
                         </tr>
                  </table>';
			$i++;
		}
	}
	else if(!isset($_GET['id'])) {
		$sql = mysql_query("SELECT * FROM residuos WHERE usuario = '$usuario' ORDER BY data DESC");
	
		$total = mysql_num_rows($sql);
		if ($total == 0) { echo "Você não possui resíduos cadastrados."; exit();}
		if ($total == 1) { echo "Você possui 1 resíduo cadastrado."; echo '<br><br>'; }
		if ($total > 1) { echo "Você possui $total resíduos cadastrados."; echo '<br><br>'; }		
	
		$i = 1;	

		while($linha = mysql_fetch_array($sql)) {
			$data = explode("-", $linha['data']);
			echo '<table border="0" cellspacing="0" cellpadding="0">
                         <tr>
                             <td valign="top"><a href="residuos.php?id='.$linha['id'].'&residuo='.$linha['nome'].'" border="0" title="Excluir resíduo"><img src="imagens/excluir.jpg" border="0"></a>
                             </td>
                             <td>';
			echo '<table class="produto" cellspacing="0" cellpadding="3" border="1" width="600"><tr><td rowspan="4" width="10"><b>'.$i.'</b></td><td><b>Substância: </b>'.$linha['nome'].'</td><td><b>Quantidade: </b>'.$linha['quantidade'].' '.$linha['unidade'].' em estado '.$linha['estado'].'</td></tr>';
			echo '<tr><td colspan="2"><b>Composição: </b>'.$linha['composicao'].'</td></tr>';
			echo '<tr><td><b>Cadastrado em: </b>'.$data[2].'/'.$data[1].'/'.$data[0].'</td><td><b>Válido até: </b>'.$linha['dia'].'/'.$linha['mes'].'/'.$linha['ano'].'</td></tr>';
			echo '<tr><td colspan="2"><b>obs.: </b>'.$linha['obs'].'</td></tr></table><br>
			                 </td>
                         </tr>
                  </table>';
		$i++;
		}
	}
	if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $residuo = $_GET['residuo'];
        $de = $_SESSION['usuarioLab'];

        $sql = mysql_query("SELECT * FROM processos WHERE residuo = '$residuo' AND id = '$id' AND de = '$de' LIMIT 1");
        $resultado = mysql_fetch_array($sql);
        if(!empty($resultado)) {
            echo '<font color="red">O '.$residuo.' está em processo de troca com o '.$resultado['para'].'.<br>Finalize o processo antes de apagá-lo</font>';
        }
        else {
            $sql = mysql_query("DELETE FROM residuos WHERE id = '$id' AND nome = '$residuo' AND usuario = '$usuario' LIMIT 1");
            echo '<font color="red">'.$residuo.' apagado com sucesso!</font>';
        }
    }
		
	?>
	</td>
</tr>

<table>

</div>
</body>
</html>
