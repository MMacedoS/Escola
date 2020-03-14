﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro de Provas</title>
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
<?php require "../config.php"; $code; ?>
</head>

<body>

<div id="box">
<?php if($_GET['tipo'] == 'atividade_bimestral'){ ?>


<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$aplicacao = $_POST['aplicacao'];
$detalhes = $_POST['detalhes'];
$date = date("d/m/Y");
$ano_letivo=date("Y");

$sql_2 = "SELECT * FROM disciplinas WHERE id_disciplinas = '$dis'";
$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
		$curso = $res_2['id_cursos'];
		
$sql_3 = "INSERT INTO atividades_bimestrais (data, status, professor,id_curso, id_disciplina, detalhes, bimestre,ano_letivo, data_aplicacao)
 VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$detalhes', '$bimestre', '$ano_letivo','$aplicacao')";
mysqli_query($conexao, $sql_3);
		
$sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo,origem) VALUES ('$date', 'Ativo', '$curso', 'As notas das provas bimestrais estão sendo divulgadas','atividade avaliativa')";
mysqli_query($conexao, $sql_4);

echo "<script language='javascript'>window.alert('atividade cadastrada com sucesso! Click em OK para cadastrar outras!');window.location='cadastrar_atividades.php?tipo=atividade_bimestral';</script>";

die;		

}}?>

 <form name="send" method="post" action="" enctype="multipart/form-data">	
	
<table border="0">
  <tr>
    <td width="272">Disciplina</td>
    <td>Bimestre:</td>
    <td width="216">Data de aplicação da atividade</td>
  </tr>
  <tr>
    <td>
      <select name="dis" id="dis">
      <?php
      $sql_busca_nome="select nome,id_professores from professores where code='$code'";
    $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=mysqli_fetch_assoc($con_busca_nome)){
      
       $id_professor=$res_busca_nome['id_professores'];
       $ano_letivo=date("Y");
       }

      $sql_1 = "SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos WHERE id_professores='$id_professor'";
	  $result = mysqli_query($conexao, $sql_1);
	  	while($res_1 = mysqli_fetch_assoc($result)){
	  ?>
      <option value="<?php echo $res_1['id_disciplinas']; ?>"><?php echo $res_1['disciplina']." <|> ".$res_1['curso']; ?></option>
      <?php } ?>
      </select>
      </td>
    <td><select name="bimestre" size="1">
     <?php $buscaUnidade="SELECT * FROM unidades ";
     $conUnidade=mysqli_query($conexao,$buscaUnidade);
     while($resUnidade=mysqli_fetch_assoc($conUnidade)){
     ?>
      <option value="<?php echo $resUnidade['unidade'];?>"><?php echo $resUnidade['unidade'];?>&ordm; Bimestre</option>
     <?php } ?>
    </select></td>
    <td><input type="text" name="aplicacao" value="<?php echo date("d/m/Y"); ?>"></td>
  </tr> 
  <tr>
    <td>Informações adicionais:</td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="detalhes" cols="" rows=""></textarea></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </form>
<?php } ?>
</div><!-- box -->

</body>
</html>