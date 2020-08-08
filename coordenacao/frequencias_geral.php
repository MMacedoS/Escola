<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css" />
    <title>Provas</title>

    <link rel="shortcut icon" href="../image/logo.png">
    <style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
    </style>
</head>

<body>
    <?php require "topo.php"; ?>

    <div id="caixa_preta">
    </div><!-- caixa_preta -->

    <div id="box">

    </div><!-- box-->

    <!-- <?php ///require_once "../config.php"; 
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";

    ?> -->
    </head>

    <body>
        <div id="box">

            <div align="center">
                <h1>Gerar Planilha de frequência</h1>
                <br>
                <form action="" method="GET">
                    <div class="row ">
                        <div class="form-group col-sm-12 col-md-3">
                            <label for="exampleFormControlInput1">Selecione uma Turma</label>
                            <select name="turma" onchange="submit()" class="form-control col-sm-12 mr-5">

                                <?php 
                                // se selec não existir 
                                if(!@$_GET['turma']){
                                  echo '<option value="">Selecione uma categoria</option>';
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
                                <option value="<?php echo base64_encode($res_2['id_disciplinas']); ?>">
                                    <?php echo $res_2['nome']; ?>
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

                        <?php
                       
          // echo '<input type="hidden" name="selec" value="'.$_GET['selec'].'">';
        }?>
                        <input type="hidden" name="selet"
                            value="<?php if(@$_GET['selec']==''){echo @$_GET['selet'];}else{echo @$_GET['selec'];};?>">
                        <div>
                            <input class="input" type="submit" name="button" id="button" value="Buscar">
                        </div>

                    </div>
                </form>

                <?php 
if(isset($_GET['button'])){
    // $go_to_url é o link do banner
if(@$_GET['disciplina']){
$disc=$_GET['disciplina'];
$situacao=$_GET['bimestre'];

echo "<script>window.open('test1.php?pg=rp&id=$disc&bimestre=$situacao', '_blank');</script>";
}
}
?>
                <?php require "rodape.php"; ?>
    </body>

</html>