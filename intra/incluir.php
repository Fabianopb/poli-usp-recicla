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
		<br><b>Incluir resíduo químico</b><br>
		<font color="red">
		<?php
		if(isset($_SESSION['branco'])) {
			unset($_SESSION['branco']);
			echo "Você esqueceu de preencher algum campo obrigatório.";
		}
		?>
		</font>
		<br>
			<form method="post" action="incluido.php">
				* Nome do resíduo: <input type="text" size="30" name="residuoNome"><br><br>
				Composição: <input type="text" size="30" name="residuoComposicao"> * Estado físico: <select name="residuoEstado">
				<option selected>Líquido
				<option>Sólido
				<option>Gasoso
				<option>Pastoso
				</select><br><br>
				* Quantidade (separar decimal por ponto "."): <input type="text" size="30" name="residuoQuantidade"> * Unidade: <select name="residuoUnidade">
				<option selected>L (litros)
				<option>mL (mililitros)
				<option>kg (quilogramas)
				<option>g (gramas)
				<option>mg (miligramas)
				</select><br><br>
				Validade (dd/mm/aaaa): <input type="text" size="2" maxlength="2" name="residuoDia">/<input type="text" size="2" maxlength="2" name="residuoMes">/<input type="text" size="4" maxlength="4" name="residuoAno"><br><br>
				Observações: <input type="text" size="70" name="residuoObs"><br><br>
				<input type="submit" value="cadastrar">
			</form>
			* Campos obrigatórios.		
	</td>
</tr>

<table>

</div>
</body>
</html>
