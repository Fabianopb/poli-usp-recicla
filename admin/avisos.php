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
	<td width="120" rowspan="2" valign="top">		
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
	<td valign="top" colspan="2">
	<div align="center"><br><b>Centro de avisos</b></div><br>
	<a href="avisos.php?novas=true">&bull;&nbsp;Ver os avisos novos</a><br>
	<a href="avisos.php?antigas=true">&bull;&nbsp;Ver os avisos j� lidos</a><br><br>
	<?php
	if(isset($_GET['novas'])) {
		unset($_GET['novas']);
				
		$sql = mysql_query("SELECT * FROM avisos WHERE lido = '0' ORDER BY id");
		$total = mysql_num_rows($sql);
		if($total == 0) {
			echo '<div align="center">N�o h� mensagens novas</div>';
		}
		else {
			echo '<div align="center"><b>Avisos novos</b></div><br>';
			$i = 1;			

			while($linha = mysql_fetch_array($sql)) {
				echo "$i. ".$linha['mensagem']."<br><br>";			
				$i++;
			}
			$sql = mysql_query("UPDATE avisos SET lido = '1' WHERE lido = '0'");
			echo '<font color="red">Aten��o: ao sair desta p�gina, todas as mensagens listadas acima ser�o marcadas como lidas.</font>';	
		}
	}
	
	if(isset($_POST['apagar'])) {
        $sql = mysql_query("SELECT * FROM avisos WHERE lido = '1' ORDER BY id");
        $i = 0;
        while($linha = mysql_fetch_array($sql)) {
            $id = $linha['id'];
            if(isset($_POST[$id])) {
                $delete = mysql_query("DELETE FROM avisos WHERE id = '$id'");
                unset($_POST[$id]);
                $i++;
            }
        }
        if($i == 0) {
            echo '<div align="center"><font color="red">Nenhuma mensagem selecionada</font></div>';
            unset($_POST['apagar']);
        }
        else {
		    echo '<div align="center"><font color="red">Mensagens exclu�das com sucesso</font></div>';
		    unset($_POST['apagar']);
        }
    }
		
	if(isset($_GET['antigas'])) {
		unset($_GET['antigas']);		
		
		$sql = mysql_query("SELECT * FROM avisos WHERE lido = '1' ORDER BY id");
		$total = mysql_num_rows($sql);
		if($total == 0) {
			echo '<div align="center">N�o h� mensagens</div>';
		}
		else {
			echo '<div align="center"><b>Avisos j� lidos</b></div><br>';
			echo '<form method="post" action="avisos.php">';
			while($linha = mysql_fetch_array($sql)) {
                echo '<input type="checkbox" name="'.$linha['id'].'" value="'.$linha['id'].'">';
				echo " ".$linha['mensagem']."<br><br>";
			}
			echo '<div align="center"><input type="hidden" name="apagar"><input type="submit" value="Apagar selecionadas"></div></form>';
		}
	}		
	
	?>	
	</td>
</tr>

<table>

</div>
</body>
</html>
