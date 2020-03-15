<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Correçao de Prova</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
</head>

<?php require "topo.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $selec=$_GET['selec'];

}
else{
  
}
$busca_prova="SELECT id_disciplina from projetos_transversal where id_pro_transversal='$id'";
$con_busca=mysqli_query($conexao,$busca_prova);
while($res_busca=mysqli_fetch_assoc($con_busca)){
$disciplina=$res_busca['id_disciplina'];}?>
<?php 
$buscaDis="SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos WHERE d.id_disciplinas='$disciplina'";
$conDis=mysqli_query($conexao,$buscaDis);
while($resDis=mysqli_fetch_assoc($conDis)){
  $disc=$resDis['disciplina'];
  $curso=$resDis['curso'];
}
 ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<div id="box">
<br>
<h1><a class="a3" rel="stylesheet" href="correcao_pro_trans.php?pg=projetos-transversal&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo segue a lista dos alunos desta disciplina:  <?php echo $disc."  ".$curso;?>.       <h1>LANÇAR NOTA PROJ. TRANSVERSAL:</h1></h1>

 
<?php

$sql_1 = "SELECT * FROM projetos_transversal WHERE id_pro_transversal = '$id'";
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_curso'];
		$professor = $res_1['professor'];
		$bimestre = $res_1['bimestre'];
    $ano=Date("Y");
		
$sql_2 = "SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano'";
$result_2 = mysqli_query($conexao, $sql_2);
if(mysqli_num_rows($result_2) == ''){
	echo "<h2>Nem um aluno cadastrado neste curso</h2>";
}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
?> 
 
<form name="" method="get" action="" enctype="multipart/form-data">
<input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_1['id_disciplina']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['matricula']; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="selec" value="<?php echo $selec; ?>" />
<table width="955" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="200">D. aplicação:</td>
    <td width="144">Bimestre:</td>
    <td width="200">Atividade:</td>
    <td width="156">Nota:</td>
  </tr>
  <tr>
    <td><h3><?php echo $code_aluno = $res_2['matricula']; ?></h3></td>
    <td><h3><?php echo $res_2['nome']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>º</h3></td>
    
    <?php
    $sql_4 = "SELECT * FROM notas_pro_transversal WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_atividade='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	if(mysqli_num_rows($result_4) == ''){
	?>
    <td><input type="file" name="prova" size="5" /></td>
    <td><input name="nota" type="text" id="textfield" size="6"></td>
    <td><input type="submit" name="button" id="button" value="Concretizar"></td>

    <?php }else{ while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <td><a target="_blank" href="../trabalhos_alunos/<?php echo $res_4['prova']; ?>">Ver prova</a></td>
    <td><h3><?php echo $res_4['nota']; ?></h3></td>
   <td><a href="alterar_nota_trabalho.php?pg=projetos_transversal&id=<?php echo $res_4['id_atividade'];?>&aluno=<?php echo $res_2['matricula']; ?>&disciplina=<?php echo $res_1['id_disciplina']; ?>&bimestre=<?php echo $res_1['bimestre'];  ?>&professor=<?php echo $res_1['professor'];  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
    <?php }} ?>
  </tr>
</table>
</form>
<?php }}} ?>
</div><!-- box -->

<?php if(isset($_GET['button'])){

$code_aluno = $_GET['code_aluno'];
$nota = $_GET['nota'];
$bimestre = $_GET['bimestre'];
$disciplina = $_GET['disciplina'];
$prova = $_FILES['prova']['name'];
$date=Date('Y');

if(($nota>1)){
  ?>
  <script>
    alert('Nota Maxima 1.0 para este trabalho');
  </script>
  <?php
}else{
if(file_exists("../trabalhos_alunos/$prova")){
	$a = 1;
	while(file_exists("../trabalhos_alunos/[$a]$prova")){
	$a++;
  }
  	$prova = "[".$a."]".$prova;
 }

 $sql_3 = "INSERT INTO notas_pro_transversal (code, bimestre, id_disciplina, nota, id_atividade,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$prova')";
 mysqli_query($conexao, $sql_3);
 $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das atividades Transversal estão sendo divulgadas','transversal')";
mysqli_query($conexao, $sql_4);
 
 (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
 
 echo "<script language='javascript'>window.location='correcao_pro_trans.php?pg=projetos_transversal&selec=$selec&id=$id';</script>";

}
}?> 

<?php require "rodape.php"; ?>

<body>
</body>
</html>