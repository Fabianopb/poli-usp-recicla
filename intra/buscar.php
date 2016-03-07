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
		<br><b>Pesquisa de produtos químicos</b><br>
		<font color="red">
		<?php
		if(isset($_SESSION['vazio'])) {
			unset($_SESSION['vazio']);
			echo "Digite algo no campo de busca!";
		}
		?>
		</font>
		<br>
			<form method="post" action="buscado.php">
				Pesquisar: <input type="text" size="50" name="palavraChave"><br><br>
				Procura no departamento: <select name="localBusca">
				<option selected>Todos
				<option>PHD				
				<option>PCC
				<option>PEF
				<option>PTR
				<option>PQI
				<option>PME
				<option>PMI
				<option>PMT
				<option>PCS
				<option>PEA
				<option>PMR
				<option>PNV
				<option>PRO
				<option>PSI
				<option>PTC
				</select>
				<input class="form" type="submit" value="Pesquisar">
			</form>		
	</td>
</tr>

<table>

</div>
</body>
</html>
