
<!DOCTYPE html>
<?php $painel_atual = "professor"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/distribuicao.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="../image/logo_ist.gif">
    <title>Distribuição de Notas</title>
    <?php require_once "../config.php"; 
    
    // $go_to_url é o link do banner
echo "<script>window.open('gerar_pdf.php', '_blank');</script>";

    ?>
</head>
<body>
<div id="box">

    
  <div align="center">
<H1><a href="index.php?selec=<?php echo $_GET['selec'];?>">Distribuição de Notas</a> </H1>
<form action="distribuicao.php?pg=notas" method="get">
Selecione uma disciplina:
<select name="disciplina" id=""><?php 
$code=$_GET['code'];
$sql_disc="SELECT d.id_disciplinas,d.disciplina,c.curso from disciplinas d INNER JOIN professores p on d.id_professores=p.id_professores INNER JOIN cursos c on c.id_cursos=d.id_cursos where p.code='$code'";
$con_disc=mysqli_query($conexao,$sql_disc);
while($res_dis=mysqli_fetch_assoc($con_disc)){
?>
        <option value="<?php echo $res_dis['id_disciplinas'];?>"><?php echo $res_dis['disciplina']." ";?><?php echo $res_dis['curso']?></option>
<?php }?>
    </select>
    <input type="hidden" name="selec" value="<?php echo $_GET['selec'];?>">
    <input type="hidden" name="code" value="<?php echo $_GET['code'];?>">
    <input type="submit" name="button" value="buscar">
    </form>

<?php if(isset($_GET['button'])){ 
    $disciplina=$_GET['disciplina'];
    ?>
    
<table class="table-responsive"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">
<tr>
<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>
<?php $select="select * from unidades ";
        $con_select=mysqli_query($conexao, $select);
        while($res_con=mysqli_fetch_assoc($con_select)){
          
        
      ?>
      <td bgcolor="#efefef" colspan="9" align="center"><strong><?php echo $res_con['unidade']." unidade"; ?> </strong></td>
      

        <?php }?>
    <td bgcolor="#efefef" rowspan="2"><strong>MF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>RF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>S</strong></td>
</tr>
<tr>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Tarefas</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_I</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_t</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Teste</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">COC</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Prova</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Extra</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">M</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">S</font></td>
 <!-- II unidade -->
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Tarefas</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_I</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_t</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Teste</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">COC</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Prova</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Extra</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">M</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">S</font></td>
 <!-- III unidade -->
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Tarefas</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_I</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_t</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Teste</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">COC</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Prova</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Extra</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">M</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">S</font></td>
 <!-- IV unidade -->
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Tarefas</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_I</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">P_t</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Teste</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">COC</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Prova</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">Extra</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">M</font></td>
 <td bgcolor="#FFFFFF" class="at"><font color="#090000">S</font></td>
<!-- finais
<td bgcolor="#FFFFFF"><font color="#ff0000">0</font></td>
 <td bgcolor="#FFFFFF"><font color="#ff0000">0</font></td>
 <td bgcolor="#FFFFFF"><font color="#ff0000">AP</font></td> -->
</tr>

<?php $sql="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '23' and ce.ano_letivo='2020'";
$con=mysqli_query($conexao,$sql);
while($res=mysqli_fetch_assoc($con)){
$aluno=$res['matricula'];
$media1=0;
$media2=0;
$media3=0;
$media4=0;
$mediaFinal=0;
?>
<tr>
<td  bgcolor="#FFFFFF" class="nome" align="left"><font color="#090000"><?php  echo $res['nome'];?></font></td>
<!-- I bimestre -->

<!-- tarefas -->
<?php 
    
    $sqlTrans="select nota from notas_atividades where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        $media1=0;
        ?>
            <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- inter -->
<?php 
    
    $sqlinter="select nota from notas_pro_inter where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $coninter=mysqli_query($conexao,$sqlinter);
    if(mysqli_num_rows($coninter)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($coninter)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- transversal -->
<?php 
    
    $sqlTrans="select nota from notas_pro_transversal where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- teste -->
<?php 
    
    $sqlTrans="select nota from notas_ava_teste where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php //echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- coc -->
<?php 
    
    $sqlTrans="select nota from notas_ava_coc where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- prova -->
<?php 
    
    $sqlTrans="select nota from notas_ava_prova where bimestre='1' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
   if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }

     
?>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000"><?php
$mediaFinal=$media1;
 echo $media1; ?></font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">AP</font></td> 

<!-- II bimestre -->

<!-- tarefas -->
<?php 
    
    $sqlTrans="select nota from notas_atividades where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- inter -->
<?php 
    
    $sqlinter="select nota from notas_pro_inter where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $coninter=mysqli_query($conexao,$sqlinter);
    if(mysqli_num_rows($coninter)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($coninter)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- transversal -->
<?php 
    
    $sqlTrans="select nota from notas_pro_transversal where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- teste -->
<?php 
    
    $sqlTrans="select nota from notas_ava_teste where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- coc -->
<?php 
    
    $sqlTrans="select nota from notas_ava_coc where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
    
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- prova -->
<?php 
    
    $sqlTrans="select nota from notas_ava_prova where bimestre='2' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
   if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media2=$media2+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }

     
?>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000"><?php
$mediaFinal=$mediaFinal+$media2;
 echo $media2; ?></font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">AP</font></td> 


<!-- I bimestre -->

<!-- tarefas -->
<?php 
    
    $sqlTrans="select nota from notas_atividades where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- inter -->
<?php 
    
    $sqlinter="select nota from notas_pro_inter where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $coninter=mysqli_query($conexao,$sqlinter);
    if(mysqli_num_rows($coninter)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($coninter)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- transversal -->
<?php 
    
    $sqlTrans="select nota from notas_pro_transversal where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- teste -->
<?php 
    
    $sqlTrans="select nota from notas_ava_teste where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- coc -->
<?php 
    
    $sqlTrans="select nota from notas_ava_coc where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- prova -->
<?php 
    
    $sqlTrans="select nota from notas_ava_prova where bimestre='3' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
   if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF"  class="at"align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media3=$media3+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }

     
?>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000"><?php
$mediaFinal+=$media3;
 echo $media3; ?></font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">AP</font></td> 

<!-- I bimestre -->

<!-- tarefas -->
<?php 
    
    $sqlTrans="select nota from notas_atividades where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        $med
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- inter -->
<?php 
    
    $sqlinter="select nota from notas_pro_inter where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $coninter=mysqli_query($conexao,$sqlinter);
    if(mysqli_num_rows($coninter)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($coninter)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- transversal -->
<?php 
    
    $sqlTrans="select nota from notas_pro_transversal where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- teste -->
<?php 
    
    $sqlTrans="select nota from notas_ava_teste where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- coc -->
<?php 
    
    $sqlTrans="select nota from notas_ava_coc where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }
?>
<!-- prova -->
<?php 
    
    $sqlTrans="select nota from notas_ava_prova where bimestre='4' and id_disciplina='$disciplina' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
   if(mysqli_num_rows($conTrans)==""){
        ?>
            <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">0</font></td>
            <?php
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media4=$media4+$resTrans['nota'];
    ?>
    <td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000"><?php echo $resTrans['nota'];?></font></td>
    <?php 
    
     }
     }

     
?>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000"><?php
$mediaFinal+=$media4;
 echo $media4; ?></font></td>
<td bgcolor="#FFFFFF" class="at"><font color="#090000">AP</font></td> 
<?php
        if($mediaFinal>=28){
  ?>
<td bgcolor="#green" class="at"align="center"><font color="#090000"><?php
 echo $mediaFinal; ?></font></td>
 <?php
        }else{?>
<td bgcolor="#F6021B" class="at" align="center"><font color="#090000"><?php
 echo $mediaFinal; ?></font></td>
 <?php
        }
  ?>
<td bgcolor="#FF98FF" class="at">
<?php if(($mediaFinal>=27.6) && ($mediaFinal<28)){ 
$resFinal=$mediaFinal+0.4;

 echo $resFinal;?>
<?php
}else{ echo $mediaFinal;}?>
</td>
<td bgcolor="#FF76FF" class="at"><font color="#090000">AP</font></td> 
</tr>
<?php }
?>
<!-- <td bgcolor="#FFFFFF" align="left"><font color="#ff0000">Paulo</font></td>
<td bgcolor="#FFFFFF"><font color="#ff0000">7</font></td>
<td bgcolor="#FFFFFF"><font color="#ff0000">8</font></td> -->

 
<td colspan="2" class="at" bgcolor="#efefef" align="center"><strong>Média por matéria</strong></td>
<!-- 
<td bgcolor="#FFFFFF"><font color="#003399"><strong>7,50</strong></font></td>
<td bgcolor="#FFFFFF" align="center"><font color="#003399"><strong>7,25</strong></font></td> -->
</tr>
</table>
<?php }

?>
</div>

</div><!-- box -->

</body>
</html>