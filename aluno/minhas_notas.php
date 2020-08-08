<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Minhas Notas</title>
<link rel="shortcut icon" href="../image/logo.png">
<link rel="stylesheet" type="text/css" href="css/minhas_notas.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       .customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        .text-overflow-dynamic-container {
    position: relative;
    max-width: 100%;
    padding: 0 !important;
    display: -webkit-flex;
    display: -moz-flex;
    display: flex;
    vertical-align: text-bottom !important;
}
.text-overflow-dynamic-ellipsis {
    position: absolute;
    white-space: nowrap;
    overflow-y: visible;
    overflow-x: hidden;
    text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    max-width: 100%;
    min-width: 0;
    width:100%;
    top: 0;
    left: 0;
}
.text-overflow-dynamic-container:after,
.text-overflow-dynamic-ellipsis:after {
    content: '-';
    display: inline;
    visibility: hidden;
    width: 0;
}

        .diminuir {
          display: block;
          white-space: normal;
          overflow: hidden;
          text-overflow: ellipsis;
          height: 40px;          
          
        }
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        .customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .customers th {
            width:10%;
        }
        textarea {
            width: 100%!important;
            height: 50px!important;
            padding: 10px!important;
            
        }
        
        .customers tr:nth-child(even){background-color: #f2f2f2;}
        
        .customers tr:hover {background-color: #ddd;}
        
        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
<?php require "topo.php"; $data=date('Y');?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'trabalhos'){ ?>
<h1><strong>Notas da 1ª avaliação das avaliação em cada bimestre</strong></h1>
<table class="customers" height="400" border="0">
  <tr>
    <th rowspan="2" ><strong>DISCIPLINA<br /><br /></strong></th>
	<th colspan="4"><strong>BIMESTRES<br /><br /></strong></th>
	</tr>
	<tr>
    <th ><strong>1º </strong></th>
    <th><strong>2º </strong></th>
    <th ><strong>3º </strong></th>
    <th ><strong>4º </strong></th>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['id_disciplinas'];
		$nomedisciplina=$res_1['nome'];

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
  
<?php } ?>
</table>
<h4>OBS: Esta nota é obtida através das atividades que o professor passou em aula !</h4>
<?php } ?>


<?php if($_GET['pg'] == 'provas'){ ?>
<h1><strong>Notas da 4ª Avaliação em cada bimestre</strong></h1>
<table class="customers" height="400" border="0">
  <tr>
    <th rowspan="2" ><strong>DISCIPLINA<br /><br /></strong></th>
	<th colspan="4"><strong>BIMESTRES<br /><br /></strong></th>
	</tr>
	<tr>
    <th ><strong>1º </strong></th>
    <th><strong>2º </strong></th>
    <th ><strong>3º </strong></th>
    <th ><strong>4º </strong></th>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
$result_1 = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['nome'];
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
  
</table>
<h4>OBS: Esta nota que você tirou em cada prova de cada bimestre!</h4>
<?php } ?>
<!-- coc -->
<?php if($_GET['pg'] == 'coc'){ ?>
<h1><strong>Notas 2ª Avaliação em cada bimestre</strong></h1>
<table class="customers" height="400" border="0">
  <tr>
    <th rowspan="2" ><strong>DISCIPLINA<br /><br /></strong></th>
	<th colspan="4"><strong>BIMESTRES<br /><br /></strong></th>
	</tr>
	<tr>
    <th ><strong>1º </strong></th>
    <th><strong>2º </strong></th>
    <th ><strong>3º </strong></th>
    <th ><strong>4º </strong></th>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['nome'];
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
  
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>
<!-- fim coc -->
<!-- teste -->
<?php if($_GET['pg'] == 'teste'){ ?>
<h1><strong>Notas da 3ª Avaliação em cada bimestre</strong></h1>
<table class="customers" height="400" border="0">
  <tr>
    <th rowspan="2" ><strong>DISCIPLINA<br /><br /></strong></th>
	<th colspan="4"><strong>BIMESTRES<br /><br /></strong></th>
	</tr>
	<tr>
    <th ><strong>1º </strong></th>
    <th><strong>2º </strong></th>
    <th ><strong>3º </strong></th>
    <th ><strong>4º </strong></th>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
$result_1 = mysqli_query($conexao, $sql_1);		
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['nome'];
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
  
</table>
<h4>OBS: Esta nota é dada pelo seu professor de cada disciplina!</h4>
<?php } ?>
<!-- fim teste -->
<?php if($_GET['pg'] == 'distribuicao'){ ?>
<h1><strong>Suas notas bimestrais</strong></h1>
<form action="" method="POST">
<h1>Bimestre:

 <select name="busca" id="cooler" ONCHANGE="submit();" >  <!--  Função para recarregar a página com o grupo escolhido  -->
  <?php 
      if(isset($_POST['busca'])){
      ?>
        <option value=""><?php echo $_POST['busca'].' Unidade';?></option>
      <?php
      }
  ?>
    
  <option value="">Selecione</option>
    
  <?php   
    $selec_uni="SELECT * FROM unidades";
    $con_unidade=mysqli_query($conexao,$selec_uni);
    while($res_unidade=mysqli_fetch_assoc($con_unidade)){
      ?>
        <option value="<?php echo $res_unidade['unidade'];?>"><?php echo $res_unidade['unidade'];?></option>
    <?php
    }
  
  ?>

</select>
<input type="hidden" name="pg" value="distribuicao">
</h1>
</form>
<div class="table-responsive">
<table	class="customers" border="0">
  <tr>
    <th rowspan="2"><strong>DISCIPLINA<br /><br /></strong></th>
	<th colspan="7"><strong>ATIVIDADES</strong></th>
	</tr>
	<tr>
    <th><strong>1ª</strong></th>
    <th><strong>2ª</strong></th>	
    <th><strong>3ª</strong></th>
    <th><strong>4ª</strong></th>
    <th ><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><strong>Paralela</strong></span> </span></th>
    <th><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><strong>Media</strong></span> </span></th>	
    <th><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><strong>Situação</strong></span> </span></th>
	
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
$result_1 = mysqli_query($conexao, $sql_1);
	$uni=@$_POST['busca'];
	while($res_1 = mysqli_fetch_assoc($result_1)){
		$disciplina = $res_1['id_disciplinas'];

$sql_2 = "SELECT * FROM notas_atividades WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";
$result_2 = mysqli_query($conexao, $sql_2);
		
$sql_5 = "SELECT * FROM notas_ava_coc WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_5 = mysqli_query($conexao, $sql_5);

$sql_6 = "SELECT * FROM notas_ava_teste WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_6 = mysqli_query($conexao, $sql_6);

$sql_7 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_7 = mysqli_query($conexao, $sql_7);
$sql_7 = "SELECT * FROM notas_ava_prova WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_7 = mysqli_query($conexao, $sql_7);

$sql_para = "SELECT * FROM paralela WHERE code = '$code' AND id_disciplina = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_para = mysqli_query($conexao, $sql_para);
		
$sql_8 = "SELECT * FROM notas_bimestres WHERE code = '$code' AND id_disciplinas = '$disciplina' AND bimestre = '$uni' and ano_letivo='$data'";	
$result_8 = mysqli_query($conexao, $sql_8);
	
		
?>  
  <tr>
    <td><?php echo $res_1['nome'];; ?></td>  
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
				$nota = number_format($res_2['nota'],1);
				
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
				$nota = number_format($res_5['nota'],1);
				
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
				$nota = number_format($res_6['nota'],1);
				
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
				$nota = number_format($res_7['nota'],1);
				
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
    if(mysqli_num_rows($result_para) == ''){
		echo "<h3><strong>.</strong></h3>";
	}else{
		while($res_para = mysqli_fetch_assoc($result_para)){
				$nota = number_format($res_para['nota'],1);
				
				if($nota > 0){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>ND</strong></h3>";
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
				$nota = number_format($res_8['nota'],1);
				
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
		echo "<h2>Aguarade</h2>";
	}else{
						
				if($nota >= 7){
					echo "<h2><strong>APROVADO</strong></h2>";
				}else{
					echo "<h3><strong>REPROVADO</strong></h3>";
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
<table class="customers" border="0">
  <tr>
    <th rowspan="2"><strong>DISCIPLINA</strong></th>
	<th colspan="5"><strong>Bimestres</strong></th>
	</tr>
	<tr>
	<th align="center"><strong>1º</strong></th>
    <th><strong>2º</strong></th>
    <th><strong>3º</strong></th>
    <th><strong>4º</strong></th>
    <th><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><strong>Resultado</strong></span></span></th>
  </tr>
<?php
$sql_1 = "SELECT * FROM disciplinas d inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_cursos = '$serie' ORDER BY l.nome ASC";
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
    <td><?php echo $res_1['nome']; ?></td>  
    <td>
    <?php
    if(mysqli_num_rows($result_2) == ''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
				$nota = number_format($res_2['nota'],1);
				
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
				$nota = number_format($res_3['nota'],1);
				
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
				$nota = number_format($res_4['nota'],1);
				
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
				$nota = number_format($res_5['nota'],1);
				
				if($nota >= 7){
					echo "<h2><strong>$nota</strong></h2>";
				}else{
					echo "<h3><strong>$nota</strong></h3>";
				}
				
			}
	}?>
    </td>    
			<td><?php
    if(mysqli_num_rows($result_6)==''){
		echo "<h2>Aguarde</h2>";
	}else{
		while($res_6 = mysqli_fetch_assoc($result_6)){
				$nota = number_format($res_6['media'],1);
				
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
    <!-- <td colspan="6"><img src="img/menu_topo.png" width="900" height="1"></td> -->
  </tr>
</table>
<h4>OBS:arraste para o lado!</h4>
<h4>OBS 2: </h4>
<?php } ?>
</div><!-- box -->

</body>
</html>