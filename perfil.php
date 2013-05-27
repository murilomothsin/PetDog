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

if($_POST){
  $nome = "nome = '".mysql_escape_string($_POST['nome'])."',";
  $endereco = "endereco = '".mysql_escape_string($_POST['endereco'])."',";
  $cep = "cep = '".mysql_escape_string($_POST['cep'])."',";
  $telefone = "telefone = '".mysql_escape_string($_POST['telefone'])."',";
  $nascimento = "nascimento = '".inverte($_POST['nascimento'], "/", "-")."',";
  $email = "email = '".mysql_escape_string($_POST['email'])."'";
  if($_POST['senha'] != null){
    if($_POST['senha'] == $_POST['confirma_senha']){
      $senha = "senha = md5(".$_POST['senha'].")";
      $email = $email.",";
    }
  }else
    $senha = "";

  //Query de Update no banco
  $queryUpdate = "UPDATE usuario SET ".$nome."
                                    ".$endereco."
                                    ".$cep."
                                    ".$telefone."
                                    ".$nascimento."
                                    ".$email."
                                    ".$senha."
                                    WHERE idusuario = ".$_SESSION['idusuario'];
  $result = mysql_query($queryUpdate) or die("Erro ao salvar informações do usuário!");
  unset($_POST);
  header("Location: perfil.php?update=1");
}

$queryUsuario = "SELECT * FROM usuario WHERE idusuario = ".$_SESSION['idusuario']." LIMIT 1";
$result = mysql_query($queryUsuario);
$rowUsusario = mysql_fetch_assoc($result);

$queryAnimal = "SELECT * FROM animal WHERE doador = ".$_SESSION['idusuario'];
$result = mysql_query($queryAnimal);
while($rowAnimal = mysql_fetch_assoc($result)){
  switch ($rowAnimal['tipo']) {
    case 1:
      $rowAnimal['tipo'] = 'Cachorro';
    break;
    case 2:
      $rowAnimal['tipo'] = 'Gato';
    break;
    case 3:
      $rowAnimal['tipo'] = 'Outro';
    break;
    
    default:
      $rowAnimal['tipo'] = 'Outro';
    break;
  }
  $Animal[] = $rowAnimal;
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
      <?php
      if(isset($_GET['update']) && $_GET['update'] == 1){
        ?>
        <center><h3>Perfil alterado com sucesso!</h3></center>
        <br />
        <?php
      }
      ?>
      <h1 class="title">Alterar Perfil</h1>
      <form name="perfil" id="perfil" method="post" enctype="multipart/form-data">
        <table width="400">
          <tr>
            <td width="100" align="right">
              <label for="nome">Nome:</label>
            </td>
            <td width="300">
              <input name="nome" type="text" id="nome" style="width:100%;" maxlength="200" value="<?php echo $rowUsusario['nome']; ?>" />
            </td>
          </tr>
          <tr>
            <td width="100" align="right">
              <label for="endereco">Endereço:</label>
            </td>
            <td width="300">
              <input name="endereco" type="text" id="endereco" style="width:100%;" maxlength="250" value="<?php echo $rowUsusario['endereco']; ?>"/>
            </td>
          </tr>
          <tr>
            <td width="100" align="right">
              <label for="cep">CEP:</label>
            </td>
            <td width="300">
              <input name="cep" type="text" id="cep" style="width:100%;" maxlength="8" value="<?php echo $rowUsusario['cep']; ?>"/>
            </td>
          </tr>
          <tr>
            <td width="100" align="right">
              <label for="telefone">Telefone:</label>
            </td>
            <td width="300">
              <input name="telefone" type="text" id="telefone" style="width:100%;" maxlength="12" value="<?php echo $rowUsusario['telefone']; ?>"/>
            </td>
          </tr>
          <tr>
            <td width="100" align="right">
              <label for="nascimento">Data de Nascimento:</label>
            </td>
            <td width="300">
              <input name="nascimento" type="text" id="nascimento" style="width:100%;" maxlength="10" value="<?php echo formatDate($rowUsusario['nascimento']); ?>"/>
            </td>
          </tr>
          <tr>
            <td width="100" align="right">
              <label for="email">E-mail:</label>
            </td>
            <td width="300">
              <input name="email" type="text" id="email" style="width:100%;" maxlength="25" value="<?php echo $rowUsusario['email']; ?>"/>
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
              <input name="submit" type="submit" onclick="" class="Buttons" id="submit" value="Salvar" />
            </td>
          </tr>
        </table>
      </form>
    </div>
    <div class="post">
      <h2 class="title">Animais Cadastrados:</h2>
      <table width="550" class="tabelaAnimal" border="1">
        <tr>
          <td align="center">Nome</td>
          <td align="center">Tipo</td>
          <td align="center">Adicionado</td>
          <td align="center">Ações</td>
        </tr>
        <?php
        foreach ($Animal as $key => $value) {
          if($value['adotado_por']){
            $classTR = 'adotado';
          }else
            $classTR = 'nadotado';
        ?>
        <tr class="<?php echo $classTR; ?>">
          <td align="center"><?php echo $value['nome']?></td>
          <td align="center"><?php echo $value['tipo']?></td>
          <td align="center"><?php echo $value['adicionado']?></td>
          <td align="center"><a href="editaAnimal.php?acao=edit&id=<?php echo $value['idanimal']?>">E</a> <a href="">D</a></td>
        </tr>
        <?php
        }
        ?>
      </table>
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
