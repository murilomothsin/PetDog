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
		<div class="post"><h1>Sobre:</h1></div>
		<div class="post">
			<p>
				A cada dia que passa a população de animais abandonados aumenta em nossas cidades, com a falta de incentivo à 
				adoção e a castração de nossos bichos de estimação esse número tende a aumentar. Atualmente estão surgindo 
				diversas instituições não governamentais (ONG’s) que estão abraçando a causa e lutando por melhorias neste 
				setor, porém a falta de divulgação e de um meio de comunicação eficiente e interativo faz com que muitas pessoas 
				acabem por não saber como funcionam e onde se localizam tais instituições.
			</p>
			<p>
				O site interativo PETDOG está propiciando uma nova maneira de interagir com todos aqueles que trabalham auxiliando 
				animais abandonados, mostrando uma versátil interface com um banco de dados próprio para armazenamento de fotos e 
				informações dos animais. Possibilitando assim a interação da população com aqueles que podem ser seus futuros 
				animais de estimação.
			</p>
			<span style="float: right;">
				Att. Cleiton Marcolan<br />
				cleitongm@gmail.com
			</span>
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
