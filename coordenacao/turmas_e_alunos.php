<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<!---<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />--->

<link rel="shortcut icon" href="../image/logo_ist.gif">
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
    <div class="form-group ml-2">
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
         <div>
        <input class="input" type="submit" name="button" id="button" value="Buscar">
        </div>

    </div>
                           
                       
                            
                                               
                  
                </form>
            <?php if(isset($_GET['button'])){
if(@$_GET['disciplina']){
$tipo = $_GET['disciplina'];
$serie = $_GET['turma'];

$s=$_GET['selet'];

echo "<script language='javascript'>window.location='turmas_e_alunos.php?selec=$s&disciplina=$tipo&turma=$serie&filtro=1';</script>";

}}?>
<!-- fim do filtro -->
<h1>Abaixo, observa-se o historico de chamadas!</h1>
<?php

 
if(!@$_GET['filtro']){
	echo "Nenhuma disciplina!";
}else{
  if(@$_GET['disciplina']){
  $curso=$_GET['turma'];
  $dis=$_GET['disciplina'];
  // header("Location:fazer_chamada.php?curso=$curso&dis=$dis");
  echo "<script language='javascript'>window.location='fazer_chamada.php?dis=$dis&curso=$curso';</script>";

  }} ?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>