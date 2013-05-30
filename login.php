<?php
//Include
include("include/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
if($_POST){
	if($_POST['submit'] == 'Login'){
		$querySelectUsuario = "SELECT * FROM usuario 
										WHERE usuario = '".mysql_real_escape_string($_POST['usuario'])."'
										AND senha = md5('".$_POST['senha']."')
										LIMIT 1";
		$result = mysql_query($querySelectUsuario) or die("Erro no banco!");
		$rowUsuario = mysql_fetch_assoc($result);
		$numRow = mysql_num_rows($result);
		if($numRow > 0){
			session_start();

			$_SESSION['idusuario'] = $rowUsuario['idusuario'];
			$_SESSION['nome'] = $rowUsuario['nome'];
			$_SESSION['ADM'] = $rowUsuario['adm'];
			header("Location: index.php");
		}else{
			unset($_POST);
			header("Location: login.php?erro=1");
		}
	}
}
?>

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
<script type="text/javascript" src="include/script/jquery-1.9.1.js"></script>
<script type="text/javascript">
function ValUser(){
	if (document.getElementById('usuario').value.length < 3){
		//$('#loading-area').css("display","block");
		$('#error-msg').html('Usuário invalido, m&iacute;nimo 3 caracteres.');
        $('#error-msg').show();
		document.getElementById('msgUsuario').className = 'msgError';
		document.getElementById('usuario').focus();
		setTimeout(hideError, 4000);
		return false;
	}
	else {
		$('#error-msg').hide();
		document.getElementById('msgUsuario').className = 'msgYes';
		return true;
	}
}

function ValPass(){
	if (document.getElementById('senha').value.length < 2){
		//$('#loading-area').css("display","block");
		$('#error-msg').html('Digite uma senha valida, m&iacute;nimo 2 caracteres.');
        $('#error-msg').show();
		document.getElementById('msgSenha').className = 'msgError';
		document.getElementById('senha').focus();
		setTimeout(hideError, 4000);
		return false;
	}
	else {
		$('#error-msg').hide();
		document.getElementById('msgSenha').className = 'msgYes';
		return true;
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
			<li class="last"><a href="login.php">LOGIN</a></li>
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
		<center><div style="width: 350px; heigth: 200px; border: 1px solid #ABABAB">
			<?php
				if(isset($_GET['erro']) && $_GET['erro'] == 1){
					echo '<span style="color: red;">Usuário ou senha errado!</span>';
				}
			?>
			<div id="error-msg"></div>
			<form action="" name="login" id="login" method="post" enctype="multipart/form-data">
				<table width="300">
					<tr>
						<td width="100" align="right">Login:</td>
						<td>
							<input name="usuario" type="text" id="usuario" onchange="return ValUser();" style="width:85%; float:left;" maxlength="25" />
							<div id="msgUsuario" class="msg" style="float:left;"></div>
						</td>
					</tr>
					<tr>
						<td width="100" align="right">
							<label for="senha">Senha:</label>
						</td>
						<td>
							<input name="senha" type="password" id="senha" onchange="return ValPass();" style="float:left; width:85%;" maxlength="25" />
							<div id="msgSenha" class="msg" style="float:left;"></div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input name="submit" type="submit" onclick="" class="Buttons" id="submit" value="Login" />
						</td>
					</tr>
				</table>
			</form>
		</div></center>
		<div class="post"><a href="cadastro.php"><h2><center>Quero me cadatrar!</center></h2></a></div>
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
