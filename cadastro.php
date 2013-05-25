<?php
//Include
include("include/config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
if($_POST){
	if($_POST['insert']){
		pr($_POST);
		$nome = "nome = '".mysql_real_escape_string($_POST['nome'])."'";
		$usuario = "usuario = '".mysql_real_escape_string($_POST['usuario'])."'";
		$senha = "senha = md5(".$_POST['senha'].")";
		$endereco = "endereco = '".mysql_real_escape_string($_POST['endereco'])."'";
		$cep = "cep = '".mysql_real_escape_string($_POST['cep'])."'";
		$telefone = "telefone = '".mysql_real_escape_string($_POST['telefone'])."'";
		$email = "email = '".mysql_real_escape_string($_POST['email'])."'";
		$nascimento = "nascimento = '".mysql_real_escape_string($_POST['nascimento'])."'";

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
		$result = mysql_query($queryCadastro) or die("Erro ao executar o comando");
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
<title>petdog! Conheça aqui seu novo amigo.</title>
</head>
<body>
<div id="wrapper">
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.html">início</a></li>
			<li><a href="fotos.html">FOTOS</a></li>
			<li><a href="contato.html">CONTATO</a></li>
			<li><a href="sobre.html">SOBRE</a></li>
			<li class="last"><a href="login.html">LOGIN</a></li>
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
		<form action="" name="cadastro" id="cadastro" method="post" enctype="multipart/form-data">
			<table width="400">
				<tr>
					<td width="100" align="right">
						<label for="nome">Nome:</label>
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
						<label for="telefone">Telefone:</label>
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
						<input name="nascimento" type="text" id="nascimento" style="width:100%;" maxlength="10" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="email">E-mail:</label>
					</td>
					<td width="300">
						<input name="email" type="text" id="email" style="width:100%;" maxlength="25" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="usuario">Usuário:</label>
					</td>
					<td width="300">
						<input name="usuario" type="text" id="usuario" style="width:100%;" maxlength="25" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="senha">Senha:</label>
					</td>
					<td width="300">
						<input name="senha" type="password" id="senha" style="width:100%;" maxlength="25" />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="confirma_senha">Confime a senha:</label>
					</td>
					<td width="300">
						<input name="confirma_senha" type="password" id="confirma_senha" style="width:100%;" maxlength="25" />
					</td>
				</tr>
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
