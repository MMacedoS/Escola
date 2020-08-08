<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Trabalhos</title>

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
        #row_button {
            margin-right: 0px !important;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:31%;
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
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'trabalhos'){
    $selec=$_GET['selec'];
    $code=$_GET['code'];
 ?>
<div class="row" id="row_button">
<!-- <br /><a class="a2" rel="superbox[iframe][350x400]" href="cadastrar_trabalho.php?tipo=trabalhos&code=?php //echo $id_professor; ?>&selec=<php //echo $selec;?>">Cadastrar Atividade</a> -->
<br /><a class="a3" rel="stylesheet" href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $selec;?>&code=<?php echo $code?>">Atualizar Pagina</a>
</div>
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_as_trabalhos.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
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
               $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and c.id_cursos='$busca' and ati.ano_letivo=2020 ORDER BY ati.id_ava_coc DESC";
            $result1=mysqli_query($conexao,$sql_select);   
            
            while($mos_rs1=mysqli_fetch_assoc($result1)){
              echo $mos_rs1['curso'];
              
              }?></option> 
            <?php
             $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.id_categoria='$selec' and ati.ano_letivo=2020 ORDER BY ati.id_ava_coc DESC";
            $result1=mysqli_query($conexao,$sql_select);   
            
            while($mos_rs1=mysqli_fetch_assoc($result1)){
           
            ?>
                          
              <option value="<?php echo $mos_rs1['id_cursos']; ?>">
              <?php echo $mos_rs1['curso']; ?>
              </option>
              <?php }
              }else{ 
              $sql_select="SELECT DISTINCT c.id_cursos,c.curso FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.id_categoria='$selec' and ati.ano_letivo=2020 ORDER BY ati.id_ava_coc DESC";
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
<input type="hidden" name="pg" value="trabalhos">
<input type="hidden" name="selec" value="<?php echo $selec?>">
<input type="hidden" name="code" value="<?php echo $code;?>">
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
 <h1>Abaixo, segue o histórico bimestral da 2ª Avaliação de suas turmas!</h1>
 <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['selec'])){
$ensino=$_GET['selec'];

if(isset($_GET['busca'])){
  $res=$_GET['busca'];
  $sql_1  = "SELECT ati.*, cat.categoria FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.id_categoria='$ensino' and ati.id_curso='$res' and ano_letivo=2020 ORDER BY id_ava_coc DESC";

}else{
  $sql_1  = "SELECT ati.*, cat.categoria FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor='$code' and cat.id_categoria='$ensino' and ano_letivo=2020 ORDER BY id_ava_coc DESC";
}//fim if busca
 }else{

  $sql_1 = "SELECT ati.*, cat.categoria FROM avaliacao_coc ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where professor=$code and ano_letivo='2020' ORDER BY id_ava_coc DESC";
 }
$result = mysqli_query($conexao, $sql_1);

if(mysqli_num_rows($result)==''){
	 echo '<h2><font color="blue">No momento não existe!</font></h2>';	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table id="customers" border="0">
  <tr>
    <th >Nº Projeto</th>
    <th>Lançamento</th>
    <th>Disciplina</th>
    <th>Bimestre</th>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id_ava_coc']; ?></h3></td>
    <td><h3><?php echo $res_1['data']; ?></h3></td>
    <td><h3><?php $DIS=$res_1['id_disciplina'];
    $buscaDisc="SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$DIS'";
    $conDisc=mysqli_query($conexao,$buscaDisc);
    while($resDisc=mysqli_fetch_assoc($conDisc)){
      echo $resDisc['nome']." - ".$resDisc['curso'];
    }
    ?></h3></td>
     <td><h3><?php echo $res_1['bimestre']; ?></h3></td>
  </tr>
  <tr>
    <!-- <td><a rel="superbox[iframe][350x400]" href="editar_trabalho.php?id=?php// echo $res_1['id_ava_coc']; ?>&code=?php //echo $code; ?>&selec=?php //echo $selec;?>">Editar</a></td> -->
    <td colspan="3"><a href="correcao_trabalho.php?pg=trabalhos&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_ava_coc']; ?>">Lançar notas</a></td>
    <td></td>
    <!-- <td><a href="todas_as_trabalhos.php?pg=excluir&id=?php //echo $res_1['id_ava_coc']; ?>&selec=<php// echo $_GET['selec']; ?>&code=?php //echo $code; ?>"><img src="../image/deleta.png" width="22" border="0" /></a></td> -->
  </tr>  
  </table> 
 
<?php }}}

if($_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

// $sql_2 = "DELETE FROM avaliacao_teste WHERE id_ava_teste = '$id'";
// mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_as_trabalhos.php?pg=trabalhos&selec=".$_GET['selec']."';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>