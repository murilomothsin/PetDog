<?php
session_start();
//Include
include("include/config.php");

if(isset($_SESSION['nome'])){
	$Usuario ='<span class="saudacaoHeader">Olá '.$_SESSION['nome'].'</span>';
	$loginout = '<li class="last"><a href="logout.php">LOGOUT</a></li>';
}else{
	$Usuario = '';
	$loginout = '<li class="last"><a href="login.php">LOGIN</a></li>';
}

/* Seleciona as fotos de animais disponiveis para adoção */
$queryAniamis = "SELECT * FROM animal";
$result = mysql_query($queryAniamis) or die("Erro ao acessar o banco de dados<br />".mysql_error());
while($row = mysql_fetch_assoc($result)){
	switch ($row['idade']) {
		case 1:
			$row['idade'] = 'Até 1 mes';
		break;
		case 2:
			$row['idade'] = 'De 1 mes até 6 meses';
		break;
		case 3:
			$row['idade'] = 'De 6 meses até 1 ano';
		break;
		case 4:
			$row['idade'] = 'Mais de 1 ano';
		break;
		default:
			$row['idade'] = '-';
		break;
	}
	switch ($row['tipo']) {
		case 1:
			$row['tipo'] = 'Cachorro';
		break;
		case 2:
			$row['tipo'] = 'Gato';
		break;
		case 3:
			$row['tipo'] = 'Outro';
		break;
		
		default:
			$row['tipo'] = 'Outro';
		break;
	}
	$fotos[] = $row;
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
<script type="text/javascript">
function adotar(value){
	if(confirm("Será enviado um email para o dono do animal informando seu interess em adota-lo.")){
		$.ajax({
			type: 'POST',
			url: 'email.php',
			data: 'acao=adotar&idanimal='+value,
			cache: false,
			beforeSend: function(){
			},
			success: function(txt){
				if(txt == '1' || txt == 1){
					document.getElementById(value).setAttribute('disabled', 'disabled');
				}else
					alert("Erro ao enviar email!");
			},
			error: function(){
				alert("Erro ao enviar email!");
			}
		});
	}
}
</script>
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
	<h1><a href="index.php">PETDOG! </a></h1>
	<h2>Conheça aqui seu novo amigo.</h2>
</div>
<!-- end header -->
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<a href="adicionar.php"><h2><center>Adicionar um novo animal para doação!</center></h2></a>
		<div class="post"><center><h2>Fotos</h2></center></div>
		<ul>
		<?php
		if(count($fotos) > 0){
			foreach ($fotos as $key => $value) { ?>
			<li class="listaFotos" style="">
				<div style="float: left; width: 220px;">
					<img src="upload/pet/<?php echo $value['foto']?>" style="width: 200px; max-height: 200px; margin: 5px;">
					<center><button id="<?php echo $value['idanimal']?>" class="Buttons" onclick="adotar(this.id);">Adotar!</button></center>
				</div>
				<div>
					<center><h3><?php echo $value['nome']?></h3></center>
					<p style="text-align: left;"><?php echo $value['descricao']?></p>
					<span style="color: #FFF">Raça:</span> <?php echo $value['raca']?><br />
					<span style="color: #FFF">Idade:</span> <?php echo $value['idade']?><br />
					<span style="color: #FFF">Tipo:</span> <?php echo $value['tipo']?><br />
					<span style="color: #FFF">Adicionado:</span> <?php echo formatDate($value['adicionado'])?>
				</div>
			</li>
		<?php
			}
		}else{
		?>
		<li>
			<div>
				Não há fotos cadastradas!
			</div>
		</li>
		<?php
		}
		?>
		</ul>
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
