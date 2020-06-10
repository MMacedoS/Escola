<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>Chamada</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/fazer_chamada.css"/>
</head>

<body>

<?php require_once ("topo.php"); $q_c=0;?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 
 <h1>Abaixo está mostrando todos os alunos do <strong>
 <?php $curso = base64_decode($_GET['curso']); 
 $buscaCurso="SELECT * from cursos where id_cursos='$curso'";
 $busca=$conCurso=mysqli_query($conexao,$buscaCurso);
 if($busca){
 while($resCurso=mysqli_fetch_assoc($conCurso)){
      $cursos=$resCurso['curso'];
      $turno=$resCurso['turno'];
 };echo $cursos.'  '."".$turno;}else{
        ?><script>alert('erro ao buscar os cursos');</script><?php
  }
  ?></strong> 
  
 Data de Hoje <strong><?php echo date("d/m/Y"); ?></strong></h1>
   <h1>disciplina: <?php $dis=base64_decode($_GET['dis']);
   $buscaDis="SELECT * FROM disciplinas where id_disciplinas='$dis'";
   $conDis=mysqli_query($conexao,$buscaDis);
   while($resDisc=mysqli_fetch_assoc($conDis)){
        echo $resDisc['disciplina'];
   }
   ?>
     <!-- <a background-color="blue" id="h1_a" rel="superbox[iframe][900x500]" href="fazer_rapida.php?curso=<?php echo $_GET['curso'];?>&dis=<?php echo $_GET['dis'];?>&turno=<?php echo $_GET['turno'];?>"><img title="chamada rapida" border="0" src="../image/confirma.png" width="50" /></a> -->
     </h1>
    <?php

$date = date("d/m/Y H:i:s");
$date_hoje = date("d/m/Y");
$dis = base64_decode($_GET['dis']);

$sql_1 = "SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$curso' order by nome asc";
$resultado = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($resultado) == ''){
	 echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
}else if(mysqli_num_rows($resultado)>=1){
 while($res_1 = mysqli_fetch_assoc($resultado)){
	 $code_aluno = $res_1['matricula'];
?> 

<form name="button" method="GET" enctype="multipart/form-data" action="">

<table class="users" id="table-responsive" border="0">
  <tr>
    <th width="94"><strong>Código:</strong></th>
    <th width="350"><strong>Nome:</strong></th>
    <th colspan="2"><strong>Este aluno está presente?</strong></th>
    <th colspan="2"><strong></strong></th>
    <th></th>
  </tr>
  <input type="hidden" name="curso" value="<?php echo  base64_encode($curso); ?>">
  <input type="hidden" name="dis" value="<?php echo  base64_encode($dis); ?>">
  <tr>
      <td> <?php echo $res_1['matricula']; ?><input type="hidden" name="code_aluno" value="<?php echo $res_1['matricula']; ?>" /></td>
      <td> <?php echo $res_1['nome']; ?><input type="hidden" name="nome" value="<?php echo $res_1['nome']; ?>" /></td>
    <?php 
         $sql_chamada = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND id_disciplinas = '$dis' AND matricula = '$code_aluno'";
	       $con_chamada= mysqli_query($conexao, $sql_chamada);
         if(mysqli_num_rows($con_chamada)==''){
    ?>      
       <td width="315">
        <input type="checkbox" name="checkbox[]" id="radio" value="<?php echo $res_1['matricula']; ?>" >
      <label for="radio">SIM </label> 
        <input type="checkbox" name="checkboxf[]" value="<?php echo $res_1['matricula']; ?>">
      <label for="radio">NÃO </label> 
        <input type="checkbox" name="checkboxj[]" value="<?php echo $res_1['matricula']; ?>">
        <label for="radio">FALTA JUSTIFICADA </label>
       <label for="fileField"></label>
       </td>
       <td><strong></strong></td>
       <td><strong></strong></td>
       <?php 
      
       
          }//fechamento do if falta
         else{ ?>
         <td><?php echo "presença: "; 
          
           while($mostrar_chamada=mysqli_fetch_assoc($con_chamada)){
                    echo $mostrar_chamada['presente'];
                    $chamada=$mostrar_chamada['id'];
                    $q_c=$q_c+1;
           }
           ?></td>
         <td width="62"><a href="fazer_chamada.php?selec=nadaselecionado&pg=excluir&curso=<?php echo $_GET['curso']?>&dis=<?php echo $_GET['dis']?>&cha=<?php echo base64_encode($chamada); ?>"><img  border="0" src="../image/deleta.png" width="22" /></a></td>
        
         <?php }
         ?>
         
  </tr>  
  </table>
  
  
  <?php }

?>
<input type="submit" class="btn btn-primary" name="inserir" id="" value="Inserir dados" onclick="alert('chamada efetuada');">
</form>
<?php 
  if(isset($_GET['inserir'])=='Guardar'){

// $code_aluno = $_GET['code_aluno'];	
// $nome = $_GET['nome'];	
$curso = $_GET['curso'];
// @$presensa = $_GET['presenca'];
$ano=Date('Y');
$disc=($_GET['dis']);


// if($presensa == ''){
// 	echo "<script language='javascript'>window.alert('Por favor, informe se este aluno está presente ou não na sala de aula!');</script>";
// }else if($presensa=='SIM'){
// $sql_4 = "INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$code_aluno', '$presensa','$ano')";	
// $insere=mysqli_query($conexao, $sql_4);
// if($insere){
// 	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc; ?';</script>";

//   }else{
//   ? 
//     <script>
//     alert('Erro ao inserir a chamada');
//     </script>
//   <?php
//   }
// }
$chgeckboxes = @$_GET['checkbox'];
$chgeckboxes1 = @$_GET['checkboxf'];
$chgeckboxes2 = @$_GET['checkboxj'];
if(!empty($chgeckboxes)){
foreach( $chgeckboxes AS $dado ){     
  
      // $arr = filter( $_POST['excluir'] );
      $res=$pdo->prepare("INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) values(:data,:hoje,:dis,:dado,:presenca,:ano)");

      $res->bindvalue(":data",$date);
      $res->bindvalue(":hoje",$date_hoje);
      $res->bindvalue(":dis",$dis);
      $res->bindvalue(":dado",$dado);
      $res->bindvalue(":presenca",'SIM');
      $res->bindvalue(":ano",$ano);
      $res->execute();
      // $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$dado', 'SIM','$ano')";
      // mysqli_query($conexao, $query);
}}
if(!empty($chgeckboxes1)){
  foreach( $chgeckboxes1 AS $dado ){     
    
        // $arr = filter( $_POST['excluir'] );
        $res=$pdo->prepare("INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) values(:data,:hoje,:dis,:dado,:presenca,:ano)");
  
        $res->bindvalue(":data",$date);
        $res->bindvalue(":hoje",$date_hoje);
        $res->bindvalue(":dis",$dis);
        $res->bindvalue(":dado",$dado);
        $res->bindvalue(":presenca",'FALTA');
        $res->bindvalue(":ano",$ano);
        $res->execute();
        // $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$dado', 'SIM','$ano')";
        // mysqli_query($conexao, $query);
  }}
  if(!empty($chgeckboxes2)){
    foreach( $chgeckboxes2 AS $dado ){     
      
          // $arr = filter( $_POST['excluir'] );
          $res=$pdo->prepare("INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) values(:data,:hoje,:dis,:dado,:presenca,:ano)");
    
          $res->bindvalue(":data",$date);
          $res->bindvalue(":hoje",$date_hoje);
          $res->bindvalue(":dis",$dis);
          $res->bindvalue(":dado",$dado);
          $res->bindvalue(":presenca",'JUSTIFICADA');
          $res->bindvalue(":ano",$ano);
          $res->execute();
          // $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$dado', 'SIM','$ano')";
          // mysqli_query($conexao, $query);
    }}
echo "<script language='javascript'>window.location='fazer_chamada.php?selec=nadaselecionado&curso=$curso&dis=$disc; ?';</script>";
}?>
<?php 
if(isset($_GET['pg'])=='excluir'){

$chamada= base64_decode($_GET['cha']);	
$curso = $_GET['curso'];
$ano=Date('Y');
$res = $pdo->prepare("delete from chamadas_em_sala where id=:id ");

$res->bindValue(":id", $chamada);
$res->execute();
$disc=($_GET['dis']);
	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc; ?>';</script>";
  }

 ?>
 



<!-- <!  alterar falta ou colocar falta> -->
<?php 
$q_a=mysqli_num_rows($resultado);

$qtde=$q_a-$q_c;
if($qtde>=1){
  echo "<script>alert('Possui ".$qtde." aluno(s) sem presença.');</script>";
}elseif($qtde<0){
  echo "<script>alert('<ERRO> Esta chamada possui alunos com 2 resultados na presença. Porfavor corrigir!');</script>";
}
}else{ echo "";}
?>

</div><!-- box -->

<?php require "rodape.php"; ?>

</body>
</html>