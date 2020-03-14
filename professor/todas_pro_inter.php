<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Projetos InterDisciplinares</title>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'projetos-interdisciplinar'){
    $selec=$_GET['selec'];
 ?>
<div class="row" id="row_button">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_pro_inter.php?tipo=projetos_interdisciplinar&code=<?php echo $id_professor; ?>">Cadastrar Atividade</a>
<br /><a class="a3" rel="stylesheet" href="todas_pro_inter.php?pg=projetos-interdisciplinar&selec=<?php echo $selec; ?>">Atualizar Pagina</a>
</div>
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_pro_inter.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>

<form name='incluir' ... />
<h1>Turmas:
 <select name="busca" id="cooler">  <!--  Função para recarregar a página com o grupo escolhido  -->
            
            <?php
            $res=0;
             if (isset($_GET['busca'])){
             
             ?>
              <option value="<?php echo $_GET['busca']; ?>"><?php 
               $busca=$_GET['busca'];
               $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and c.id_cursos='$busca' and ati.ano_letivo=2020 ORDER BY ati.id_pro_inter DESC";
            $result1=mysqli_query($conexao,$sql_select);   
            
            while($mos_rs1=mysqli_fetch_assoc($result1)){
              echo $mos_rs1['curso'];
              
              }?></option> 
            <?php
             $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.categoria='$selec' and ati.ano_letivo=2020 ORDER BY ati.id_pro_inter DESC";
            $result1=mysqli_query($conexao,$sql_select);   
            
            while($mos_rs1=mysqli_fetch_assoc($result1)){
           
            ?>
                          
              <option value="<?php echo $mos_rs1['id_cursos']; ?>">
              <?php echo $mos_rs1['curso']; ?>
              </option>
              <?php }
              }else{ 
              $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.categoria='$selec' and ati.ano_letivo=2020 ORDER BY ati.id_pro_inter DESC";
            $result1=mysqli_query($conexao,$sql_select);   
            
            ?><option value="0">Todas</option><?php
            while($mos_rs1=mysqli_fetch_assoc($result1)){
           
            ?>
                          
              <option value="<?php echo $mos_rs1['id_cursos']; ?>">
              <?php echo $mos_rs1['curso']; ?>
              </option>
<?php     
    }} ?>
</select>
<input type="hidden" name="pg" value="projetos-interdisciplinar">
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
 <h1>Abaixo segue seu histórico dos PROJETOS INTERDISCIPLINARES de suas turmas!</h1>
 <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['selec'])){
$ensino=$_GET['selec'];
if(isset($_GET['busca'])){
  $res=$_GET['busca'];
  $sql_1  = "SELECT ati.*, cat.categoria FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.categoria='$ensino' and ati.id_curso='$res' and ano_letivo=2020 ORDER BY id_pro_inter DESC";

}else{
  $sql_1  = "SELECT ati.*, cat.categoria FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.categoria='$ensino' and ano_letivo=2020 ORDER BY id_pro_inter DESC";
}//fim if busca
 }else{

  $sql_1 = "SELECT ati.*, cat.categoria FROM projetos_interdisciplinar ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor=$code and ano_letivo='2020' ORDER BY id_pro_inter DESC";
 }
$result = mysqli_query($conexao, $sql_1);

if(mysqli_num_rows($result)==''){
	 echo "<h2>No momento não existe nenhuma prova lançada no sistema!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table width="955" border="0">
  <tr>
    <td width="90">Nº Projeto</td>
    <td width="60">Status</td>
    <td width="131">Lançamento</td>
    <td width="187">Data de aplicação</td>
    <td width="323">Disciplina</td>
    <td width="200">Bimestre</td>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id_pro_inter']; ?></h3></td>
    <td><h3><?php echo $res_1['status']; ?></h3></td>
    <td><h3><?php echo $res_1['data']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php $DIS=$res_1['id_disciplina'];
    $buscaDisc="SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos WHERE d.id_disciplinas='$DIS'";
    $conDisc=mysqli_query($conexao,$buscaDisc);
    while($resDisc=mysqli_fetch_assoc($conDisc)){
      echo $resDisc['disciplina']." -----  ".$resDisc['curso'];
    }
    ?></h3></td>
     <td><h3><?php echo $res_1['bimestre']; ?></h3></td>
  </tr>
  <tr>
    <td><a rel="superbox[iframe][850x350]" href="editar_pro_inter.php?id=<?php echo $res_1['id_pro_inter']; ?>&code=<?php echo $code; ?>">Editar</a></td>
    <td colspan="3"><a href="correcao_pro_inter.php?pg=projetos_interdisciplinar&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_pro_inter']; ?>">Fazer correção</a></td>
    <td></td>
    <td><a href="todas_pro_inter.php?pg=excluir&id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>"><img src="../image/deleta.png" width="22" border="0" /></a></td>
  </tr>  
  </table> 
 
<?php }}}

if($_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

$sql_2 = "DELETE FROM projetos-interdisciplinar WHERE id = '$id'";
mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_as_atividades.php?pg=atividades_bimestrais';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>