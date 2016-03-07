<?php
include "conecta.php";

session_start();

function ValidaUsuario($numero, $senha) {
$sql = "SELECT * FROM usuarios WHERE numero = '$numero' AND senha = '$senha' LIMIT 1";
$query = mysql_query($sql);
$res = mysql_fetch_assoc($query);
if(empty($res)) {
return false;
}
else {
$_SESSION['usuarioNome'] = $res['nome'];
$_SESSION['usuarioLab'] = $res['laboratorio'];
return true;
}
}

function Protecao() {
if (!isset($_SESSION['usuarioNome'])) {
session_destroy();
header("Location: ../login.php");
}
}

function Identifica() {
date_default_timezone_set('America/Sao_Paulo');
$agora = date('G');
if($agora > 12) {
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
$primeiroNome = explode(" ", $_SESSION['usuarioNome']);
echo $primeiroNome[0];
}

?>

		
