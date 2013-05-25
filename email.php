<?php
session_start();

require("include/phpmailer/class.phpmailer.php");


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
	
	/* Prepara classe para envio do email */

	$msgEmail = 'Olá '.$rowDoador['nome'].'<br />
	Gostariamos de informar que '.$_SESSION['nome'].' tem interesse em adotar o '.$selectAnimal['nome'].'.<br />
	O e-mail do interessado é: '.$rowUser['email'].'<br />e o telefone é: '.$rowUser['telefone'].'
	<br /><br />Email enviado por PetDog.<br />POR FAVOR NÃO RESPONDA ESTE E-MAIL!';

	// Inicia a classe PHPMailer
	$mail = new PHPMailer();

	// Define os dados do servidor e tipo de conexão
	$mail->IsSMTP(); // Define que a mensagem será SMTP
	$mail->Host = "smtps.bol.com.br"; // Endereço do servidor SMTP
	$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
	$mail->Username = 'petdogcontato@bol.com.br'; // Usuário do servidor SMTP
	$mail->Password = '12qwaszx'; // Senha do servidor SMTP
 	
 	// Define o remetente
	$mail->From = "petdogcontato@bol.com.br"; // Seu e-mail
	$mail->FromName = "PetDog"; // Seu nome

	// Define os destinatário(s)
	$mail->AddAddress($rowDoador['email'], $rowDoador['nome']);

	// Define os dados técnicos da Mensagem
	$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

	// Define a mensagem (Texto e Assunto)
	$mail->Subject  = "Interesse em adotar um de seus animais!"; // Assunto da mensagem
	$mail->Body = $msgEmail;

	// Envia o e-mail
	$enviado = $mail->Send();

	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	// Exibe uma mensagem de resultado
	if ($enviado) {
		echo $enviado;
	} else {
		echo $mail->ErrorInfo;
	}
}
?>