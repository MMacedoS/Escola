<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>Presenças</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/precesencas.css"/>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1><strong>Frequência Escolar</strong></h1>
<table class="users" id="table-responsive" border="1">
  <tr>
    <td align="center" colspan="5">Frequência geral nas disciplinas e nos bimestres</td>
  </tr>
  
  <tr>
    <td><strong>DISCIPLINA</strong></td>
    <td><strong>Total de presença</strong></td>
    <td><strong>Total de faltas</strong></td>
    <td><strong>Falta(s) Justificada</strong></td>
    <td><strong>Resultado</strong></td>
  </tr>
<?php
$ano=Date('Y');
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
  
?>  
  <tr>
    <td><?php echo $disciplina = $res_1['disciplina']; ?></td>
    <td><?php 
	$sql_2 = "SELECT * FROM chamadas_em_sala WHERE id_disciplinas = ".$res_1['id_disciplinas']." AND matricula = '$code' and ano_letivo='$ano' AND presente = 'SIM'";
	$result_2 = mysqli_query($conexao, $sql_2);
	$ver_result_2 = mysqli_num_rows($result_2);
	echo $ver_result_2; ?></td>
    <td><?php  $sql_3 = "SELECT * FROM chamadas_em_sala WHERE id_disciplinas = ".$res_1['id_disciplinas']." AND matricula = '$code' and ano_letivo='$ano' AND presente = 'FALTA'"; 
	$result_3 = mysqli_query($conexao, $sql_3);
	$ver_result_3 = mysqli_num_rows($result_3);
	echo $ver_result_3;
	?></td>
    <td><?php $sql_4 = "SELECT * FROM chamadas_em_sala WHERE id_disciplinas = ".$res_1['id_disciplinas']." AND matricula = '$code' and ano_letivo='$ano' AND presente = 'JUSTIFICADA'"; 
	$result_4 = mysqli_query($conexao, $sql_4);
	$ver_result_4 = mysqli_num_rows($result_4);
	echo $ver_result_4;
	?></td>
    <td>
    <?php
	$sql_5 = "SELECT * FROM chamadas_em_sala WHERE matricula='$code' and ano_letivo='$ano' and presente!='FALTA' and id_disciplinas =".$res_1['id_disciplinas'];
	$result_5 = mysqli_query($conexao, $sql_5);
	$conta_sql_5 = mysqli_num_rows($result_5);
	
	$total = ($conta_sql_5*25)/100;
	
	if($ver_result_3 >= $total){
		echo "Frequência baixa";
	}else{
		echo "Frequência OK";
		}
	
	?>    
    </td>
  </tr>
  
<?php } ?>  
</table> 

</div><!-- box -->

</body>
</html>