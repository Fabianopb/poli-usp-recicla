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
			
		$busca = str_replace(" ", "%", $_POST['busca']);
		$opcao = $_POST['opcao'];
		
		if(empty($busca)) {
			$_SESSION['vazio'] = true;
			header("Location: buscar.php");
			exit();
		}		

		if($opcao == 'Tudo') {
			$sql = mysql_query("SELECT * FROM usuarios WHERE nome LIKE '%$busca%' OR numero LIKE '%$busca%' OR departamento LIKE '%$busca%' OR laboratorio LIKE '%$busca%' OR email LIKE '%$busca%' ORDER BY nome");
		}
		else {
			if($opcao == 'Nome') {				
				$sql = mysql_query("SELECT * FROM usuarios WHERE nome LIKE '%$busca%' ORDER BY nome");
			}
			else {
				if($opcao == "NºUSP") {					
					$sql = mysql_query("SELECT * FROM usuarios WHERE numero LIKE '%$busca%' ORDER BY nome");
				}
				else {
					if($opcao == 'Departamento') {						
						$sql = mysql_query("SELECT * FROM usuarios WHERE departamento LIKE '%$busca%' ORDER BY nome");
					}
					else {
						if($opcao == 'Laboratório') {							
							$sql = mysql_query("SELECT * FROM usuarios WHERE laboratorio LIKE '%$busca%' ORDER BY nome");
						}
						else {
							if($opcao == 'e-mail') {								
								$sql = mysql_query("SELECT * FROM usuarios WHERE email LIKE '%$busca%' ORDER BY nome");
							}					
						}
					}
				}
			}			
		}
		$total = mysql_num_rows($sql);
		if ($total == 0) { echo "Sua busca não retornou resultados."; exit();}
		if ($total == 1) { echo "Sua busca retornou 1 resultado"; echo '<br><br>'; }
		if ($total > 1) { echo "Sua busca retornou $total resultados."; echo '<br><br>'; }
	
		echo '<table border="1"><tr><th>Nome</th><th>NºUSP</th><th>Função</th><th>Departamento</th><th>Laboratório</th><th>e-mail</th><th>Ramal</th></tr>';
	
		while($linha = mysql_fetch_array($sql)) {
			echo "<tr><td>".$linha['nome']."</td><td>".$linha['numero']."</td><td>".$linha['funcao']."</td><td>".$linha['departamento']."</td><td>".$linha['laboratorio']."</td><td>".$linha['email']."</td><td>".$linha['ramal']."</td></tr>";
		}
	
		echo '</table>';
				
		?>	
	</td>
</tr>

<table>

</div>
</body>
</html>
