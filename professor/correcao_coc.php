<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>COC</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
</head>

<?php require "topo.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $selec=$_GET['selec'];

}
else{
  
}


if(isset($_GET['deleta']) && ($_GET['deleta']=='sim')){
$idnota=$_GET['idNota'];
$deleta_nota="DELETE FROM notas_ava_coc where id_notas_ava_coc='$idnota'";
$deleta_nota=mysqli_query($conexao,$deleta_nota);
if($deleta_nota){
 echo "<script language='javascript'>window.location='correcao_coc.php?pg=coc&selec=$selec&id=$id';</script>";

}//fim se deleta
}


$busca_prova="SELECT id_disciplina from avaliacao_coc where id_ava_coc='$id'";
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
  
<div class="div-responsive">
<br>
<h1><a class="a3" rel="stylesheet" href="correcao_coc.php?pg=coc&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo segue a lista dos alunos desta disciplina:  <?php echo $disc."  ".$curso;?>.         <h1>LANÇAR NOTA COC:</h1></h1>

 
<?php

$sql_1 = "SELECT * FROM avaliacao_coc WHERE id_ava_coc = '$id'";
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_curso'];
		$professor = $res_1['professor'];
		$bimestre = $res_1['bimestre'];
    $ano=Date("Y");
		
$sql_2 = "SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' order by e.nome asc";
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
<table class="users" id="table-responsive" border="0">
  <tr>
    <td width="107">Código:</td>
    <td width="302">Nome do aluno:</td>
    <td width="200">D. aplicação:</td>
    <td width="144">Bimestre:</td>
    <td width="156">Nota:</td>
  </tr>
  <tr>
    <td><h3><?php echo $code_aluno = $res_2['matricula']; ?></h3></td>
    <td><h3><?php echo $res_2['nome']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>º</h3></td>
    
    <?php
    $sql_4 = "SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_atividade='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	if(mysqli_num_rows($result_4) == ''){
	?>
   
    <td><input name="nota" type="text" id="nota" size="6" disabled></td>
    <td><input type="submit" name="button" id="button" value="Concretizar" onclick="alert('Nota Inserida')"></td>

    <?php }else{ while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <td><h3><?php echo $res_4['nota']; ?></h3></td>
   <td><a href="alterar_nota_trabalho.php?pg=coc&id=<?php echo $res_4['id_atividade'];?>&aluno=<?php echo $res_2['matricula']; ?>&disciplina=<?php echo $res_1['id_disciplina']; ?>&bimestre=<?php echo $res_1['bimestre'];  ?>&professor=<?php echo $res_1['professor'];  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png"  width="30" border="0" title="Alterar a nota" /></a></td>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td><a href="correcao_coc.php?pg=coc&id=<?php echo $id; ?>&selec=<?php echo $selec; ?>&idNota=<?php echo $res_4['id_notas_ava_coc'];?>&deleta=sim"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>
    <?php }} ?>
  </tr>
</table>
</form>
<?php }}} ?>
</div>
</div><!-- box -->

<?php if(isset($_GET['button'])){

$code_aluno = $_GET['code_aluno'];
$nota = $_GET['nota'];
$bimestre = $_GET['bimestre'];
$disciplina = $_GET['disciplina'];
$date=Date('Y');

if(($nota>1)){
  ?>
  <script>
    alert('Nota Maxima 1.0 para este trabalho');
  </script>
  <?php
}else{


 $sql_3 = "INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$date')";
 mysqli_query($conexao, $sql_3);
 $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das avaliações COC estão sendo divulgadas','COC')";
mysqli_query($conexao, $sql_4);
 
 
 echo "<script language='javascript'>window.location='correcao_coc.php?pg=coc&selec=$selec&id=$id';</script>";

}
}?> 
<script>
       (function( $ ) {
            $(function() {
              //$("#date").mask("99/99/9999");
              //$("#phone").mask("(99) 999-9999");
              //$("#cep").mask("99.999-99");
              //$("#cpf").mask("99.999.999-99");
              $("#nota").mask("9.9");
              
              $("#nota").css('background', 'write');
              $('#nota').attr("disabled", false);              
              $('#nota').focus();
            });
          })(jQuery);
        </script>

<?php require "rodape.php"; ?>

<body>
</body>
</html>