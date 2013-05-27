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
		<div class="post">Sobre:</div>
		<div class="post"></div>
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
