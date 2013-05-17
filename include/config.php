<?php

require_once("connection/Conn.php");

$query = "SELECT * FROM usuario";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);
echo '<pre>';
print_r($row);
echo '</pre>';

?>