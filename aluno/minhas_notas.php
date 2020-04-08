<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Minhas Notas</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/minhas_notas.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
</head>

<body>
<?php require "topo.php"; $data=date('Y');?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'trabalhos'){ ?>
<h1><strong>Notas de Atividades e tarefas em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['id_disciplinas'];
		$nomedisciplina=$res_1['disciplina'];

$sql_2 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
$sql_3 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '2' and ano_letivo='$data'";
$result_3 = mysqli_query($conexao, $sql_3);
$sql_4 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
$sql_5 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);
		
?>
  <tr>
    <td><?php echo $nomedisciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
				$nota = $res_2['nota'];
				if($nota >= 7){
						echo "<h2><strong>$nota</strong></h2>";
				}else{
						echo "<h3><strong>$nota</strong></h3>";	
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
				$nota = $res_3['nota'];
				if($nota >= 7){
						echo "<h2><strong>$nota</strong></h2>";
				}else{
						echo "<h3><strong>$nota</strong></h3>";	
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
				$nota = $res_4['nota'];
				if($nota >= 7){
						echo "<h2><strong>$nota</strong></h2>";
				}else{
						echo "<h3><strong>$nota</strong></h3>";	
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
				$nota = $res_5['nota'];
				if($nota >= 7){
						echo "<h2><strong>$nota</strong></h2>";
				}else{
						echo "<h3><strong>$nota</strong></h3>";	
				}
				
			}
	}?>
    </td>
    </tr>
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
<?php } ?>
</table>
<h4>OBS: Esta nota é obtida através das atividades que o professor passou em aula !</h4>
<?php } ?>


<?php if($_GET['pg'] == 'provas'){ ?>
<h1><strong>Notas de suas provas em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['disciplina'];
		$id_disc=$res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);		
$sql_3 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '2' and ano_letivo='$data'";
$result_3 = mysqli_query($conexao, $sql_3);		
$sql_4 ="SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);			
$sql_5 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);		
?>  
  <tr>
    <td><?php echo $disciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
			$nota = $res_2['nota'];
			$prova = $res_2['prova'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_2['nota']."</strong>";
			}else{
				echo "<h3><strong>".$res_2['nota']."</strong>";			
			}
			if($res_2['prova'] == ''){
			}else{
			// echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2></h3>";
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
			$nota = $res_3['nota'];
			$prova = $res_3['prova'];
		
			if($nota >= 7){
				echo "<h2><strong>".$res_3['nota']."</strong>";
			}else{
				echo "<h3><strong>".$res_3['nota']."</strong></h3>";			
			}
			if($res_3['prova'] == ''){
			}else{
			// echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2>";
			}			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
			$nota = $res_4['nota'];
			$prova = $res_4['prova'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_4['nota']."</strong>";
			}else{
				echo "<h3><strong>".$res_4['nota']."</strong></h3>";			
			}
			if($res_4['prova'] == ''){
			}else{
			// echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2>";
			}			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
			$nota = $res_5['nota'];
			$prova = $res_5['prova'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_5['nota']."</strong>";
			}else{
				echo "<h3><strong>".$res_5['nota']."</strong></h3>";			
			}
			if($res_5['prova'] == ''){
			}else{
			// echo " | <a target='_blank' class='a5' href='../trabalhos_alunos/$prova'>Ver</a></h2>";
			}			
	}}?>
    </td>        
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Esta nota que você tirou em cada prova de cada bimestre!</h4>
<?php } ?>


<?php if($_GET['pg'] == 'inter'){ ?>
<h1><strong>Notas dos Projetos Interdisciplinar dada pelo professor em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['disciplina'];
		$id_disc=$res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_pro_inter WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_pro_inter WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '2' and ano_letivo='$data'";	
$result_3 = mysqli_query($conexao, $sql_3);
	
$sql_4 = "SELECT * FROM notas_pro_inter WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre ='3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		 
$sql_5 = "SELECT * FROM notas_pro_inter WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);
		
?>  
  <tr>
    <td><?php echo $disciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
			$nota = $res_2['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_2['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_2['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
			$nota = $res_3['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_3['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_3['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
			$nota = $res_4['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_4['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_4['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
			$nota = $res_5['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_5['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_5['nota']."</strong></h3>";			
			}
			
	}}?>
    </td>        
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>

<!-- projeto Trans -->
	<?php if($_GET['pg'] == 'trans'){ ?>
<h1><strong>Notas projetos Transversal dada pelo professor em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['disciplina'];
		$id_disc=$res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_pro_transversal WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_pro_transversal WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '2' and ano_letivo='$data'";	
$result_3 = mysqli_query($conexao, $sql_3);
	
$sql_4 = "SELECT * FROM notas_pro_transversal WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre ='3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		
$sql_5 = "SELECT * FROM notas_pro_transversal WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);
		
?>  
  <tr>
    <td><?php echo $disciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
			$nota = $res_2['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_2['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_2['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
			$nota = $res_3['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_3['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_3['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
			$nota = $res_4['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_4['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_4['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
			$nota = $res_5['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_5['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_5['nota']."</strong></h3>";			
			}
			
	}}?>
    </td>        
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>
<!-- fim nota  -->
<!-- coc -->
<?php if($_GET['pg'] == 'coc'){ ?>
<h1><strong>Notas do COC dada pelo professor em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['disciplina'];
		$id_disc=$res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '2' and ano_letivo='$data'";	
$result_3 = mysqli_query($conexao, $sql_3);
	
$sql_4 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre ='3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		
$sql_5 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '4'  and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);
		
?>  
  <tr>
    <td><?php echo $disciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
			$nota = $res_2['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_2['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_2['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
			$nota = $res_3['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_3['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_3['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
			$nota = $res_4['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_4['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_4['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
			$nota = $res_5['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_5['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_5['nota']."</strong></h3>";			
			}
			
	}}?>
    </td>        
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>
<!-- fim coc -->
<!-- teste -->
<?php if($_GET['pg'] == 'teste'){ ?>
<h1><strong>Notas dos Teste dada pelo professor em cada bimestre</strong></h1>
<table width="900" border="0">
  <tr>
    <td width="317"><strong>DISCIPLINA<br /><br /></strong></td>
    <td width="150"><strong>1º Bimestre</strong></td>
    <td width="150"><strong>2º Bimestre</strong></td>
    <td width="150"><strong>3º Bimestre</strong></td>
    <td width="150"><strong>4º Bimestre</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['disciplina'];
		$id_disc=$res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '2' and ano_letivo='$data'";	
$result_3 = mysqli_query($conexao, $sql_3);
	
$sql_4 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre ='3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		
$sql_5 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$id_disc' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);
		
?>  
  <tr>
    <td><?php echo $disciplina; ?></td>
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
			$nota = $res_2['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_2['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_2['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
			$nota = $res_3['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_3['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_3['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
			$nota = $res_4['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_4['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_4['nota']."</strong></h3>";			
			}
			
		}}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
			$nota = $res_5['nota'];
			
			if($nota >= 7){
				echo "<h2><strong>".$res_5['nota']."</strong></h2>";
			}else{
				echo "<h3><strong>".$res_5['nota']."</strong></h3>";			
			}
			
	}}?>
    </td>        
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>
<!-- fim teste -->
<?php if($_GET['pg'] == 'distribuicao'){ ?>
<h1><strong>Suas notas bimestrais</strong></h1>
<div class="table-responsive">
<table	class="table-responsive" border="0">
  <tr>
    <td><strong>DISCIPLINA<br /><br /></strong></td>
    <td><strong>A</strong></td>
    <td><strong>PI</strong></td>	
    <td><strong>PT</strong></td>
    <td><strong>COC</strong></td>
    <td><strong>T</strong></td>
    <td><strong>P</strong></td>
    <td><strong>Media</strong></td>	
    <td><strong>Situação</strong></td>
	
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['id_disciplinas'];

$sql_2 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_pro_inter WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";
$result_3 = mysqli_query($conexao, $sql_3);	

$sql_4 = "SELECT * FROM notas_pro_transversal WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		
$sql_5 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";	
$result_5 = mysqli_query($conexao, $sql_5);

$sql_6 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";	
$result_6 = mysqli_query($conexao, $sql_6);

$sql_7 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";	
$result_7 = mysqli_query($conexao, $sql_7);
	
$sql_8 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";	
$result_8 = mysqli_query($conexao, $sql_8);
	
		
?>  
  <tr>
    <td><?php echo $res_1['disciplina'];; ?></td>  
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
				$nota = number_format($res_2['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
				$nota = number_format($res_3['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
				$nota = number_format($res_4['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td>
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
				$nota = number_format($res_5['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
    <td>
	<?php
    if(mysqli_num_rows($result_6) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_6 = mysqli_fetch_assoc($result_6)){
				$nota = number_format($res_6['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
    <td>
	<?php
    if(mysqli_num_rows($result_7) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_7 = mysqli_fetch_assoc($result_7)){
				$nota = number_format($res_7['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
    
	<td>
	<?php
    if(mysqli_num_rows($result_8) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_8 = mysqli_fetch_assoc($result_8)){
				$nota = number_format($res_8['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
	 
  </tr>
<?php } ?>  
  <tr>
    
  </tr>
</table>
</div>
<h4>OBS: </h4>
<h4>OBS 2: </h4>
<?php } ?>

<?php if($_GET['pg'] == 'bimestrais'){ ?>
<h1><strong>Suas notas bimestrais</strong></h1>
<table class="table-responsive" border="0">
  <tr>
    <td class="td"><strong>DISCIPLINA</strong></td>
		<td class="td"><strong>1º Bimestre</strong></td>
    <td class="td"><strong>2º Bimestre</strong></td>
    <td class="td"><strong>3º Bimestre</strong></td>
    <td class="td"><strong>4º Bimestre</strong></td>
    <td class="td"><strong>Resultado</strong></td>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas WHERE id_cursos = '$serie'";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['id_disciplinas'];
		
$sql_2 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '1' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_3 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '2' and ano_letivo='$data'";	
$result_3 = mysqli_query($conexao, $sql_3);
	
$sql_4 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '3' and ano_letivo='$data'";
$result_4 = mysqli_query($conexao, $sql_4);
		
$sql_5 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '4' and ano_letivo='$data'";
$result_5 = mysqli_query($conexao, $sql_5);

$sql_6 = "SELECT * FROM resultado_final WHERE code = '$code' AND id_disciplinas = '$disciplina' and ano_letivo='$data'";
$result_6 = mysqli_query($conexao, $sql_6);
		
?>  
  <tr>
    <td class="td"><?php echo $res_1['disciplina']; ?></td>  
    <td class="td">
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
				$nota = number_format($res_2['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td class="td">
    <?php
    if(mysqli_num_rows($result_3) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_3 = mysqli_fetch_assoc($result_3)){
				$nota = number_format($res_3['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td class="td">
    <?php
    if(mysqli_num_rows($result_4) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_4 = mysqli_fetch_assoc($result_4)){
				$nota = number_format($res_4['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>
    <td class="td"> 
    <?php
    if(mysqli_num_rows($result_5) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_5 = mysqli_fetch_assoc($result_5)){
				$nota = number_format($res_5['nota'],2);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
			<td class="td"><?php
    if(mysqli_num_rows($result_6)==''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_6 = mysqli_fetch_assoc($result_6)){
				$nota = number_format($res_6['media'],2);
				
				if($nota >= 28){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?></td>
			
  </tr>
<?php } ?>  
  <tr>
    <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td>
  </tr>
</table>
<h4>OBS: Media</h4>
<h4>OBS 2: </h4>
<?php } ?>
</div><!-- box -->

</body>
</html>