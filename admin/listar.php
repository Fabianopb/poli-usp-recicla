<html>
<head>
	<title>Poli Recicla - Administra��o do Sistema de Gest�o de Res�duos Laboratoriais da Escola Polit�cnica da USP</title>
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
		<br><a href="cadastrar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Cadastrar usu�rio</a><br><br>
		<a href="buscar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Buscar usu�rio</a><br><br>
		<a href="listar.php">-&nbsp;&nbsp;&nbsp;&nbsp;Listar usu�rios</a><br><br>
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
		<br><b>Usu�rios cadastrados</b><br><br>
		<?php

			$sql = mysql_query("SELECT * FROM usuarios ORDER BY nome");

			echo '<table class="produto" border="1" cellspacing="0" cellpadding="2" width="600"><tr><th>Nome</th><th>N�USP</th><th>Fun��o</th><th>Departamento</th><th>Laborat�rio</th><th>e-mail</th><th>Ramal</th></tr>';
			
			while($linha = mysql_fetch_array($sql)) {
				echo "<tr><td>".$linha['nome']."</td><td>".$linha['numero']."</td><td>".$linha['funcao']."</td><td>".$linha['departamento']."</td><td>".$linha['laboratorio']."</td><td>".$linha['email']."</td><td>".$linha['ramal']."</td></tr>";
			}
		?>			
	</td>
</tr>

<table>

</div>
</body>
</html>
		
