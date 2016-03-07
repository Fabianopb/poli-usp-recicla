<html>
<head>
	<title>Poli Recicla - Sistema de Gestão de Resíduos Laboratoriais da Escola Politécnica da USP</title>
	<link rel=stylesheet href="../estilo.css" type="text/css">
</head>
<body>
<div align="center" width="800">
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
    <?php
         $max = 20;
         echo '<br><b>Histórico</b><br><br>Somente ficarão salvas no histórico as últimas '.$max.' operações. Ao sair desta página<br>todas as mensagens não lidas serão marcadas como lidas.<br><br>';
         $lab = $_SESSION['usuarioLab'];
         $sql = mysql_query("SELECT * FROM historicos WHERE lab = '$lab' ORDER BY data, id");
         $total = mysql_num_rows($sql);
         $i = 0;
         if($total > $max) {
             for($j = 0; $j < ($total - $max); $j++) {
                 $apaga = mysql_query("DELETE FROM historicos WHERE lab = '$lab' ORDER BY data, id ASC LIMIT 1");
             }
         }
         $sql = mysql_query("SELECT * FROM historicos WHERE lab = '$lab' ORDER BY data DESC, id DESC");
         echo '<table class="produto" width="600" border="1" cellpadding="3" cellspacing="0">
                    <tr>
                        <th>#</th>
                        <th>data</th>
                        <th>mensagem</th>
                    </tr>';
         while($historico = mysql_fetch_array($sql)) {
             $i++;
             if($historico['lido'] == 0) {
                 $cor = '#FFC1C1';
                 $id = $historico['id'];
                 $mensagem = $historico['mensagem'];
                 $sqlupdate = mysql_query("UPDATE historicos SET lido = '1' WHERE id = '$id' AND mensagem = '$mensagem' LIMIT 1");
             }
             else { $cor = '#e8e8e8';}
             echo '<tr>
                       <td width="15" align="center" bgcolor="'.$cor.'">'.$i.'</td>
                       <td bgcolor="'.$cor.'">'.$historico['data'].'</td>
                       <td align="left" bgcolor="'.$cor.'">'.$historico['mensagem'].'</td>
                   </tr>';
         }
         echo '</table>';
    ?>
	</td>
</tr>

<table>

</div>
</body>
</html>
