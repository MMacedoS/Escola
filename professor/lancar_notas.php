<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Correçao de Prova</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:15%;
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

<?php require "topo.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $selec=$_GET['selec'];
  $professor=$code;
}
else{
  $id=$_POST['id'];
}
$busca_prova="SELECT * FROM `notas_bimestres` where id_disciplinas='$id'";
$con_busca=mysqli_query($conexao,$busca_prova);
while($res_busca=mysqli_fetch_assoc($con_busca)){
$disciplina=$res_busca['id_disciplinas'];}?>
<?php 
$buscaDis="SELECT *,l.nome,l.id_lista FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on l.id_lista=d.disciplina WHERE d.id_disciplinas='$id'";
$conDis=mysqli_query($conexao,$buscaDis);
while($resDis=mysqli_fetch_assoc($conDis)){
  $disc=$resDis['disciplina'];
  $curso=$resDis['curso'];
  $id_curso=$resDis['id_cursos'];
  $nomed=base64_encode($resDis['nome']);
}
 ?>
 <script>
 function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="lancar_notas.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
 
 </script>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<div id="box">
  <div class="div-responsive">
<br>
<h1><a class="a3" rel="stylesheet" href="lancar_notas.php?pg=notas&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a>
<?php if(@$_GET['busca']){
  echo '<a class="btn btn-sucess" rel="stylesheet" target="_blank" href="notas-bimestre.php?pg=notas&selec='.$selec.'&curso='.base64_encode(@$id_curso).'&id='.base64_encode($id).'&bimestre='.base64_encode($_GET['busca']).'&nomec='.base64_encode(@$curso).'&nomed='.@$nomed.'">Imprimir planilha</a>';
}?></h1>
<br>

<h1>Bimestre:
 <select name="busca" id="cooler">  <!--  Função para recarregar a página com o grupo escolhido  -->
  <?php 
      if(isset($_GET['busca'])){
      ?>
        <option value=""><?php echo $_GET['busca'];?></option>
      <?php
      }
  ?>
    
  <option value="">Selecione uma bimestre</option>
    
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
<input type="hidden" name="pg" value="notas">
<input type="hidden" name="id" value="<?php echo $id; ?>">
</h1>
<script>
$(document).ready(function(){
  $("#cooler").change(function(){
    if (parseInt($(this).val()) != -1){
      // armazena o valor do preco selecionado
      
      // compoe o texto que vai ser exibido
    
      res = $(this).val();
      
      
      // seta o num de cooler pra 1;
      
            
      // coloca o resultado na div
      $("#resultado").html(res);  
      refresh();  
         
    } else {
      // reseta o num de cooler;
      
      // reseta o resultado
      $("#resultado").html("");
    }
  })
})


</script>
 <h1>Abaixo, segue o Histórico Bimestral de médias dos alunos da Turma:  <?php echo $curso;?>. </h1>
<?php $res='<div id="resultado"/>';?>
 
<?php
if(isset($_GET['busca'])){
  $res=$_GET['busca'];
  $sql_1 = "SELECT * FROM `notas_bimestres` where id_disciplinas='$id' and bimestre=$res";
}else{
$sql_1 = "SELECT * FROM `notas_bimestres` where id_disciplinas='$id' and bimestre=1";
}
$result = mysqli_query($conexao, $sql_1);
	// while($res_1 = mysqli_fetch_assoc($result)){
	// 	$disciplinas = $res_1['id_disciplinas'];
	// 	$aluno = $res_1['code'];
	// 	$bimestre = $res_1['bimestre'];
  //   $nota=$res_1['nota'];
  //   $ano=Date("Y");
		
// $sql_2 = "SELECT e.nome,e.matricula,c.curso,d.disciplina,d.id_disciplinas FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes inner JOIN cursos c on c.id_cursos=ce.id_cursos INNER JOIN disciplinas d on d.id_cursos=c.id_cursos WHERE d.id_disciplinas ='$disciplinas' and ce.ano_letivo='$ano' and e.status='Ativo'";
// $result_2 = mysqli_query($conexao, $sql_2);
if(mysqli_num_rows($result) == ''){
	echo "<h3>Nenhuma média disponível neste curso</h3>";
}else{
		while($res_2 = mysqli_fetch_assoc($result)){
?> 
 
<form name="" method="get" action="" enctype="multipart/form-data">
<input type="hidden" name="bimestre" value="<?php echo $res_2['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_2['id_disciplinas']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="selec" value="<?php echo $selec; ?>" />
<table id="customers" border="0">
  <tr>
      <!-- while estudante -->
      <?php
      $code_aluno = $res_2['code'];
      $busca_aluno="SELECT nome, matricula FROM estudantes WHERE matricula='$code_aluno' and status='Ativo' ORDER BY nome asc";
      $con_aluno=mysqli_query($conexao,$busca_aluno);
      while($res_aluno=mysqli_fetch_assoc($con_aluno)){
        
        ?>


    <th>Aluno:</th>
    <th>Disciplinas:</th>
    <th>Bimestre:</th>
    <th>Nota:</th>
    
  </tr>
  <tr>
    <td><h3>
        <?php
       echo $res_aluno['nome'];
       

      }?></h3></td>
    <td><h3><?php $disc=$res_2['id_disciplinas'];
       $busca_dis="SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$disc'";
      $con_dis=mysqli_query($conexao,$busca_dis);
      while($res_disc=mysqli_fetch_assoc($con_dis)){
        echo $nomed=$res_disc['nome'];
      }
  
     ?></h3></td>    
    <td><h3><?php echo $bimestre = $res_2['bimestre']; ?>º</h3></td>
    
    <?php
    $sql_4 = "SELECT * FROM notas_bimestres WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplinas='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	 while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <?php if($res_4['nota']>=7){ ?>
    <td bgcolor="#58FA58" align="center"><font><h3><?php echo $res_4['nota']; ?></h3></font></td>
   
   <?php }else{?>
    <td bgcolor="#FA5858" align="center"><font><h3><?php echo $res_4['nota']; ?></h3></font></td>
    <?php if($res_4['bimestre']==4){
    }else{ ?>
    </tr>
    <tr>
   <td align="center"><a href="alterar_nota_trabalho.php?pg=ponto_extra&selec=<?php echo $selec;?>&id=<?php echo $res_4['id_disciplinas'];?>&aluno=<?php echo $res_2['code']; ?>&disciplina=<?php echo $res_2['id_disciplinas']; ?>&bimestre=<?php echo $res_2['bimestre'];  ?>&professor=<?php echo $code;  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
    <td><a target="_blank" href="lancar_notas.php?pg=notas&selec=<?php echo $selec;?>&id=<?php echo $res_4['id_disciplinas'];?>&info" >Inserir conselho</a></td>
   
    <?php } //if bimestre
  }// if nota
  }/// while result
  }/// if result  ?>
  </tr>
</table>
</form>
<?php } ?>
</div>
</div><!-- box -->

<?php if(isset($_GET['button'])){

$code_aluno = $_GET['code_aluno'];
$nota = $_GET['nota'];
$bimestre = $_GET['bimestre'];
$disciplina = $_GET['disciplina'];
$prova = $_FILES['prova']['name'];
$date=Date('Y');
if(file_exists("../trabalhos_alunos/$prova")){
	$a = 1;
	while(file_exists("../trabalhos_alunos/[$a]$prova")){
	$a++;
  }
  	$prova = "[".$a."]".$prova;
 }

 $sql_3 = "INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$prova')";
 mysqli_query($conexao, $sql_3);
$sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das atividades estão sendo divulgadas','tarefas')";
mysqli_query($conexao, $sql_4);
 (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
 
 echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";

}?> 
<?php if(isset($_GET['info'])){
  echo "<script>alert('Em breve esta pagina estará disponivel');</script>";
}?>
<?php require "rodape.php"; ?>

<body>
</body>
</html>