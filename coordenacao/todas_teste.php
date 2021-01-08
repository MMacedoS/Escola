<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Teste</title>

<link rel="shortcut icon" href="../image/logo_ist.gif">
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
<?php if($_GET['pg'] == 'teste'){
    $selec=$_GET['selec'];
    $code=@$_GET['code'];
    $ano=Date('Y');
 ?>
<div class="row" id="row_button">
<!-- <br /><a class="a2" rel="superbox[iframe][350x400]" href="cadastrar_teste.php?tipo=teste&selec=<php //echo $selec;?>&code=<php //echo $id_professor; ?>">Cadastrar Atividade</a> -->
<br />
<?php if(@$_GET['filtro']){
echo '<a class="a3" rel="stylesheet" href="todas_teste.php?pg=teste&selec='.$selec.'&turma='.$_GET['turma'].'&disciplina='.$_GET['disciplina'].'">Atualizar Pagina</a>';
}else{
  echo '<a class="a3" rel="stylesheet" href="todas_teste.php?pg=teste&selec='.$selec.'">Atualizar Pagina</a>';
}?>

</div>
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_teste.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>

<?php if(!@$_GET['filtro']){?>
<div class="row ">
<div class="form-group ml-2 col-sm-12 col-md-3">
                    <label for="exampleFormControlInput1">Selecione uma Turma</label>
                    <select name="turma" onchange="submit()" class="form-control col-sm-12 mr-5">
                            
                                <?php 
                                // se selec não existir 
                                if(!@$_GET['turma']){
                                  echo '<option value="">Selecione</option>';
                                }
                                  if(@$_GET['turma']){
                                          $sql_2=$pdo->prepare("SELECT * from cursos c INNER JOIN categoria cat on c.id_categoria=cat.id_categoria where c.id_cursos=:c");
                                        $sql_2->bindValue(':c',base64_decode($_GET['turma']));
                                        $sql_2->execute();
                                        $dados=$sql_2->fetchAll();
                                        foreach($dados as $dado){
                                          echo '<option value="'.base64_encode($dado['id_cursos']).'">'.$dado['curso'].'</option>';
                                        }
                                  }
                                  $sql_2=$pdo->prepare("SELECT * from cursos c INNER JOIN categoria cat on c.id_categoria=cat.id_categoria where cat.id_categoria=:t");
                                  $sql_2->bindValue(':t',$_GET['selec']);
                                  $sql_2->execute();
                                  $dados=$sql_2->fetchAll();
                                  foreach($dados as $dado){
                                    echo '<option value="'.base64_encode($dado['id_cursos']).'">'.$dado['curso'].'</option>';
                                  }
                                
                                   ?>
                            </select>
    </div>
    <?php if(isset($_GET['turma']) && $_GET['turma']!=''){
                          ?>
    <div class="form-group ml-2 col-sm-12 col-md-3">
                    <label for="exampleFormControlInput1">Selecione uma disciplina</label>
                    <select name="disciplina" class="form-control col-sm-12">                    
                                <?php 
                                  $sql_2=$pdo->prepare("SELECT d.id_disciplinas,l.nome from disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina inner join cursos c on c.id_cursos=d.id_cursos where c.id_cursos=:t");
                                  $sql_2->bindValue(':t',base64_decode($_GET['turma']));
                                  $sql_2->execute();
                                  $dados_d=$sql_2->fetchAll();
                                  foreach($dados_d as $res_2){                               
                                  ?>
                                <option value="<?php echo base64_encode($res_2['id_disciplinas']); ?>"><?php echo $res_2['nome']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                       

       
        <?php
                       
          // echo '<input type="hidden" name="selec" value="'.$_GET['selec'].'">';
        }?>
        <input type="hidden" name="selet" value="<?php if(@$_GET['selec']==''){echo @$_GET['selet'];}else{echo @$_GET['selec'];};?>">
        <?php if(@$_GET['pg']){
          echo '<input type="hidden" name="pg" value="teste">';
        }?>
         <div>
        <input class="input" type="submit" name="button" id="button" value="Buscar">
        </div>

    </div>
                           
                       
                            
                                               
                  
                </form>
            <?php if(isset($_GET['button'])){
if(isset($_GET['disciplina'])){
$tipo = $_GET['disciplina'];
$serie = $_GET['turma'];

$s=$_GET['selet'];

echo "<script language='javascript'>window.location='todas_teste.php?pg=teste&selec=$s&disciplina=$tipo&turma=$serie&filtro=1';</script>";
}
}
}?>
<!-- fim do filtro -->
 <h1>Abaixo, segue o histórico bimestral da 3ª Avaliação de suas turmas!</h1>
 <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['filtro'])){
$ensino=$_GET['selec'];

if(isset($_GET['turma'])){
  $res=base64_decode($_GET['turma']);
  $code=base64_decode($_GET['disciplina']);
  $sql_1  = "SELECT ati.*, cat.categoria FROM avaliacao_teste ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where ati.id_disciplina='$code' and cat.id_categoria='$ensino' and ati.id_curso='$res' and ati.ano_letivo=$ano ORDER BY ati.id_ava_teste DESC";

}else{
  $sql_1  = "SELECT ati.*, cat.categoria FROM avaliacao_teste ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where ati.id_disciplina='$code' and cat.id_categoria='$ensino' and ati.ano_letivo=$ano ORDER BY ati.id_ava_teste DESC";
}//fim if busca
 
$result = mysqli_query($conexao, $sql_1);

if(mysqli_num_rows($result)==''){
  echo '<h2><font color="blue">No momento não existe!</font></h2>';
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table id="customers" border="0">
  <tr>
    <th>Código</th>
    <th >Lançamento</th>
    <th >Disciplina</th>
    <th >Bimestre</th>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id_ava_teste']; ?></h3></td>
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
    <!-- <td><a rel="superbox[iframe][350x400]" href="editar_teste.php?id=<php //echo $res_1['id_ava_teste']; ?>&code=<php //echo $code; ?>&selec=<?php echo $selec;?>">Editar</a></td> -->
    <td colspan="3"><a href="correcao_teste.php?pg=teste&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_ava_teste']; ?>">Lançar notas</a></td>
    <td></td>
    <!-- <td><a href="todas_teste.php?pg=excluir&id=<php //echo $res_1['id_ava_teste']; ?>&selec=<?php// echo $_GET['selec']; ?>&code=<php //echo $code; ?>"><img src="../image/deleta.png" width="22" border="0" /></a></td> -->
  </tr>  
  </table> 
 
<?php }
}
}else{
  echo '<h2><font color="blue">Nenhum regsitro buscado</font></h2>';
}///fim if filtro
}

if($_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

// $sql_2 = "DELETE FROM avaliacao_teste WHERE id_ava_teste = '$id'";
// mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_teste.php?pg=teste&selec=".$_GET['selec']."';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>