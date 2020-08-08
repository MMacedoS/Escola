<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Provas</title>

<link rel="shortcut icon" href="../image/logo.png">
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if(isset($_GET['pg']) && $_GET['pg'] == 'notas'){
    $selec=$_GET['selec'];
    $code=@$_GET['code'];
 ?>
<!-- <div class="row" id="row_button">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_atividades.php?tipo=atividade_bimestral&code=<?php echo $id_professor; ?>">Cadastrar Atividade</a>
<br /><a class="a3" rel="stylesheet" href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $selec;?>">Atualizar Pagina</a>
</div> -->
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_notas.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
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
                                  echo '<option value="">Selecione uma Turma</option>';
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
          echo '<input type="hidden" name="pg" value="notas">';
        }?>
         <div>
        <input class="input" type="submit" name="button" id="button" value="Buscar">
        </div>

    </div>
                           
                       
                            
                                               
                  
                </form>
            <?php if(isset($_GET['button'])){
if(isset($_GET['disciplina'])){
$tipo = base64_decode($_GET['disciplina']);
$serie = $_GET['turma'];

$s=$_GET['selet'];

echo "<script language='javascript'>window.location='lancar_notas.php?pg=notas&selec=$s&id=$tipo&turma=$serie&filtro=1';</script>";

}
}
}?>
<!-- fim do filtro -->


  <?php $res='<div id="resultado"/>';?>
<?php
}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>