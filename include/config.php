<?php

require_once("connection/Conn.php");
require_once("function/functions.php");

$query = "SELECT * FROM usuario";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

?>