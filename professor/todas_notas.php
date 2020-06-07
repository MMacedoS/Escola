<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Provas</title>

<link rel="shortcut icon" href="../image/logo_ist.gif">
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if(isset($_GET['pg']) && $_GET['pg'] == 'notas'){
    $selec=$_GET['selec'];
 ?>
<!-- <div class="row" id="row_button">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_atividades.php?tipo=atividade_bimestral&code=<?php echo $id_professor; ?>">Cadastrar Atividade</a>
<br /><a class="a3" rel="stylesheet" href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $selec;?>">Atualizar Pagina</a>
</div> -->
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_notas.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>

<!--  -->
 <h1>Abaixo segue seu histórico de atividades bimestrais de suas turmas!</h1>
  <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['selec'])){
$ensino=$_GET['selec'];
if(isset($_GET['busca'])){
  $res=$_GET['busca'];
  $sql_1  = "SELECT DISTINCT * FROM disciplinas d INNER JOIN cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' ";

}else{
 $sql_1  = "SELECT DISTINCT * FROM disciplinas d INNER JOIN cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' and cat.categoria='$ensino' ";
}// fim if busca
 }else{

 $sql_1 = "SELECT DISTINCT * FROM disciplinas d INNER JOIN cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' and cat.categoria='$ensino'";
 }
$result = mysqli_query($conexao, $sql_1);

if(mysqli_num_rows($result)==''){
	 echo "<h2>No momento não existe nenhuma prova lançada no sistema!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table class="users" id="table-responsive" border="0">
  <tr>
    <td width="187">Disciplina</td>
    <td width="323">Curso</td>
    <td width="200">Quantidade de Aluno</td>
    <td></td>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
    <td><h3><?php echo $res_1['curso']; ?></h3></td>
    <td><h3><?php $DIS=$res_1['id_cursos'];
    $buscaDisc="SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$DIS' and e.status='ativo'";
    $conDisc=mysqli_query($conexao,$buscaDisc);
    echo mysqli_num_rows($conDisc);
    ?></h3></td>
    <td colspan="3"><a href="lancar_notas.php?pg=notas&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_disciplinas']; ?>"><font color="blue">Visualizar média</font></a></td>
   
  </tr>  
  </table> 
 
<?php }}}

if(isset($_GET['pg']  ) && $_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

// $sql_2 = "DELETE FROM atividades_bimestrais WHERE id = '$id'";
// mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_ativ_tarefas.php?pg=atividades_bimestrais'&selec=".$_GET['selec']."';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>