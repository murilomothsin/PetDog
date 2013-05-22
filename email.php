<?php
session_start();

if($_POST['acao'] == 'adotar'){
	$selectAnimal = "SELECT * FROM animal WHERE idanimal = '".$_POST['idanimal']."'";
	$result = mysql_query($selectAnimal);
	$row = mysql_fetch_assoc($result);

	$selectDoador = "SELECT * FROM usuario WHERE idusuario = ".$row['doador'];
	$resultDoador = mysql_query($selectDoador);
	$rowDoador = mysql_fetch_assoc($resultDoador);

	$selectUser = "SELECT * FROM usuario WHERE idusuario = ".$_SESSION['idusuario'];
	$resultUser = mysql_query($selectUser);
	$rowUser = mysql_fetch_assoc($resultUser);
	
	$msgEmail = 'Olá '.$rowDoador['nome'].'<br />
	Gostariamos de informar que '.$_SESSION['nome'].' tem interesse em adotar o '.$selectAnimal['nome'].'.<br />
	O e-mail do interessado é: '.$rowUser['email'].'<br />e o telefone é: '.$rowUser['telefone'].'
	<br /><br />Email enviado por PetDog.<br />POR FAVOR NÃO RESPONDA ESTE E-MAIL!';
	$to = $rowDoador['nome'].'<'.$rowDoador['email'].'>';
	$subject = 'Interesse em adotar um de seus animais!';
	$mens = '<html><body><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'.PHP_EOL;
	$mens .= '<center>'.$msgEmail.'</center></body></html>'.PHP_EOL;
	$headers .= "From: PetDog <contato@petdog.com.br>".PHP_EOL;
	$headers = "MIME-Version: 1.0".PHP_EOL;
	$header.="Content-Type: text/html; charset=utf-8".PHP_EOL;

	$email = mail($to,$subject,$mens,$headers);

	if($email){
		echo '1';
	}
	echo $email;
}
?>