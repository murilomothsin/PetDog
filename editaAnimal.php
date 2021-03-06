<?php
session_start();
//Include
include("include/config.php");
/* Classe responsavel por validar o upload de imagens */
require_once('include/class/upload.php');

if(isset($_SESSION['nome'])){
	$Usuario ='<span class="saudacaoHeader"><a href="perfil.php">Olá '.$_SESSION['nome'].'</a></span>';
	$loginout = '<li class="last"><a href="logout.php">LOGOUT</a></li>';
}else{
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
	echo '<center><br />Você deve estar Logado no sistema para editar esta postagem.<br />';
	echo '<br /><br /><a href="index.php">Retornar para pagina o início!</a></center>';
	die();
}

if(isset($_GET['id'])){
	if($_GET['acao'] == 'edit'){
		$selectAnimal = "SELECT * FROM animal WHERE idanimal = ".$_GET['id'];
		$result = mysql_query($selectAnimal);
		$numRow = mysql_num_rows($result);
		if($numRow == 1){
			$Animal = mysql_fetch_assoc($result);
		}else{
			echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
			echo '<center><br />Cadastro não encontrado.<br />';
			echo '<br /><br /><a href="index.php">Retornar para pagina o início!</a></center>';
			die();
		}
	}else if($_GET['acao'] == 'del'){
		$deleteAnimal = "DELETE FROM animal WHERE idanimal = ".$_GET['id'];
		$result = mysql_query($deleteAnimal);
		header("Location: perfil.php");
		die();
	}
}else{
	echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
	echo '<center><br />Cadastro não encontrado.<br />';
	echo '<br /><br /><a href="index.php">Retornar para pagina o início!</a></center>';
	die();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
if($_POST){
	if($_POST['update']){
		if($_FILES["file"]["tmp_name"] != null){
			$selectFoto = "SELECT foto FROM animal WHERE idanimal = ".$_GET['id'];
			$result = mysql_query($selectFoto) or die("Erro na solicitação!");
			$foto = mysql_fetch_assoc($result);
			$file_name = $foto['foto'];
			$path = 'upload/pet/' . $file_name;
			if (file_exists($path) && $_SESSION["idusuario"] != null) unlink($path);
			/* Adicionar foto ao servidor */
			if ($upload->upload_file($_FILES["file"]["tmp_name"], 'upload/pet/', $file_name)){
				$new_name = $upload->get_file_name();
			}else{
				echo '<br />Houve um erro ao enviar a imagem. Por favor, tente novamente.<br />';
				header("Location: adicionar.php");
			}
		}
		if($_POST['adotado'] > 0){
			$adotado = $_POST['adotado'];
			$adotado_em = 'NOW()';
		}else{
			$adotado = 'null';
			$adotado_em = 'null';
		}
		$nome = "nome = '".mysql_real_escape_string($_POST['nome'])."'";
		$raca = "raca = '".mysql_real_escape_string($_POST['raca'])."'";
		$descricao = "descricao = '".mysql_real_escape_string($_POST['descricao'])."'";

		$queryCadastro = "UPDATE animal SET ".$nome.",
												".$raca.",
												".$descricao.",
												tipo = '".$_POST['tipo']."',
												idade = '".$_POST['idade']."',
												adotado_por = ".$adotado.",
												adotado_em = ".$adotado_em."
												WHERE idanimal = ".$_GET['id'];
		pr($queryCadastro);
		$result = mysql_query($queryCadastro) or die("Erro ao executar o comando");
		unset($_POST);
		header("Location: perfil.php");
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
		<?php
		if(isset($_GET['cadastro']) && $_GET['cadastro'] == 1){
		?>
		<div>
			<center><h1>Cadastro realizado com sucesso!</h1></center>
			<br /><br />
			<center><h3>Para vizualizar a foto faça clique na aba <a href="fotos.php">fotos</a>.</h3></center>
		</div>
		<?php
		}else{
		?>
		<form action="" name="editarAdocao" id="editarAdocao" method="post" enctype="multipart/form-data">
			<table width="400">
				<tr>
					<td width="100" align="right">
						<label for="tipo">Tipo:</label>
					</td>
					<td width="300">
						<select name="tipo" id="tipo" style="width:100%;">
							<option <?php if($Animal['tipo'] == 0) echo 'selected'?> value="0">Selecione um tipo</option>
							<option <?php if($Animal['tipo'] == 1) echo 'selected'?> value="1">Cachorro</option>
							<option <?php if($Animal['tipo'] == 2) echo 'selected'?> value="2">Gato</option>
							<option <?php if($Animal['tipo'] == 3) echo 'selected'?> value="3">Outro</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="raca">Raça:</label>
					</td>
					<td width="300">
						<input name="raca" type="text" id="raca" style="width:100%;" maxlength="25" <?php echo 'value="'.$Animal['raca'].'"'?> />
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="idade">Idade:</label>
					</td>
					<td width="300">
						<select name="idade" type="text" id="idade" style="width:100%;">
							<option <?php if($Animal['idade'] == 1) echo 'selected'?> value="1">Até 1 mes</option>
							<option <?php if($Animal['idade'] == 2) echo 'selected'?> value="2">De 1 mes até 6 meses</option>
							<option <?php if($Animal['idade'] == 3) echo 'selected'?> value="3">De 6 meses até 1 ano</option>
							<option <?php if($Animal['idade'] == 4) echo 'selected'?> value="4">Mais de 1 ano</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="nome">Nome:</label>
					</td>
					<td width="300">
						<input name="nome" type="text" id="nome" style="width:100%;" maxlength="30" <?php echo 'value="'.$Animal['nome'].'"'?>/>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="descricao">Descrição:</label>
					</td>
					<td width="300">
						<textarea name="descricao" type="text" id="descricao" style="width:100%;" maxlength="400" rows="3"><?php echo $Animal['descricao']?></textarea>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="descricao">Adotado por:</label>
					</td>
					<td width="300">
						<select name="adotado" id="adotado" style="width:100%;">
							<option value="-1">Ninguem</option>
							<?php
							$selectUsuarios = "SELECT * FROM usuario";
							$result = mysql_query($selectUsuarios) or die("Erro ao listar os usuários!");
							while ($rowUsuarios = mysql_fetch_assoc($result)) {
								if($rowUsuarios['idusuario'] == $Animal['adotado_por'])
									$check = 'selected';
								else
									$check = '';
								echo '<option value="'.$rowUsuarios['idusuario'].'" '.$check.'>'.$rowUsuarios['nome'].'</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="file">Foto atual:</label>
					</td>
					<td width="300">
						<img src="upload/pet/<?php echo $Animal['foto']?>" >
					</td>
				</tr>
				<tr>
					<td width="100" align="right">
						<label for="file">Foto:</label>
					</td>
					<td width="300">
						<input name="file" type="file" id="file" style="width:100%;"/>
					</td>
				</tr>
				<tr>
					<td><input type="hidden" name="update" value="1" /></td>
					<td align="center">
						<input name="submit" type="submit" onclick="" class="Buttons" id="submit" value="Salvar" />
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
