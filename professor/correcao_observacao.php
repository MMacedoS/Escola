<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Correçao de Pesquisas</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
</head>

<?php require "topo.php";
$id = $_GET['id'];
$busca_prova="select disciplina from atividade_complementar where id='$id'";
$con_busca=mysqli_query($conexao,$busca_prova);
while($res_busca=mysqli_fetch_assoc($con_busca)){
$disciplina=$res_busca['disciplina'];}
 ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<div id="box">
<br>
<h1><a class="a3" rel="stylesheet" href="correcao_observacao.php?pg=observacoes&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo segue a lista dos alunos desta disciplina:  <?php echo $disciplina;?>!</h1>

 
<?php

$id = $_GET['id'];
$sql_1 = "SELECT * FROM atividade_complementar WHERE id = '$id'";
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['curso'];
		$professor = $res_1['professor'];
		$bimestre = $res_1['bimestre'];
		
$sql_2 = "SELECT * FROM estudantes WHERE serie = '$curso'";
$result_2 = mysqli_query($conexao, $sql_2);
if(mysqli_num_rows($result_2) == ''){
	echo "<h2>Nem um aluno cadastrado neste curso</h2>";
}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
?> 
 
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
<table class="users" id="table-responsive" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="200">D. aplicação:</td>
    <td width="144">Bimestre:</td>
    <td width="156">Nota:</td>
  </tr>
  <tr>
    <td><h3><?php echo $code_aluno = $res_2['code']; ?></h3></td>
    <td><h3><?php echo $res_2['nome']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>º</h3></td>
    <?php
    $sql_4 = "SELECT * FROM notas_observacao WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_observa='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	if(mysqli_num_rows($result_4) == ''){
	?>
    
    <td><input name="nota" type="text" id="textfield" size="6"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>
    <?php }else{ while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    
    <td><h3><?php echo $res_4['nota']; ?></h3></td>
   <td><a href="alterar_nota_trabalho.php?pg=observacao&id=<?php echo $res_4['id']; ?>&aluno=<?php echo $res_2['code']; ?>&disciplina=<?php echo $res_1['disciplina']; ?>&bimestre=<?php echo $res_1['bimestre'];  ?>&professor=<?php echo $res_1['professor'];  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
    <?php }} ?>
  </tr>
</table>
</form>
<?php }}} ?>
</div><!-- box -->

<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$bimestre = $_POST['bimestre'];
$disciplina = $_POST['disciplina'];


 $sql_3 = "INSERT INTO notas_observacao (code, bimestre, disciplina, nota, id_observa) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', '$id')";
 mysqli_query($conexao, $sql_3);
 
 
 
 echo "<script language='javascript'>window.location='correcao_observacao.php?pg=observacoes&id=$id';</script>";

}?> 

<?php require "rodape.php"; ?>

<body>
</body>
</html>