<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<link href="css/relatorios.css" rel="stylesheet" type="text/css" />
<title>Administração</title>
</head>

<body>
<?php require "topo.php"; header('Content-Type: text/html; charset=UTF-8'); ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if(@$_GET['tipo'] == 'alunos'){ ?>
<h1>Relatório de alunos</h1> 
<?php if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$serie = $_POST['turma'];

$s = base64_encode('filtro');

echo "<script language='javascript'>window.location='relatorios.php?tipo=alunos&s=$s&status=$tipo&turma=$serie';</script>";

}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table class="users" id="table-responsive" border="0">
  <tr>
    <td ><strong>Status</strong></td>
    <td ><strong>Turma</strong></td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td><select name="tipo" size="1" id="select">
      <?php if(isset($_GET['status'])){?> <option value="<?php echo $_GET['status']; ?>"><?php echo $_GET['status']; }?></option>
      <option value="Ativo">Alunos Ativos</option>
      <option value="Inativo">Alunos Inativos</option>
    </select></td>
    <td>
      <select name="turma" id="select2">
      <?php if(isset($_GET['turma'])){
        $t=$_GET['turma'];
        ?> <option value="<?php echo $_GET['turma']; ?>"><?php $sql_2 = mysqli_query($conexao, "SELECT curso FROM cursos where id_cursos='$t'");
	  	   while($res_2 = mysqli_fetch_assoc($sql_2)){ echo $res_2['curso'];}}?></option>
      <?php
      $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos");
	  	while($res_2 = mysqli_fetch_assoc($sql_2)){
	  ?>
       <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso']; ?></option>      
       <?php } ?>
      </select>
    </td>
    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
</table>
</form>

<?php 
$s = base64_decode($_GET['s']);
if($s=='pesquisa'){ $s="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where nome!='' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
  $tipo="";
  $serie="";
}else{
  $tipo=$_GET['status'];
  $serie=$_GET['turma'];
  $s="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where c.id_cursos='$serie' and e.status='$tipo' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
}
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultados para o filtro selecionado";
}else{
?>
<table class="users" id="table-responsive"  border="0">

<tr>
    <th class="row-1 row-name"> <strong>Nome:</strong></th>
    <th class="row-2 row-name"><strong>Nº de matricula:</strong></th>
    <th class="row-3 row-name"><s<strong>Turma:</strong></th>
    <th class="row-4 row-job"><strong>Mensalidades pagas:</strong></th>
    <th class="row-4 row-ID"><strong>Mensalidade devedoras:</strong></th>
  </tr>
 
  <?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>
  <tr>
    <td class="row-cod"><?php echo $res_1['nome']; ?></td>
    <td class="row-name"><?php echo $res_1['matricula']; ?></td>
    <td class="row-name"><?php echo $res_1['curso']; ?></td>
    <td class="row-cod"><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['matricula']." AND status = 'Pagamento Confirmado'")); ?></td>
    <td class="row-job"><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['matricula']." AND status = 'Aguarda Pagamento'")); ?></td>
  </tr>
  <!-- <tr>
    <td colspan="5"></td>
  </tr> -->
  <?php } ?>
 
</table>
<div id="imprimir">
<a target="_blank" margin-left="10px" href="alunos_pg_impressao.php?s=<?php echo $_GET['s']; ?>&status=<?php echo $tipo;?>&turma=<?php echo $serie;?>">Imprimir relação completa do aluno</a>
</div>
<?php } ?>



<?php }// aqui fecha a pg alunos ?>



<?php if(@$_GET['tipo'] == 'professores'){ ?>
<h1>Relatório de professores</h1> 

<?php if(isset($_POST['button'])){

$tipo = $_POST['status'];
$serie = $_POST['turma'];

$sql_3 = mysqli_query($conexao, "SELECT * FROM professores WHERE status = '$tipo'");
if(mysqli_num_rows($sql_3) == ''){
echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=nao_encontrado';</script>";
}else{
	while($res_3 = mysqli_fetch_assoc($sql_3)){

$s = base64_encode("filtrar");

echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=$s&status=$tipo&turma=$serie';</script>";

}}}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table class="users" id="table-responsive" border="0">
<tr>
    <td width="267"><strong>Status</strong></td>
    <td width="248"><strong>Turma</strong></td>
    <td width="180">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="status" size="1" id="select">
      <?php if(isset($_GET['status'])){?> <option value="<?php echo $_GET['status']; ?>"><?php echo $_GET['status']; }?></option>
      <option value="Ativo">Professores Ativos</option>
      <option value="Inativo">Professores Inativos</option>
    </select></td>
    <td>
      <select name="turma" id="select2">
      <?php if(isset($_GET['turma'])){
        $t=$_GET['turma'];
        ?> <option value="<?php echo $_GET['turma']; ?>"><?php $sql_2 = mysqli_query($conexao, "SELECT curso,turno FROM cursos where id_cursos='$t'");
	  	   while($res_2 = mysqli_fetch_assoc($sql_2)){ echo $res_2['curso'].' ---> '. $res_2['turno'];}}?></option>
      <?php
      $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos order by curso asc");
	  	while($res_2 = mysqli_fetch_assoc($sql_2)){
	  ?>
       <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso'].' | '. $res_2['turno']; ?></option>      
       <?php } ?>
      </select>
    </td>
    <td><input class="input" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
  </table>
</form>

<?php

$s = base64_decode($_GET['s']);
if($s=='pesquisa'){ $s="SELECT * FROM professores p INNER JOIN disciplinas d on p.id_professores=d.id_professores INNER JOIN cursos c on c.id_cursos = d.id_cursos where nome!='' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
  $tipo="";
  $serie="";
}else{
  $tipo=$_GET['status'];
  $serie=$_GET['turma'];
  $s="SELECT * FROM professores p INNER JOIN disciplinas d on p.id_professores=d.id_professores INNER JOIN cursos c on c.id_cursos = d.id_cursos where p.status='$tipo' and c.id_cursos='$serie' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
}
if(mysqli_num_rows($sql_1) == '') { 
	
	echo "Não existe resultado para o filtro selecionado!";
}else{
?>
<table class="users" id="table-responsive"  border="0">

<tr>
    <th class="row-1 row-cod"><strong>Disciplina/Curso:</strong></th>
    <th class="row-2 row-email"><strong>Código:</strong></th>
    <th class="row-3 row-name"><strong>Nome</strong></th>
    <th class="row-4 row-job"><strong>Formação:</strong></th>
    <th class="row-4 row-ID"><strong>Salário:</strong></th>
  </tr>
 
<?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>  
  <tr>
    <td class="row-name"><?php
			echo $res_1['disciplina'];
			echo " - ";
			echo $res_1['curso'];
			
	?></td>
    <td class="row-email"><?php echo $res_1['code']; ?></td>
    <td class="row-email"> <?php
    $sql_1_extra = mysqli_query($conexao, "SELECT * FROM professores WHERE code = ".$res_1['code']."");
		while($res_extra = mysqli_fetch_assoc($sql_1_extra)){
	
	?>
    <?php echo $res_extra['nome']; ?></td>
    <td class="row-email"><?php echo $res_extra['formacao']; ?>/<?php echo $res_extra['graduacao']; ?></td>
    <td class="row-email">R$ <?php echo number_format($res_extra['salario'],2); ?></td>
  </tr>
 
  <?php } ?>
  <!-- <tr>
    <td colspan="6"><hr></td>
  </tr> -->
<?php } ?>  
  <!-- <tr>
   <td align="center" colspan="6"><a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa</a></td>
  </tr> -->
  
</table>

<div id="imprimir">   
<a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>&status=<?php echo $tipo;?>&turma=<?php echo $serie;?>">Imprimir relação completa</a>
</div> 

<?php } ?>


<?php }// aqui a fecha a pg professor ?>






</div><!-- box -->





<?php require "rodape.php"; ?>
</body>
</html>