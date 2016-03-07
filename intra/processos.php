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
	<td colspan="2" valign="top">
        <div align="center"><br><b>Acompanhamento de processos</b></div><br>
        <?php
           echo '&bull;&nbsp;<a href="processos.php?mim=true">Solicitados por mim</a><br>';
           echo '&bull;&nbsp;<a href="processos.php?outros=true">Solicitados por outros laboratórios</a><br><br>';

           $usuario = $_SESSION['usuarioNome'];
           
           if(isset($_GET['residuofav'])) {
               $residuo = $_GET['residuofav'];
               $laboratorio = $_GET['laboratorio'];
               if(isset($_POST['quantidade'])) {
                   $quantsol = str_replace(",", ".", $_POST['quantidade']);
                   $sql = mysql_query("SELECT * FROM residuos WHERE nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                   $linha = mysql_fetch_array($sql);
                   if($quantsol > $linha['quantidade'] || $quantsol == 0) {
                       echo '<div align="center"><font color="red">Quantidade solicitada inválida.<br>Solicite outro valor</font></div><br>';
                       echo '<br><div align="center"><form method="post" action="processos.php?residuofav='.$residuo.'&laboratorio='.$laboratorio.'">Quantidade solicitada de '.$residuo.'<input type="text" size="10" name="quantidade">'.$linha['unidade'].' de '.$linha['quantidade'].' '.$linha['unidade'].'';
                       echo '<br><input type="submit" value="Solicitar"></form></div>';
                   }
                   else {
                       $id = $linha['id'];
                       $para = $_SESSION['usuarioLab'];
                       $data = date('Y-m-d');
                       $sql = mysql_query("INSERT INTO processos VALUES(NULL, '$id', '$residuo', '$laboratorio', '$para', '$quantsol','pedido' , '$data')");
                       if(!$sql) {
                           die("Falha ao executar o comando: " . mysql_error());
			           }
                       else {
				           echo '<div align="center">Solicitação efetuada com sucesso. Aguarde parecer do solicitado.</div>';
                           $sobra = $linha['quantidade'] - $quantsol;
                           $sqlres = mysql_query("UPDATE residuos SET quantidade = '$sobra' WHERE id = '$id' AND nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
				           $sqlfav = mysql_query("DELETE FROM favoritos WHERE id = '$id' AND nome = '$residuo' AND usuario = '$usuario' LIMIT 1");
				           $mensagem1 = "$quantsol ".$linha['unidade']." de $residuo solicitado ao laboratório $laboratorio.";
				           $mensagem2 = "$quantsol ".$linha['unidade']." de $residuo solicitado pelo laboratório $para.";
                           $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem1', '$para', '$data')");
                           $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem2', '$laboratorio', '$data')");
			           }
                   }
               }
               else {
                   $sql = mysql_query("SELECT * FROM residuos WHERE nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                   $linha = mysql_fetch_array($sql);
                   echo '<div align="center"><form method="post" action="processos.php?residuofav='.$residuo.'&laboratorio='.$laboratorio.'">Quantidade solicitada de '.$residuo.'<input type="text" size="10" name="quantidade">'.$linha['unidade'].' de '.$linha['quantidade'].' '.$linha['unidade'].'';
                   echo '<br><input type="submit" value="Solicitar"></form></div>';
               }
           }
           
           if(isset($_GET['residuobus'])) {
               $residuo = $_GET['residuobus'];
               $laboratorio = $_GET['laboratorio'];
               if(isset($_POST['quantidade'])) {
                   $quantsol = str_replace(",", ".", $_POST['quantidade']);
                   $sql = mysql_query("SELECT * FROM residuos WHERE nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                   $linha = mysql_fetch_array($sql);
                   if($quantsol > $linha['quantidade'] || $quantsol == 0) {
                       echo '<div align="center"><font color="red">Quantidade solicitada inválida.<br>Solicite outro valor</font></div><br>';
                       echo '<br><div align="center"><form method="post" action="processos.php?residuobus='.$residuo.'&laboratorio='.$laboratorio.'">Quantidade solicitada de '.$residuo.'<input type="text" size="10" name="quantidade">'.$linha['unidade'].' de '.$linha['quantidade'].' '.$linha['unidade'].'';
                       echo '<br><input type="submit" value="Solicitar"></form></div>';
                   }
                   else {
                       $id = $linha['id'];
                       $para = $_SESSION['usuarioLab'];
                       $data = date('Y-m-d');
                       $sql = mysql_query("INSERT INTO processos VALUES(NULL, '$id', '$residuo', '$laboratorio', '$para', '$quantsol','pedido' , '$data')");
                       if(!$sql) {
                           die("Falha ao executar o comando: " . mysql_error());
			           }
                       else {
				           echo '<div align="center">Solicitação efetuada com sucesso. Aguarde parecer do solicitado.</div>';
                           $sobra = $linha['quantidade'] - $quantsol;
                           $sqlres = mysql_query("UPDATE residuos SET quantidade = '$sobra' WHERE id = '$id' AND nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                           $mensagem1 = "$quantsol ".$linha['unidade']." de $residuo solicitado ao laboratório $laboratorio.";
                           $mensagem2 = "$quantsol ".$linha['unidade']." de $residuo solicitado pelo laboratório $para.";
                           $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem1', '$para', '$data')");
                           $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem2', '$laboratorio', '$data')");
			           }
                   }
               }
               else {
                   $sql = mysql_query("SELECT * FROM residuos WHERE nome = '$residuo' AND laboratorio = '$laboratorio' LIMIT 1");
                   $linha = mysql_fetch_array($sql);
                   echo '<div align="center"><form method="post" action="processos.php?residuobus='.$residuo.'&laboratorio='.$laboratorio.'">Quantidade solicitada de '.$residuo.'<input type="text" size="10" name="quantidade">'.$linha['unidade'].' de '.$linha['quantidade'].' '.$linha['unidade'].'';
                   echo '<br><input type="submit" value="Solicitar"></form></div>';
               }
           }
           
           if(isset($_GET['cancelar'])) {
               $residuo = $_GET['cancelar'];
               $newid = $_GET['newid'];
               $id = $_GET['id'];
               $quantidade = $_GET['quantidade'];

               $sql = mysql_query("SELECT * FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
               $linha = mysql_fetch_array($sql);
               $soma = $linha['quantidade'] + $quantidade;

               $sqlresiduo = mysql_query("UPDATE residuos SET quantidade = '$soma' WHERE id = '$id' AND nome = '$residuo' LIMIT 1");

               $sqlprocessos = mysql_query("DELETE FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");

               $de = $linha['laboratorio'];
               $para = $_SESSION['usuarioLab'];
               $data = date('Y-m-d');

               $mensagem1 = "A solicitação de $quantidade ".$linha['unidade']." de $residuo ao $de foi cancelada.";
               $mensagem2 = "A solicitação de $quantidade ".$linha['unidade']." de $residuo pelo $para foi cancelada.";

               $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem1', '$para', '$data')");
               $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem2', '$de', '$data')");
               echo '<div align="center">Solicitação de '.$residuo.' cancelada!</div>';
           }
           
           if(isset($_GET['mim'])) {
               echo '<div align="center">Solicitados por mim</div><br>';
               $para = $_SESSION['usuarioLab'];
               $sql = mysql_query("SELECT * FROM processos WHERE para = '$para' ORDER BY id");
               $total = mysql_num_rows($sql);
               if($total == 0) { echo '<div align="center">Não há nenhum processo em andamento</div>'; }
               $i = 1;
               while($processos = mysql_fetch_array($sql)) {
                   $id = $processos['id'];
                   $residuo = $processos['residuo'];
                   $dataproc = explode("-", $processos['dataproc']);
                   $sql2 = mysql_query("SELECT * FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
                   $linha = mysql_fetch_array($sql2);
                   $data = explode("-", $linha['data']);
			       echo '<div align="center">
                              <table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                  <td valign="top">'; if($processos['situacao'] == 'pedido') {
                                             echo '<a href="processos.php?cancelar='.$residuo.'&newid='.$processos['newid'].'&id='.$id.'&quantidade='.$processos['quantidade'].'" title="Cancelar solicitação"><img src="imagens/excluir.jpg" border="0"></a>';
                                         }
                                         if($processos['situacao'] == 'aceito'){
                                             echo '<a href="processos.php?recebido='.$residuo.'&newid='.$processos['newid'].'&id='.$id.'&quantidade='.$processos['quantidade'].'&unidade='.$linha['unidade'].'" title="Produto recebido"><img src="imagens/recebido.jpg" border="0"></a>';
                                         }
                                  echo '</td>
                              <td><table class="produto" border="1" cellspacing="0" cellpadding="3" width="600">
                                     <tr>
                                         <td rowspan="6" width="15"><b>'.$i.'</b></td>
                                         <td><b>Substância: </b>'.$linha['nome'].'</td>
                                         <td colspan="2"><b>Quantidade: </b>'.$processos['quantidade'].' '.$linha['unidade'].' em estado '.$linha['estado'].'</td>
                                     </tr>
			                         <tr>
                                         <td><b>Composição: </b>'.$linha['composicao'].'</td>
                                         <td><b>Cadastrado em: </b>'.$data[2].'/'.$data[1].'/'.$data[0].'</td>
                                         <td><b>Válido até: </b>'.$linha['dia'].'/'.$linha['mes'].'/'.$linha['ano'].'</td>
                                     </tr>
			                         <tr>
                                         <td colspan="3"><b>Localização: </b>'.$linha['laboratorio'].' no departamento do '.$linha['departamento'].'</td>
                                     </tr>
			                         <tr>
                                         <td colspan="3"><b>Responsável: </b>'.$linha['funcao'].' '.$linha['usuario'].'</td>
                                     </tr>
                                     <tr>
                                         <td colspan="3">Contato no ramal '.$linha['ramal'].' ou no e-mail '.$linha['email'].'</td>
                                     </tr>
			                         <tr>
                                         <td bgcolor="#FFC1C1" colspan="3"><b>Situação: </b>'.$processos['situacao'].' em '.$dataproc[2].'/'.$dataproc[1].'/'.$dataproc[0].' '; if($processos['situacao'] == 'aceito') { echo 'entre em contato para combinar o transporte'; } if($processos['situacao'] == 'recebido') { echo 'aguardando finalização do processo'; } echo '</td></tr>
                              </table></td>
                              </tr>
                              </table><br>';
			       $i++;
               }
           }
           
           if(isset($_GET['outros'])) {
               echo '<div align="center">Solicitados por outros laboratórios</div><br>';
               $de = $_SESSION['usuarioLab'];
               $sql = mysql_query("SELECT * FROM processos WHERE de = '$de' ORDER BY id");
               $total = mysql_num_rows($sql);
               if($total == 0) { echo '<div align="center">Não há nenhum processo em andamento</div>'; }
               $i = 1;
               while($processos = mysql_fetch_array($sql)) {
                   $id = $processos['id'];
                   $residuo = $processos['residuo'];
                   $dataproc = explode("-", $processos['dataproc']);
                   $sql2 = mysql_query("SELECT * FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
                   $linha = mysql_fetch_array($sql2);
                   $data = explode("-", $linha['data']);
                   $para = $processos['para'];
                   $sql3 = mysql_query("SELECT * FROM usuarios WHERE laboratorio = '$para' LIMIT 1");
                   $solicitante = mysql_fetch_array($sql3);
			       echo '<div align="center">
                              <table border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                  <td valign="top">'; if($processos['situacao'] == 'pedido') {
                                                           echo '<a href="processos.php?aceitar='.$residuo.'&newid='.$processos['newid'].'&id='.$id.'&quantidade='.$processos['quantidade'].'&unidade='.$linha['unidade'].'" title="Aceitar solicitação"><img src="imagens/aceitar.jpg" border="0"></a><br><a href="processos.php?recusar='.$residuo.'&newid='.$processos['newid'].'&id='.$id.'&quantidade='.$processos['quantidade'].'&unidade='.$linha['unidade'].'" title="Recusar solicitação"><img src="imagens/excluir.jpg" border="0"></a>';
                                                       }
                                                       if($processos['situacao'] == 'recebido') {
                                                           echo '<a href="processos.php?finalizar='.$residuo.'&newid='.$processos['newid'].'&id='.$id.'&quantidade='.$processos['quantidade'].'&unidade='.$linha['unidade'].'" title="Entrega confirmada"><img src="imagens/finalizar.jpg" border="0"></a>';
                                                       }
                                                       echo '</td>
                              <td><table class="produto" border="1" cellspacing="0" cellpadding="3" width="600">
                                     <tr>
                                         <td rowspan="6" width="15"><b>'.$i.'</b></td>
                                         <td><b>Substância: </b>'.$linha['nome'].'</td>
                                         <td colspan="2"><b>Quantidade: </b>'.$processos['quantidade'].' '.$linha['unidade'].' em estado '.$linha['estado'].'</td>
                                     </tr>
			                         <tr>
                                         <td><b>Composição: </b>'.$linha['composicao'].'</td>
                                         <td><b>Cadastrado em: </b>'.$data[2].'/'.$data[1].'/'.$data[0].'</td>
                                         <td><b>Válido até: </b>'.$linha['dia'].'/'.$linha['mes'].'/'.$linha['ano'].'</td>
                                     </tr>
			                         <tr>
                                         <td colspan="3"><b>Para: </b>'.$solicitante['laboratorio'].' no departamento do '.$solicitante['departamento'].'</td>
                                     </tr>
			                         <tr>
                                         <td colspan="3"><b>Solicitante: </b>'.$solicitante['funcao'].' '.$solicitante['nome'].'</td>
                                     </tr>
                                     <tr>
                                         <td colspan="3">Contato no ramal '.$solicitante['ramal'].' ou no e-mail '.$solicitante['email'].'</td>
                                     </tr>
			                         <tr>
                                         <td bgcolor="#FFC1C1" colspan="3"><b>Situação: </b>'.$processos['situacao'].' em '.$dataproc[2].'/'.$dataproc[1].'/'.$dataproc[0].' '; if($processos['situacao'] == 'aceito') { echo 'aguarde contato para combinar o transporte'; } if($processos['situacao'] == 'recebido') { echo '<font color="red">finalize o processo!</div>'; } echo '</td></tr>
                              </table></td>
                              </tr>
                              </table><br>';
			       $i++;
               }
           }
           
           if(isset($_GET['aceitar'])) {
               $residuo = $_GET['aceitar'];
               $newid = $_GET['newid'];
               $id = $_GET['id'];
               $quantidade = $_GET['quantidade'];
               $unidade = $_GET['unidade'];
               $data = date('Y-m-d');

               $sql = mysql_query("UPDATE processos SET situacao = 'aceito', dataproc = '$data' WHERE newid = '$newid' AND id = '$id' LIMIT 1");

               $sqlprocesso = mysql_query("SELECT para FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");
               $processo = mysql_fetch_array($sqlprocesso);

               $para = $processo['para'];
               $de = $_SESSION['usuarioLab'];

               $mensagem1 = "Você aceitou a solicitação do $para de $quantidade $unidade de $residuo. Aguarde contato.";
               $mensagem2 = "A solicitação de $quantidade $unidade de $residuo foi aceita pelo $de. Entre em contato para acertar o transporte.";
               $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem1', '$de', '$data')");
               $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem2', '$para', '$data')");

               echo '<div align="center">Solicitação de '.$residuo.' aceita.</div>';
           }
           
           if(isset($_GET['recusar'])) {
               $residuo = $_GET['recusar'];
               $newid = $_GET['newid'];
               $id = $_GET['id'];
               $quantidade = $_GET['quantidade'];
               $unidade = $_GET['unidade'];
               $data = date('Y-m-d');
               
               $sqlprocesso = mysql_query("SELECT para FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");
               $processo = mysql_fetch_array($sqlprocesso);

               $para = $processo['para'];
               $de = $_SESSION['usuarioLab'];
               
               $sql = mysql_query("SELECT quantidade FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
               $linha = mysql_fetch_assoc($sql);
               
               $soma = $linha['quantidade'] + $quantidade;
               $sqlresiduo = mysql_query("UPDATE residuos SET quantidade = '$soma' WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
               $sqlprocessos = mysql_query("DELETE FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");
               
               $mensagem1 = "Solicitação de $quantidade $unidade de $residuo recusada ao $para.";
               $mensagem2 = "A solicitação de $quantidade $unidade de $residuo foi recusada pelo $de.";
               $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem1', '$de', '$data')");
               $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem2', '$para', '$data')");
               
               echo '<div align="center">Solicitação de '.$residuo.' recusada!</div>';
           }
           
           if(isset($_GET['recebido'])) {
               $residuo = $_GET['recebido'];
               $newid = $_GET['newid'];
               $id = $_GET['id'];
               $quantidade = $_GET['quantidade'];
               $unidade = $_GET['unidade'];
               $data = date('Y-m-d');

               $sql = mysql_query("UPDATE processos SET situacao = 'recebido', dataproc = '$data' WHERE newid = '$newid' AND id = '$id' LIMIT 1");

               $sqlprocesso = mysql_query("SELECT de FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");
               $processo = mysql_fetch_array($sqlprocesso);

               $de = $processo['de'];
               $para = $_SESSION['usuarioLab'];

               $mensagem = "$quantidade $unidade de $residuo entregue ao $para pelo $de.";
               $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$de', '$data')");
               $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$para', '$data')");

               echo '<div align="center">Recebimento confirmado. Assim que o laboratório solicitado confirmar a entrega<br>o processo será finalizado e passará a constar no seu histórico.</div>';
           }
           
           if(isset($_GET['finalizar'])) {
               $residuo = $_GET['finalizar'];
               $newid = $_GET['newid'];
               $id = $_GET['id'];
               $quantidade = $_GET['quantidade'];
               $unidade = $_GET['unidade'];
               $data = date('Y-m-d');
               
               $sqlprocesso = mysql_query("SELECT para FROM processos WHERE newid = '$newid' AND id = '$id' LIMIT 1");
               $processo = mysql_fetch_array($sqlprocesso);

               $para = $processo['para'];
               $de = $_SESSION['usuarioLab'];
               
               $mensagem = "PROCESSO FINALIZADO: $quantidade $unidade de $residuo de $de para $para.";
               $sqlhistoricos1 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$de', '$data')");
               $sqlhistoricos2 = mysql_query("INSERT INTO historicos VALUES(NULL, '0', '$mensagem', '$para', '$data')");
               
               $sqlprocessos = mysql_query("DELETE FROM processos WHERE newid ='$newid' AND id ='$id' LIMIT 1");
               $sql = mysql_query("SELECT quantidade FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
               $estoque = mysql_fetch_assoc($sql);
               if($estoque['quantidade'] == 0) {
                   $sqlresiduo = mysql_query("DELETE FROM residuos WHERE id = '$id' AND nome = '$residuo' LIMIT 1");
               }
               echo '<div align="center">Processo finalizado e armazenado no histórico.</div>';
           }
        ?>
	</td>
</tr>

<table>

</div>
</body>
</html>
