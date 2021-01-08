<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Teste</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
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
              margin: 0 0 0 0!important;
              width: 60px!important;
              height: 29px!important;
          }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
            
            
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
        #customers th {
            width:32%;
            
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

}
else{
  
}



if(isset($_GET['deleta']) && ($_GET['deleta']=='sim')){
$idnota=$_GET['idNota'];
$deleta_nota="DELETE FROM notas_ava_teste where id_notas_ava_teste='$idnota'";
$deleta_nota=mysqli_query($conexao,$deleta_nota);
if($deleta_nota){
 echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";

}//fim se deleta
}

$busca_prova="SELECT id_disciplina from avaliacao_teste where id_ava_teste='$id'";
$con_busca=mysqli_query($conexao,$busca_prova);
while($res_busca=mysqli_fetch_assoc($con_busca)){
$disciplina=$res_busca['id_disciplina'];}?>
<?php 
$buscaDis="SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$disciplina'";
$conDis=mysqli_query($conexao,$buscaDis);
while($resDis=mysqli_fetch_assoc($conDis)){
  $disc=$resDis['nome'];
  $curso=$resDis['curso'];
}
 ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<div id="box">
  <div class="div-responsive">
<br>
<h1><a class="a3" rel="stylesheet" href="correcao_teste.php?pg=teste&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo, os alunos desta disciplina:  <?php echo $disc."  ".$curso;?>.        <h1>Lançar notas da 3ª Ava</h1></h1>

 
<?php

$sql_1 = "SELECT * FROM avaliacao_teste WHERE id_ava_teste= '$id'";
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_curso'];
		$professor = $res_1['professor'];
		$bimestre = $res_1['bimestre'];
    $ano=Date("Y");
		
$sql_2 = "SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' and e.status='Ativo' order by e.nome asc";
$result_2 = mysqli_query($conexao, $sql_2);
if(mysqli_num_rows($result_2) == ''){
	echo '<h2><font color="blue">não possui alunos cadastrados nesta turma</font></h2>';
}else{
		while($res_2 = mysqli_fetch_assoc($result_2)){
?> 
 
<form name="" method="get" action="" enctype="multipart/form-data">
<input type="hidden" name="bimestre" value="<?php echo $res_1['bimestre']; ?>" />
<input type="hidden" name="disciplina" value="<?php echo $res_1['id_disciplina']; ?>" />
<input type="hidden" name="code_aluno" value="<?php echo $res_2['matricula']; ?>" />
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="selec" value="<?php echo $selec; ?>" />
<table id="customers" border="0">
  <tr>
    <th>Código:</th>
    <th>Aluno:</th>
    <th>Bimestre:</th>
    <th>Nota:</th>
  </tr>
  <tr>
    <td><h3><?php echo $code_aluno = $res_2['matricula']; ?></h3></td>
    <td><h3><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><?php echo $res_2['nome']; ?></span> </span></h3></td>
    <td><h3><?php echo $bimestre = $res_1['bimestre']; ?>º</h3></td>
    
    <?php
    $sql_4 = "SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_atividade='$id'";
	$result_4 = mysqli_query($conexao, $sql_4);
	if(mysqli_num_rows($result_4) == ''){
	?>
    <td><input name="nota" type="text" id="nota" size="3" disabled></td>
    </tr>
    <tr>
    <td><input type="submit" name="button" id="button" value="Inserir" onclick="alert('Nota Inserida')"></td>

    <?php }else{ while($res_4 = mysqli_fetch_assoc($result_4 )){ ?>
    <td><h3><?php echo $res_4['nota']; ?></h3></td>
    
  </tr>
    <tr>

   <td><a href="alterar_nota_trabalho.php?pg=teste&id=<?php echo $res_4['id_atividade'];?>&aluno=<?php echo $res_2['matricula']; ?>&disciplina=<?php echo $res_1['id_disciplina']; ?>&bimestre=<?php echo $res_1['bimestre'];  ?>&professor=<?php echo $res_1['professor'];  ?>&nota=<?php echo $res_4['nota']; ?>" rel="superbox[iframe][400x100]"><img src="../image/ico-editar.png" border="0" width="30" title="Alterar a nota" /></a></td>
  
   <td><a href="correcao_teste.php?pg=teste&id=<?php echo $id; ?>&selec=<?php echo $selec; ?>&idNota=<?php echo $res_4['id_notas_ava_teste'];?>&deleta=sim"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>
   <td colspan="3"><h3>Responsável: <?php echo @$res_4['prova'];?></h3></td>
    <?php }} ?>
  </tr>
</table>
</form>
<?php }}} ?>
</div>
</div><!-- box -->

<?php if(isset($_GET['button'])){

$code_aluno = $_GET['code_aluno'];
$nota = $_GET['nota'];
$bimestre = $_GET['bimestre'];
$disciplina = $_GET['disciplina'];
// $prova = $_FILES['prova']['name'];
$date=Date('Y');
$selec=$_GET['selec'];
switch ($bimestre) {
    case '1':
    // bimestres
    if(($nota>3 && $_GET['selec']!="1")){
      ?>
      <script>
        alert('Nota Maxima 2.0 no primeiro  bimestre');
      </script>  
      <?php
      echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
    }elseif($nota>4 && $_GET['selec']=="1"){ ?>
      <script>
        alert('Atividade Inativa');
      </script>

      <?php  
      echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
    }else{
      $sql_verifica = "SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'";
      $result_verifica = mysqli_query($conexao, $sql_verifica);
      if(mysqli_num_rows($result_verifica)==0){
        $sql_3 = "INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$date','Coordenador')";
     mysqli_query($conexao, $sql_3);
     $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas dos testes estão sendo divulgadas','testes')";
    mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }///else encadeado
    // fim 
    break;
    case '2':

      // 2 bimestre
       // bimestre
    if((($nota>2 && $_GET['selec']==3) || ($nota>3 && $_GET['selec']=="1") || ($nota>3 && $_GET['selec']=="2") )){
      ?>
      <script>
        alert('Esta nota esta acima do valor deste bimestre, entre em contato com o seu coordenador!');
      </script>  
      <?php
      echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
    }else
    {
      $sql_verifica = "SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'";
      $result_verifica = mysqli_query($conexao, $sql_verifica);
      if(mysqli_num_rows($result_verifica)==0){
       $sql_3 = "INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$date','Coordenador')";
     mysqli_query($conexao, $sql_3);
     $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas dos testes estão sendo divulgadas','testes')";
    mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
   
     
      break;
      case '3':
        if(($nota>2 && $_GET['selec']>=3)){
          ?>
          <script>
            alert('Nota Maxima 2 para este bimestre');
          </script>
          <?php
        }else{
          if(($nota>3 && $_GET['selec']==2)){
            ?>
            <script>
              alert('Nota Maxima 3 para este bimestre');
            </script>
            <?php
           
          die;
          }else{
           $sql_3 = "INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$date','Coordenador')";
            mysqli_query($conexao, $sql_3);
     $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas dos testes estão sendo divulgadas','testes')";
            mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas dos testes estão sendo divulgadas','testes')";
            // mysqli_query($conexao, $sql_4);
          }
        
        }
        break;
        case '4':
          if(($nota>2 && $_GET['selec']>=3)){
            ?>
            <script>
              alert('Nota Maxima 2 para este bimestre');
            </script>
            <?php
          }else{
            if(($nota>3 && $_GET['selec']==2)){
              ?>
              <script>
                alert('Nota Maxima 3 para este bimestre');
              </script>
              <?php
             
            die;
            }else{
              $sql_3 = "INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova) VALUES ('$code_aluno', '$bimestre', '$disciplina', '$nota', $id,'$date','Coordenador')";
                mysqli_query($conexao, $sql_3);
                $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas dos testes estão sendo divulgadas','testes')";
                mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
                echo "<script language='javascript'>window.location='correcao_teste.php?pg=teste&selec=$selec&id=$id';</script>";
            }
          
          }
          break;
    // fim swithc
 
}

}?> 
<script>
       (function( $ ) {
            $(function() {
              //$("#date").mask("99/99/9999");
              //$("#phone").mask("(99) 999-9999");
              //$("#cep").mask("99.999-99");
              //$("#cpf").mask("99.999.999-99");
              $("#nota").mask("9.9");
              
              $("#nota").css('background', 'write');
              $('#nota').attr("disabled", false);
              $('#nota').focus();
            });
          })(jQuery);
        </script>

<?php require "rodape.php"; ?>

<body>
</body>
</html>