<?php 
$nomebd = "polirecicla";
$usuario = "root";
$senha = "";
if(!($id = @mysql_connect("localhost",$usuario,$senha))) {
echo "Não foi possível conectar ao servidor!";
exit;
}
if(!($bd = @mysql_select_db($nomebd,$id))) {
echo "Não foi possível conectar ao banco de dados!";
}
?>	