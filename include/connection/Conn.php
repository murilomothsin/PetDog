<?php

$hostname = "localhost";
$database = "petdog";
$username = "root";
$password = "123";
$Conn = mysql_connect($hostname, $username, $password); 

if($Conn === false){
	die("Erro ao conectar no banco de dados!<br /><br />".mysql_error());
}

mysql_select_db($database, $Conn);

?>