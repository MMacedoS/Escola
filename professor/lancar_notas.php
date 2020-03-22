<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Correçao de Prova</title>
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
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
$buscaDis="SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos WHERE d.id_disciplinas='$id'";
$conDis=mysqli_query($conexao,$buscaDis);
while($resDis=mysqli_fetch_assoc($conDis)){
  $disc=$resDis['disciplina'];
  $curso=$resDis['curso'];
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
<br>
<h1><a class="a3" rel="stylesheet" href="lancar_notas.php?pg=notas&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
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
<p></p>
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
 <h1>Abaixo segue a lista das Medias dos alunos desta disciplina:  <?php echo $disc."  ".$curso;?>. </h1>
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
<input type="hidden" name="disciplina" value="<?php echo $res_2['id_disciplina']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['code']; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="selec" value="<?php echo $selec; ?>" />
<table width="955" border="0">
  <tr>
      <!-- while estudante -->
      <?php
      $code_aluno = $res_2['code'];
      $busca_aluno="SELECT nome, matricula FROM estudantes WHERE matricula='$code_aluno' and status='Ativo'";
      $con_aluno=mysqli_query($conexao,$busca_aluno);
      while($res_aluno=mysqli_fetch_assoc($con_aluno)){
        
        ?>


     <td width="302">Nome do aluno:</td>
    <td width="200">Disciplinas:</td>
    <td width="144">Bimestre:</td>
    <td width="200">Nota do Bimestre</td>
    <td width="100">Paralela</td>
    <td width="100">Conselho:</td>
    
  </tr>
  <tr>
    <td><h3>
        <?php
       echo $res_aluno['nome'];
       

      }?></h3></td>
    <td><h3><?php $disc=$res_2['id_disciplinas'];
       $busca_dis="SELECT disciplina FROM disciplinas WHERE id_disciplinas='$disc'";
      $con_dis=mysqli_query($conexao,$busca_dis);
      while($res_disc=mysqli_fetch_assoc($con_dis)){
        echo $res_disc['disciplina'];
      }
    
     ?></h3></td>    
    <td><h3><?php echo $bimestre = $res_2['bimestre']; ?>º</h3></td>
    
    <?php
    $sql_4 = "SELECT * FROM notas_bimestres WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplinas='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	 while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <?php if($res_4['nota']>=7){ ?>
    <td bgcolor="#58FA58" align="center"><font><h3><?php echo $res_4['nota']; ?></h3></font></td>
    <td bgcolor="#58FA58" align="center"></td>
    <td bgcolor="#58FA58" align="center"></td>
   <?php }else{?>
    <td bgcolor="#FA5858" align="center"><font><h3><?php echo $res_4['nota']; ?></h3></font></td>
    <?php if($res_4['bimestre']==4){
    }else{ ?>
   <td align="center"><a href="alterar_nota_trabalho.php?pg=ponto_extra&id=<?php echo $res_4['id_disciplinas'];?>&aluno=<?php echo $res_2['code']; ?>&disciplina=<?php echo $res_2['id_disciplinas']; ?>&bimestre=<?php echo $res_2['bimestre'];  ?>&professor=<?php echo $code;  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png" border="0" title="Alterar a nota" /></a></td>
    <td><a target="_blank" href="../trabalhos_alunos/<?php echo $res_4['code']; ?>">Inserir conselho</a></td>
   
    <?php } //if bimestre
  }// if nota
  }/// while result
  }/// if result  ?>
  </tr>
</table>
</form>
<?php } ?>
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

<?php require "rodape.php"; ?>

<body>
</body>
</html>