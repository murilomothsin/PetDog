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
<?php
include("include/config.php");
?>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
<title>petdog! Conheça aqui seu novo amigo.</title>
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
		<div class="post">
			<h1 class="title">Bem vindo!</h1>
			<div class="entry">
				<div>
				  <p>O site Petdog é um site especializado em ajudar nossos maiores   amigos! Entre, cadatre-se e conheça os animais da sua região que estão   disponíveis para adoção!</p>
			  </div>
                <div></div>
                <p>&nbsp;</p>
			</div>
		</div>
		<div class="post">
			<h2 class="title">Ultimas notícias:</h2>
			<div class="entry">
				<p>Nosso site está no ar desde 16 de Abril de 2013, se você ainda não se   cadastrou, aproveite esta visita e cadastre-se! É grátis, e você pode   acabar mudando a vida de algum animal.</p>
			</div>
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
			<li>
				<h2>parceiros:</h2>
				<ul>
					<li><a href="#">Fusce dui neque fringilla</a></li>
					<li><a href="#">Eget tempor eget nonummy</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Nec metus sed donec</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Velit semper nisi molestie</a></li>
					<li><a href="#">Eget tempor eget nonummy</a></li>
				</ul>
			</li>
			<li>
				<h2>Volutpat Dolore</h2>
				<ul>
					<li><a href="#">Nec metus sed donec</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Velit semper nisi molestie</a></li>
					<li><a href="#">Eget tempor eget nonummy</a></li>
					<li><a href="#">Nec metus sed donec</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Velit semper nisi molestie</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
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
