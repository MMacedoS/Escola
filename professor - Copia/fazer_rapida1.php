<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>Chamada</title>
<link rel="stylesheet" type="text/css" href="css/fazer_chamada.css"/>
</head>
<?php require "../config.php"; ?>
<body>


<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 
 <h1>Abaixo está mostrando todos os alunos do(a) <strong>
 <?php echo $curso = base64_decode($_GET['curso'])." ";?><?php echo $turno=base64_decode($_GET['turno']);?></strong> 
 Data de Hoje <strong><?php echo date("d/m/Y"); ?></strong></h1>
   <h1>disciplina: <?php echo $dis=base64_decode($_GET['dis'])." ";?>
     </h1>
    <?php

$date = date("d/m/Y H:i:s");
$date_hoje = date("d/m/Y");
$dis = base64_decode($_GET['dis']);
$turno=base64_decode($_GET['turno']);

$sql_1 = "SELECT * FROM estudantes WHERE serie = '$curso' and turno='$turno'";
$resultado = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($resultado) == ''){
	 echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
}else if(mysqli_num_rows($resultado)>=1){?>

<?php 

 while($res_1 = mysqli_fetch_assoc($resultado)){
	 $code_aluno = $res_1['code'];
?> 
<form name="button" method="post" enctype="multipart/form-data" action="">
<table class="users" id="table-responsive" border="0">
  <tr>
    <th width="94"><strong>Código:</strong></th>
    <th width="350"><strong>Nome:</strong></th>
    <th colspan="2"><strong>Este aluno está presente?</strong></th>
    <th></th>
  </tr>
  <tr>
      <td> <?php echo $res_1['code']; ?><input type="hidden" name="code_aluno" value="<?php echo $res_1['code']; ?>" /></td>
      <th> <?php echo $res_1['nome']; ?><input type="hidden" name="nome" value="<?php echo $res_1['nome']; ?>" /></th>
    <?php 
         $sql_chamada = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND disciplina = '$dis' AND code_aluno = '$code_aluno'";
	       $con_chamada= mysqli_query($conexao, $sql_chamada);
         if(mysqli_num_rows($con_chamada)==''){
    ?>      
       <td width="315">
        <input type="radio" name="presenca" id="radio" value="SIM" checked>
      <label for="radio">SIM </label> 
        <input type="radio" name="presenca" value="FALTA">
      <label for="radio">NÃO </label> 
        <input type="radio" id="p" name="presenca" value="JUSTIFICADA">
        <label for="radio">FALTA JUSTIFICADA </label>
       <label for="fileField"></label>
       </td><?php   
       if(isset($_POST['inserir'])=='Guardar'&& isset($_POST['presenca'])=='JUSTIFICADA' || isset($_POST['presenca'])=='FALTA'){
           
           $code_aluno = $_POST['code_aluno'];	
                $nome = $_POST['nome'];	
                @$presensa = $_POST['presenca'];
                $sql_ver_falta= "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND code_aluno ='$code_aluno'";
                 
                $con_ver_falta = mysqli_query($conexao, $sql_ver_falta);
                if(mysqli_num_rows($con_ver_falta)>=1 && $presensa == 'JUSTIFICADA' || $presensa == 'FALTA') {
                ?>
                  <td colspan="3">
                  <h3><strong>Este aluno possui presença em outra disciplina hoje, tem certeza que ele não está na sala de aula?</strong></h3>
                  <a href="fazer_chamada.php?curso=<?php echo $_GET['curso']; ?>&dis=<?php echo $_GET['dis']; ?>&turno=<?php echo $_GET['turno'];?>&confirmar_falta=sim&code_aluno=<?php echo $code_aluno; ?>&tipo=<?php echo $_POST['presenca']; ?>">CONFIRMAR FALTA</a> | <a href="">CANCELAR</a>
                  </td>
               <?php } else if (mysqli_num_rows($con_ver_falta)==0 && $presensa == 'FALTA' || $presensa == 'JUSTIFICADA'){
                 ?>
                 <td colspan="3">
                  <h3><strong>Este aluno NÃO possui presença em outras disciplinas hoje, tem certeza que ele não está na sala de aula?</strong></h3>
                  <a href="fazer_chamada.php?curso=<?php echo $_GET['curso']; ?>&dis=<?php echo $_GET['dis']; ?>&turno=<?php echo $_GET['turno'];?>&confirmar_falta=sim&code_aluno=<?php echo $code_aluno; ?>&tipo=<?php echo $_POST['presenca']; ?>">CONFIRMAR FALTA</a> | <a href="">CANCELAR</a>
                  </td>
                 
                 <?php
               }?>
        <?php             
       }else{ ?>
       <td width="62"><input type="submit" name="inserir" id="button" value="Guardar"></td>
         <?php }
          }//fechamento do if falta
         else{?>
         <td><?php echo "chamada realizada! presença: "; 
          
           while($mostrar_chamada=mysqli_fetch_assoc($con_chamada)){
                    echo $mostrar_chamada['presente'];
           }
           ?></td>
         <td width="62"><button class="" name="alterar" id="btn_alter"  value="alterar"><img  border="0" src="../image/deleta.png" width="22" /></button></td>
        
         <?php }
         ?>
         
  </tr>  
  </table>
  </form>
  <?php }
?>

<?php 
  if(isset($_POST['inserir'])=='Guardar'){

$code_aluno = $_POST['code_aluno'];	
$nome = $_POST['nome'];	
@$presensa = $_POST['presenca'];

if($presensa == ''){
	echo "<script language='javascript'>window.alert('Por favor, informe se este aluno está presente ou não na sala de aula!');</script>";
}else if($presensa=='SIM'){
$sql_4 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presensa')";	
mysqli_query($conexao, $sql_4);
	echo "<script language='javascript'>window.location='';</script>";
  }
  }
 ?>
<?php 
  if(isset($_POST['alterar'])=='alterar'){

$code_aluno = $_POST['code_aluno'];	
$curso = $_GET['curso'];
$turno=$_GET['turno'];

$sql_alterar = "delete from chamadas_em_sala where date_day='$date_hoje' and code_aluno='$code_aluno' and disciplina='$dis'";	

mysqli_query($conexao, $sql_alterar);
$disc=($_GET['dis']);
	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc&turno=$turno; ?>';</script>";
  }

 ?>
 <?php if(@$_GET['confirmar_falta'] == 'sim'){

$code_aluno = $_GET['code_aluno'];
$presensa = $_GET['tipo'];

$sql_5 = "INSERT INTO chamadas_em_sala (date, date_day, curso, disciplina, code_professor, code_aluno, presente) VALUES ('$date', '$date_hoje', '$curso', '$dis', '$code', '$code_aluno', '$presensa')";	
mysqli_query($conexao, $sql_5);
$curso = $_GET['curso'];
$disc=($_GET['dis']);
$turno=$_GET['turno'];
 echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc&turno=$turno; ?>';</script>";
 
}?>



<!  alterar falta ou colocar falta>
<?php }else{ echo "";}
?>
</div><!-- box -->



</body>
</html>