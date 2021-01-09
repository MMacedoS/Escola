<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Atividades Bimestrais</title>

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
<?php if($_GET['pg'] == 'atividades_bimestrais'){
    $selec=$_GET['selec'];
    $code=@$_GET['code'];
    $ano=Date('Y');
 ?>
<div class="row" id="row_button">
<!-- <br /><a class="a2" rel="superbox[iframe][300x350]" href="cadastrar_atividades.php?tipo=atividade_bimestral&code=<php //echo $id_professor; ?>&selec=<php //echo $selec;?>">Cadastrar Atividade</a> -->
<br />
<?php if(@$_GET['filtro']){
echo '<a class="a3" rel="stylesheet" href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec='.$selec.'&turma='.$_GET['turma'].'&disciplina='.$_GET['disciplina'].'">Atualizar Pagina</a>';
}else{
  echo '<a class="a3" rel="stylesheet" href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec='.$selec.'">Atualizar Pagina</a>';
}?>

</div>
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_ativ_tarefas.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
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
                        <div class="form-group ml-2 col-sm-12 col-md-3">
                            <label for="exampleFormControlInput1">Selecione um bimstre</label>
                            <select name="bimestre" class="form-control col-sm-12">
                                <?php 
                                  $sql_2=$pdo->prepare("SELECT * from unidades");
                                  $sql_2->execute();
                                  $dados_d=$sql_2->fetchAll();
                                  foreach($dados_d as $res_2){                               
                                  ?>
                                <option value="<?php echo base64_encode($res_2['unidade']); ?>">
                                    <?php echo $res_2['unidade'].' unidade'; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group ml-2 col-sm-12 col-md-3">
                            <label for="exampleFormControlInput1">Ano Letivo</label>
                            <select name="ano" class="form-control col-sm-12">
                                <option value="<?=$ano?>"><?=$ano?></option>
                                <option value="<?=$ano-1?>"><?=$ano-1?></option>
                            </select>
                        </div>

       
        <?php
                       
          // echo '<input type="hidden" name="selec" value="'.$_GET['selec'].'">';
        }?>
        <input type="hidden" name="selet" value="<?php if(@$_GET['selec']==''){echo @$_GET['selet'];}else{echo @$_GET['selec'];};?>">
        <?php if(@$_GET['pg']){
          echo '<input type="hidden" name="pg" value="atividades_bimestrais">';
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
              $ano_letivo=$_GET['ano'];
              $s=$_GET['selet'];

        echo "<script language='javascript'>window.location='todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=$s&disciplina=$tipo&turma=$serie&ano=$ano_letivo&filtro=1';</script>";



      } 
    }
}?>
<!-- fim do filtro -->

 <h1>Abaixo, segue o histórico bimestral da 1ª Avaliação de suas turmas!</h1>
  <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['filtro'])){
$ensino=$_GET['selec'];
if(isset($_GET['disciplina'])){
  $ano_letivo=$_GET['ano'];
  $res=base64_decode($_GET['turma']);
  $code=base64_decode($_GET['disciplina']);
  $sql_1=$pdo->query("SELECT ati.*, cat.categoria FROM atividades_bimestrais ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplina='$code' and cat.id_categoria='$ensino' and ati.id_curso='$res' and ano_letivo='$ano_letivo' ORDER BY id_ativ_bim DESC");

  // $sql_1  = "SELECT ati.*, cat.categoria FROM atividades_bimestrais ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplina='$code' and cat.id_categoria='$ensino' and ati.id_curso='$res' and ano_letivo='$ano' ORDER BY id_ativ_bim DESC";

}else{
  $sql_1 = $pdo->query("SELECT ati.*, cat.categoria FROM atividades_bimestrais ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplina='$code' and cat.id_categoria='$ensino' and ano_letivo='$ano_letivo' ORDER BY id_ativ_bim DESC");
//  $sql_1  = "SELECT ati.*, cat.categoria FROM atividades_bimestrais ati INNER JOIN cursos c ON c.id_cursos=ati.id_curso INNER JOIN categoria cat on cat.id_categoria=c.id_categoria where id_disciplina='$code' and cat.id_categoria='$ensino' and ano_letivo='$ano' ORDER BY id_ativ_bim DESC";
}// fim if busca
 
$result =$sql_1->fetchAll(PDO::FETCH_ASSOC);
$count_dados=count($result);
if($count_dados==0){
  echo '<h2><font color="blue">No momento não existe!</font></h2>';
}else{
  foreach($result as $key=>$res_1){
	// while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table  id="customers" border="0">
  <tr>
    <th >Código</th>
    <th >Lançamento</th>
    <th >Disciplina</th>
    <th >Bimestre</th>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id_ativ_bim']; ?></h3></td>
    <td><h3><?php echo $res_1['data']; ?></h3></td>
    <td><h3><?php $DIS=$res_1['id_disciplina'];
    $buscaDisc=$pdo->query("SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$DIS'");

    
    $conDisc=$buscaDisc->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($conDisc as $key=>$resDisc){
    // while($resDisc=mysqli_fetch_assoc($conDisc)){
      echo $resDisc['nome']." - ".$resDisc['curso'];
      // var_dump($resDisc);
    }
    ?></h3></td>
    <td><h3><?php echo $res_1['bimestre']; ?></h3></td>
  </tr>
  <tr>
  
    <td colspan="3"><a id="lancar_notas" href="correcao_atividades.php?pg=atividade_bimestral&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_ativ_bim']; ?>&ano=<?=$ano_letivo?>">Lançar notas</a></td>
    <td></td>
  
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

// $sql_2 = "DELETE FROM atividades_bimestrais WHERE id_ativ_bim = '$id'";
// mysqli_query($conexao, $sql_2);

 echo "<script language='javascript'>window.location='todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=".$_GET['selec']."';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>
