<?php
session_start();
//Include
include("include/config.php");

if(isset($_SESSION['nome'])){
  $Usuario ='<span class="saudacaoHeader"><a href="perfil.php">Olá '.$_SESSION['nome'].'</a></span>';
  $loginout = '<li class="last"><a href="logout.php">LOGOUT</a></li>';
}else{
  $Usuario = '';
  $loginout = '<li class="last"><a href="login.php">LOGIN</a></li>';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>petdog! Conheça aqui seu novo amigo.</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php">início</a></li>
			<li><a href="fotos.php">FOTOS</a></li>
			<li><a href="contato.php">CONTATO</a></li>
			<li><a href="sobre.php">SOBRE</a></li>
			<?php
      echo $loginout; 
      ?>

    </ul>
    <?php
    echo $Usuario;
    ?>
		</ul>
	</div>
</div>
<div id="logo">
	<h1><a href="#">PETDOG! </a></h1>
	<h2>Conheça aqui seu novo amigo.</h2>
</div>
<!-- end header -->
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post"><script language="javascript" type="text/javascript">

function checa_formulario(email){

    if (email.nome.value == ""){
  alert("Por Favor não deixe o seu nome em branco!!!");
   email.nome.focus();
    return (false);
}

    if (email.email_from.value == ""){
  alert("Por Favor não deixe o seu email em branco!!!");
   email.email_from.focus();
    return (false);
}

    if (email.email.value == ""){
  alert("não deixe o email destinatario em branco!!!");
   email.email.focus();
    return (false);
}

    if (email.assunto.value == ""){
  alert("não deixe o assunto em branco!!!");
   email.assunto.focus();
    return (false);
}

}
</script>
<title>Enviando texto</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.email {
text-transform: lowercase;
}
.texto {
color: #0000FF
}
.style1 {color: #FF0000}

-->
</style>
</head>

<body onLoad="document.email.nome.focus();">
<form onSubmit="return checa_formulario(this)" action="envia.php" method="post" enctype="multipart/form-data" name="email">
  <h1 align="center" class="style1">envie aqui fotos de animais para adoção:</h1>
  <table width="32%"  border="0" align="center">
    <tr>
      <td><div align="right"><span class="texto">Nome</span></div></td>
      <td><input name="nome" type="text" id="nome"></td>
    </tr>
    <tr>
      <td width="33%"><div align="right" class="texto">De:</div></td>
      <td width="67%"><input name="email_from" type="text" class="email"></td>
    </tr>
    <tr>
      <td><div align="right" class="texto">Para</div></td>
      <td><input name="email" type="text" class="email">
    </tr>
    <tr>
      <td><div align="right" class="texto">Assunto</div></td>
      <td><input name="assunto" type="text" id="assunto"></td>
    </tr>
    <tr>
      <td><div align="right" class="texto">Mensagem</div></td>
      <td><textarea name="mensagem" cols="50" rows="10" id="mensagem"></textarea></td>
    </tr>
    <tr>
      <td><div align="right" class="texto">Anexo</div></td>
      <td><input name="arquivo" type="file"></td>
    </tr>
    <tr>
      <td> </td>
      <td><input type="submit" name="Submit" value="Enviar"></td>
    </tr>
  </table>
</form>
</div>
		<div class="post">
		  <p>* Insira no campo &quot;Para&quot; o endereço de email de um dos administradores:</p>
		  <p>Cleiton Marcolan - cleitongm@gmail.com</p>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li id="search">
				<h2>busca:</h2>
				<form method="get" action="">
					<fieldset>
					<input type="text" id="s" name="s" value="" />
					<input name="" type="submit" id="x" value="Buscar" />
					</fieldset>
				</form>
			</li>
		</ul>
	</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<!-- start footer -->
<div id="footer">
	<div id="footer-wrap">
	<p id="legal">( c ) 2013. Todos os direitos reservados. Cleiton Marcolan.</p>
	</div>
</div>
<!-- end footer -->
</body>
</html>
