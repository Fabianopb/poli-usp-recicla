<?php
include "../conecta.php";

session_start();

function ValidaAdmin($nome, $senha) {
$sql = "SELECT nome FROM administradores WHERE nome = '$nome' AND senha = '$senha' LIMIT 1";
$query = mysql_query($sql);
$res = mysql_fetch_assoc($query);
if(empty($res)) {
return false;
}
else {
$_SESSION['adminNome'] = $res['nome'];
return true;
}
}

function Protecao() {
if (!isset($_SESSION['adminNome'])) {
session_destroy();
header("Location: index.php");
}
}

function Identifica() {
date_default_timezone_set('America/Sao_Paulo');
$agora = date('G');
if($agora >= 12) {
	if($agora < 18) {
	echo "&nbsp;&nbsp;&nbsp;&nbsp;Boa tarde ";
	}
	if($agora >= 18) {
	echo "&nbsp;&nbsp;&nbsp;&nbsp;Boa noite ";
	}
}
else {
echo "&nbsp;&nbsp;&nbsp;&nbsp;Bom dia ";
}
echo $_SESSION['adminNome'];
}

?>

		
