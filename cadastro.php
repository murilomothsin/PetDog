<?php
//Include
include("include/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
if($_POST){
	if($_POST['insert']){
		if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $_POST['email'])){
			header("Location: cadastro.php?cadastro=4");
			die();
		}
		if($_POST['usuario'] == '' || $_POST['nome'] == '' || $_POST['email'] == '' || $_POST['senha'] == '' || $_POST['telefone'] == ''){
			header("Location: cadastro.php?cadastro=4");
			die();
		}
		if($_POST['senha'] == $_POST['confirma_senha']){
			$senha = "senha = md5('".$_POST['senha']."')";
		}else
			header("Location: cadastro.php?cadastro=3");
		$nome = "nome = '".mysql_real_escape_string($_POST['nome'])."'";
		$usuario = "usuario = '".mysql_real_escape_string($_POST['usuario'])."'";
		$endereco = "endereco = '".mysql_real_escape_string($_POST['endereco'])."'";
		$cep = "cep = '".mysql_real_escape_string($_POST['cep'])."'";
		$telefone = "telefone = '".mysql_real_escape_string($_POST['telefone'])."'";
		$email = "email = '".mysql_real_escape_string($_POST['email'])."'";
		$nascimento = "nascimento = '".inverte($_POST['nascimento'], "/", "-")."'";

		$queryCadastro = "INSERT INTO usuario SET ".$nome.",
												".$usuario.",
												".$senha.",
												".$endereco.",
												".$cep.",
												".$telefone.",
												".$email.",
												".$nascimento.",
												adm = 0,
												cadastro = now(),
												ultimo_acesso = now()";
		$result = mysql_query($queryCadastro) or die(header("Location: cadastro.php?cadastro=2"));
		unset($_POST);
		header("Location: cadastro.php?cadastro=1");
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
<script type="text/javascript" src="include/script/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="include/script/jQuery.maskedinput.js"></script>
<title>petdog! Conheça aqui seu novo amigo.</title>
<script type="text/javascript">
$(function(){
	$('#nascimento').mask("99/99/9999");
	$('#telefone').mask("(99)99999999");
	$('#cep').mask("99999999");
});
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

function ValConf(){
	senha = document.getElementById('senha').value;
	conf_senha = document.getElementById('confirma_senha').value;
	if (senha != conf_senha){
		//$('#loading-area').css("display","block");
		$('#error-msg').html('Confirmação de senha invalida.');
        $('#error-msg').show();
		document.getElementById('msgSenha').className = 'msgError';
		document.getElementById('msgConfSenha').className = 'msgError';
		document.getElementById('confirma_senha').focus();
		setTimeout(hideError, 4000);
		return false;
	}
	else {
		if(senha > 2){
			$('#error-msg').hide();
			document.getElementById('msgSenha').className = 'msgYes';
			document.getElementById('msgConfSenha').className = 'msgYes';
			return true;
		}else{
			ValPass();
		}
		
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
		<?php
		if(isset($_GET['cadastro']) && $_GET['cadastro'] == 1){
		?>
		<div>
			<center><h1>Cadastro realizado com sucesso!</h1></center>
			<br /><br />
			<center><h3>Para postar fotos faça o <a href="login.php">login</a> no sistema.</h3></center>
		</div>
		<?php
		}else{
		?>
		<center><div id="error-msg" style="color: red;"></div></center>
		<form action="" name="cadastro" id="cadastro" method="post" enctype="multipart/form-data">
			<table width="400">
				<?php
				if(isset($_GET['cadastro']) && $_GET['cadastro'] == 3){
					echo '<tr><td colspan="2" align="center"><span style="color: red;">Confirmação de senha invalida!</span></td></tr>';
				}
				if(isset($_GET['cadastro']) && $_GET['cadastro'] == 2){
					echo '<tr><td colspan="2" align="center"><span style="color: red;">Erro ao acessar o banco de dados!</span></td></tr>';
				}
				if(isset($_GET['cadastro']) && $_GET['cadastro'] == 4){
					echo '<tr><td colspan="2" align="center"><span style="color: red;">Campos obrigatórios não preenchidos corretamente!</span></td></tr>';
				}
				?>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="nome">Nome:</label>
					</td>
					<td width="300">
						<input name="nome" type="text" id="nome" style="width:100%;" maxlength="200" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="endereco">Endereço:</label>
					</td>
					<td width="300">
						<input name="endereco" type="text" id="endereco" style="width:100%;" maxlength="250" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="cep">CEP:</label>
					</td>
					<td width="300">
						<input name="cep" type="text" id="cep" style="width:100%;" maxlength="8" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="telefone">Telefone:</label>
					</td>
					<td width="300">
						<input name="telefone" type="text" id="telefone" style="width:100%;" maxlength="12" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="nascimento">Data de Nascimento:</label>
					</td>
					<td width="300">
						<input name="nascimento" type="text" id="nascimento" style="width:35%;" maxlength="10" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="email">E-mail:</label>
					</td>
					<td width="300">
						<input name="email" type="text" id="email" style="width:100%;" maxlength="25" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="usuario">Usuário:</label>
					</td>
					<td width="300">
						<input name="usuario" type="text" id="usuario" onchange="return ValUser();" style="float:left; width:90%;" maxlength="25" />
						<div id="msgUsuario" class="msg" style="float:left;"></div>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="senha">Senha:</label>
					</td>
					<td width="300">
						<input name="senha" type="password" id="senha" onchange="return ValPass();" style="float:left; width:75%;" maxlength="25" />
						<div id="msgSenha" class="msg" style="float:left;"></div>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<span style="color: red;">*</span><label for="confirma_senha">Confime a senha:</label>
					</td>
					<td width="300">
						<input name="confirma_senha" type="password" id="confirma_senha" onchange="return ValConf();" style="float:left; width:75%;" maxlength="25" />
						<div id="msgConfSenha" class="msg" style="float:left;"></div>
					</td>
				</tr>
				<tr><td colspan="2"><span style="color: red;">(*) Campos obrigatórios</span></td></tr>
				<tr>
					<td><input type="hidden" name="insert" value="1" /></td>
					<td align="center">
						<input name="submit" type="submit" onclick="" class="Buttons" id="submit" value="Cadastrar" />
					</td>
				</tr>
			</table>
		</form>

		<?php
		}
		?>
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
