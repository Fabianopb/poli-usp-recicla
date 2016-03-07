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
        <br><b>Meus favoritos</b><br><br>
        <?php
             $usuario = $_SESSION['usuarioNome'];
             $meulab = $_SESSION['usuarioLab'];
             $datah = date('Y-m-d');
             
             if(isset($_GET['residuoex'])) {
                 $residuo = $_GET['residuoex'];
                 $id = $_GET['id'];
                 $sql = mysql_query("DELETE FROM favoritos WHERE id = '$id' AND nome = '$residuo' AND usuario = '$usuario' LIMIT 1");
                 $mensagem = "$residuo excluído dos meus favoritos.";
                 $sqlhistoricos = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$meulab', '$datah')");
                 echo '<font color="red">'.$residuo.' retirado dos favoritos</font><br>';
             }
             if(isset($_GET['residuo'])) {
                 $residuo = $_GET['residuo'];
                 $laboratorio = $_GET['laboratorio'];
                 $sql = mysql_query("SELECT id FROM residuos WHERE nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                 $linha = mysql_fetch_assoc($sql);
                 $id = $linha['id'];
                 
                 $sql = mysql_query("SELECT id FROM favoritos WHERE nome = '$residuo' AND usuario = '$usuario' LIMIT 1");
                 $linha = mysql_fetch_assoc($sql);

                 if(!empty($linha)) {
                     echo '<font color="red">Este resíduo já está cadastrado como favorito</font><br>';
                 }

                 else {
                     $sql = mysql_query("INSERT INTO favoritos VALUES('$id', '$residuo', '$usuario')");
                     $mensagem = "$residuo adicionado aos meus favoritos.";
                     $sqlhistoricos = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$meulab', '$datah')");
                     echo '<font color="red">'.$residuo.' adicionado aos favoritos</font><br><br>';
                 }
             }

             $sql = mysql_query("SELECT id,nome FROM favoritos WHERE usuario = '$usuario' ORDER BY id");
             $total = mysql_num_rows($sql);

             if ($total == 0) { echo "Você não tem favoritos cadastrados."; exit();}
		     if ($total == 1) { echo "Você possui 1 favorito"; echo '<br>'; }
	         if ($total > 1) { echo "Você possui $total favoritos."; echo '<br>'; }
	         
	         $i = 1;
             
             while($favorito = mysql_fetch_array($sql)) {
                 $id = $favorito['id'];
                 $residuo = $favorito['nome'];
                 $sql2 = mysql_query("SELECT * FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
                 $linha = mysql_fetch_array($sql2);
                 $data = explode("-", $linha['data']);
                 echo '<br><table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                  <td valign="top"><a href="favoritos.php?residuoex='.$linha['nome'].'&id='.$id.'" title="Excluir dos favoritos"><img src="imagens/excluir.jpg" border="0"></a><br><a href="processos.php?residuofav='.$linha['nome'].'&laboratorio='.$linha['laboratorio'].'" title="Solicitar produto"><img src="imagens/solicitar.jpg" border="0"></a>
                                  </td>
                                  <td>';
			     echo '<td rowspan="2"><table class="produto" border="1" cellspacing="0" cellpadding="3" width="600"><tr><td rowspan="6" width="10"><b>'.$i.'</b></td><td><b>Substância: </b>'.$linha['nome'].'</td><td colspan="2"><b>Quantidade: </b>'.$linha['quantidade']." ".$linha['unidade']." em estado ".$linha['estado']."</td></tr>";
			     echo "<tr><td><b>Composição: </b>".$linha['composicao']."</td><td><b>Cadastrado em: </b>".$data[2]."/".$data[1]."/".$data[0]."</td><td><b>Válido até: </b>".$linha['dia']."/".$linha['mes']."/".$linha['ano']."</td></tr>";
			     echo '<tr><td colspan="3"><b>Localização: </b>'.$linha['laboratorio']." no departamento do ".$linha['departamento']."</td></tr>";
			     echo '<tr><td colspan="3"><b>Responsável: </b>'.$linha['funcao']." ".$linha['usuario']."</td></tr>";
                 echo '<tr><td colspan="3"><b>obs.: </b>'.$linha['obs'].'</td></tr>';
                 echo '<tr><td colspan="3">Contato no ramal '.$linha['ramal'].' ou no e-mail '.$linha['email'].'</td></tr></table>
                                  </td>
                             </tr>
                       </table>';
			     $i++;
             }
        ?>
	</td>
</tr>

<table>

</div>
</body>
</html>
