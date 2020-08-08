<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<!---<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />--->

<link rel="shortcut icon" href="../image/logo.png">
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers td {
            width:46%;
        }
        #button{
         
        margin: 0 0 0 0px !important;
        width: 60px !important;

        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
<?php require_once "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<h1>Abaixo, observa-se seu histórico de disciplinas e alunos!</h1>
<?php

 $sql_1 = "SELECT d.*,c.curso FROM disciplinas d inner join cursos c on c.id_cursos=d.id_cursos WHERE id_professores = '$id_professor' order by c.id_categoria asc";
 $result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	echo "Você não ministra nenhuma disciplina!";
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_cursos'];
?>	
 <table id="customers" border="0">
  <tr>
    <td><strong>Disciplina ministrada:</strong> <?php $b_disc=$res_1['disciplina'];
      $buscar_d="SELECT l.id_lista,l.nome,c.categoria FROM lista_disc l inner join categoria c on c.id_categoria=l.categoria where l.id_lista='$b_disc'";
      $busca_con=mysqli_query($conexao,$buscar_d);
      while($busca_r=mysqli_fetch_assoc($busca_con)){
        echo $busca_r['nome'];
        
    echo ' '.$res_1['curso']; 
    echo ' '.$busca_r['categoria'];  } ?></td>
    <td><strong>Total de alunos:</strong><?php 
	$sql_2 = "SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$curso'";
	echo mysqli_num_rows(mysqli_query($conexao, $sql_2)); ?></td>
    <td >
    
    <button id="button" type="button" color="red" onclick="window.location='fazer_chamada.php?selec=<?php echo @$_GET['selec'];?>&curso=<?php echo base64_encode($res_1['id_cursos']); ?>&dis=<?php echo base64_encode($res_1['id_disciplinas']); ?>'">Realizar Chamada</button>
    
    </td>
  </tr>
 </table>	
<?php }} ?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>