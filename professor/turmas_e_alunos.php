<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!---<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />--->

<link rel="shortcut icon" href="../image/logo_ist.gif">
</head>

<body>
<?php require_once "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<h1>Abaixo mostra seu histórico de disciplinas e alunos!</h1>
<?php

 $sql_1 = "SELECT * FROM disciplinas WHERE id_professores = '$id_professor'";
 $result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	echo "Você não ministra nenhuma disciplina!";
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_cursos'];
?>	
 <table width="955" border="0">
  <tr>
    <td width="400"><strong>Disciplina ministrada:</strong> <?php echo $res_1['disciplina']; ?></td>
    <td width="300"><strong>Total de alunos desta disciplina:</strong><?php 
	$sql_2 = "SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$curso'";
	echo mysqli_num_rows(mysqli_query($conexao, $sql_2)); ?></td>
    <td width="123">
    
    <button id="button" type="button" color="red" onclick="window.location='fazer_chamada.php?curso=<?php echo base64_encode($res_1['id_cursos']); ?>&dis=<?php echo base64_encode($res_1['id_disciplinas']); ?>'">Realizar Chamada</button>
    
    </td>
  </tr>
 </table>	
<?php }} ?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>