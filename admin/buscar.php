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
		<br><b>Buscar usuário</b><br>
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
				Procurar: <input type="text" name="busca" size="30"><br><br>
				Procurar em: <select name="opcao">
					<option selected>Tudo
					<option>Nome
					<option>NºUSP
					<option>Departamento
					<option>Laboratório
					<option>e-mail
				</select><br><br>		
				<input type="submit" value="Procurar"><br><br>
			</form>		
	</td>
</tr>

<table>

</div>
</body>
</html>
