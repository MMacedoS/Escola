<?php $painel_atual = "professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Prova</title>
<?php require_once "../config.php"; ?>
<?php  $date = date("d/m/Y H:i:s"); $code = $_GET['code']; $id = $_GET['id']; ?>
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
</head>

<body>

<div id="box">
<?php

$sql_5 = "SELECT * FROM avaliacao_prova WHERE id_ava_prova = '$id'";
$result_5 = mysqli_query($conexao, $sql_5);
	while($res_5 = mysqli_fetch_assoc($result_5)){
  $curso=$res_5['id_curso'];
?>
 <form name="send" method="post" action="" enctype="multipart/form-data">	
	
<table border="0">
  <tr>
    <td width="272">Disciplina</td>
    <td>Bimestre:</td>
    <td width="216">Data de aplicação da Avaliação</td>
  </tr>
  <tr>
    <td>
      <select name="dis" id="dis">
      <option value="<?php echo $dis = $res_5['id_disciplina']; ?>"><?php $disci = $res_5['id_disciplina']; 
      $busDis="SELECT * FROM disciplinas where id_disciplinas='$disci'";
      $conDis=mysqli_query($conexao,$busDis);
      while($resDis=mysqli_fetch_assoc($conDis)){
        echo $resDis['disciplina'];
      }
      ?></option>
      <option value=""></option>
      <?php
      $sql_busca_nome="select nome,id_professores from professores where code='$code'";
    $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=mysqli_fetch_assoc($con_busca_nome)){
      
       $id_professor=$res_busca_nome['id_professores'];
       $ano_letivo=date("Y");
       }

      $sql_1 = "SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos WHERE id_professores='$id_professor'";
	  $result_1 = mysqli_query($conexao, $sql_1);
	  	while($res_1 = mysqli_fetch_assoc($result_1)){
	  ?>
      <option value="<?php echo $res_1['id_disciplinas']; ?>"><?php echo $res_1['disciplina']." <|> ".$res_1['curso']; ?></option>
      <?php } ?>
      </select>
      </td>
    <td><select name="bimestre" size="1">
      <option value="<?php echo $res_5['bimestre']; ?>"><?php echo $res_5['bimestre'];?>&ordm Bimestre</option>

      <option value=""></option>
      <?php
      $buscaBi="SELECT * FROM unidades";
      $conBi=mysqli_query($conexao,$buscaBi);
      while($resBi=mysqli_fetch_assoc($conBi)){
       ?>
      <option value="<?php echo $resBi['unidade'];?>"><?php echo $resBi['unidade'];?>&ordm; Bimestre</option>
      <?php } ?>
    </select></td>
    <td><input type="text" name="aplicacao" value="<?php echo $res_5['data_aplicacao']; ?>"></td>
  </tr> 
  <tr>
    <td>Informações adicionais:</td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="detalhes" cols="" rows=""><?php echo $res_5['detalhes']; ?></textarea></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
  </form>
<?php } ?> 

<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$aplicacao = $_POST['aplicacao'];
$detalhes = $_POST['detalhes'];


$sql_3 = "UPDATE avaliacao_prova SET id_curso='$curso',id_disciplina = '$dis', detalhes = '$detalhes', bimestre = '$bimestre', data_aplicacao = '$aplicacao' WHERE id_ava_prova = '$id' ";
mysqli_query($conexao, $sql_3);
$sql_4 = "UPDATE mural_aluno (date, curso, titulo,origem) VALUES ('$date','$curso', 'As notas das Avaliação  estão sendo divulgadas','Prova')";
mysqli_query($conexao, $sql_4);		
echo "Este projeto foi atualizada no sistema com sucesso!<br>Aparte em F5 em seu teclado.";

die;		

}?>
</div><!-- box -->

</body>
</html>