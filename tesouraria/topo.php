<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tesouraria</title>

<?php require "../config.php"; require "../gerador_cobranca.php"; ?>

<link href="css/topo.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />

<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
	<script type="text/javascript">

		$(function(){

			$.superbox.settings = {

				closeTxt: "Fechar",

				loadTxt: "Carregando...",

				nextTxt: "Next",

				prevTxt: "Previous"

			};

			$.superbox();

		});

	</script>
</head>

<body>

<div id="cobre_tudo">
<div id="box_topo">
 
 <div id="logo">
  <a href="index.php"><img border="0" src="../image/logo.png" width="300" /></a>
 </div><!-- logo -->
 
 <div id="campo_busca">
  <form name="search" method="post" action="" enctype="multipart/form-data">
   <input type="text" name="key" /><input class="input" type="submit" name="search" value="" />
  </form>
  
 
 
 <?php if(isset($_POST['search'])){
  
  $key = $_POST['key'];
  if($key == ''){
	  echo "<script language='javascript'>window.alert('Por favor, informe o número da cobrança ou o número de matricula!');</script>";
  }else{
	  $sql_1 = "SELECT m.*, e.nome FROM mensalidades m INNER JOIN estudantes e on m.matricula=e.matricula WHERE (e.matricula = '$key' or e.cpf='$key') and m.status='Aguarda Pagamento' limit 1";
	  $result_1 = mysqli_query($conexao, $sql_1);
	while($res_mens=mysqli_fetch_assoc($result_1)){
		$nome_aluno=$res_mens['nome'];
		$key=$res_mens['matricula'];
	}
	  if(mysqli_num_rows($result_1) >=1){
   			echo "<script language='javascript'>window.location='mostrar_mensalidade.php?mensalidade=$key&status=mostra_fatura&nome=$nome_aluno';</script>";		
	  }else{
	  $sql_2 = "SELECT * FROM estudantes WHERE matricula = '$key' OR nome = '$key' OR cpf = '$key'";
	  $result_2 = mysqli_query($conexao, $sql_2);
	  if(mysqli_num_rows($result_2) >= 1){
		  while($res_2 = mysqli_fetch_assoc($result_2)){	
			  $code_aluno = $res_2['matricula'];
			  $nome_aluno=$res_2['nome'];
	   echo "<script language='javascript'>window.location='mostrar_aluno.php?matricula=$code_aluno';</script>";	
		  }
	  }else{
	   echo "<script language='javascript'>window.alert('Não foi encontrado nenhum resultado, verifique a informação digitada!');</script>";  
		  
  
  }}}}?>
 
 
 
 </div><!-- campo_busca -->
 
 <div id="mostra_login">
  <h1><strong>Seja Bem Vindo <?php echo $nome = $_SESSION['nome']; ?></strong> <strong><a href="../config.php?acao=quebra">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->

</div><!-- cobre_tudo -->

</body>
</html>