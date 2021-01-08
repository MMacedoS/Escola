<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<!---<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />--->

<link rel="shortcut icon" href="../image/logo.png">
<style>
#filtro{
  /* margin-left: -15rem!important; */
}
</style>
</head>

<body>
<?php require_once "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<!-- filtro -->
<form name="button1" method="GET" action="" enctype="multipart/form-data">
<br><br>
<div class="row ">
<div class="form-group">
                    <label for="exampleFormControlInput1">Selecione uma Turma</label>
                    <select name="turma" class="form-control col-sm-12 mr-5">
                            
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

        <input type="hidden" name="selec" value="<?=$_GET['selec']?>">
         <div>
        <input class="input" type="submit" name="button" id="button" value="Buscar">
        </div>

    </div>
                           
                       
                            
                                               
                  
                </form>
            
<!-- fim do filtro -->

<?php

 
if(!@$_GET['button']){
	echo "Nenhuma busca!";
}else{
  if(@$_GET['turma']){
  $curso=@$_GET['turma'];
  $selec=@$_GET['selec'];
  // header("Location:fazer_chamada.php?curso=$curso&dis=$dis");
  echo "<script language='javascript'>window.location='finalizar_conselho.php?selec=$selec&curso=$curso';</script>";

  }} ?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>