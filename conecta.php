<?php 
$nomebd = "polirecicla";
$usuario = "root";
$senha = "";
if(!($id = @mysql_connect("localhost",$usuario,$senha))) {
echo "N�o foi poss�vel conectar ao servidor!";
exit;
}
if(!($bd = @mysql_select_db($nomebd,$id))) {
echo "N�o foi poss�vel conectar ao banco de dados!";
}
?>	