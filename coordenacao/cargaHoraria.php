<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <title>Chamada</title>
    
    <link rel="shortcut icon" href="../image/logo.png">
    <link rel="stylesheet" type="text/css" href="css/fazer_chamada.css" />
    <style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        .row{
            display:table-cell !important;
        }
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers td {
            width:10%;
        }
        .switch {
            width: 70px !important;
            
        }
        .opcao{
            display:none;
        }
        #button{
         
        margin: 0 0 0 0px !important;
        width: 60px !important;

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
   <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
   
</head>

<body>

    <?php require_once ("topo.php"); $q_c=0;
     date_default_timezone_set('America/Sao_Paulo');
    
    ?>
    
    <div id="caixa_preta">
    </div>
    <!-- caixa_preta -->

    <div id="box">
        <br>

        <?php if(@$_GET['selec'] || @$_GET['selet']){?>

            <form action="" method="GET">
        <label for="">Selecione uma Turma:</label>
        <select name="cursos" id="">
            <option value=" ">Turmas</option>
            <?php             
            $date = date("d/m/Y H:i:s");
            $selec=@$_GET['selec'];
            $selec1=@$_GET['selet'];
            $sql_1=$pdo->prepare("SELECT DISTINCT c.* from disciplinas d inner join cursos c on d.id_cursos=c.id_cursos inner join categoria cat on c.id_categoria=cat.id_categoria where cat.id_categoria=:selec or :selec1");
                $sql_1->bindValue(':selec',$selec);
                $sql_1->bindValue(':selec1',$selec1);
                $sql_1->execute();
                $dados=$sql_1->fetchAll(PDO::FETCH_ASSOC);
                foreach($dados as $dado){
            ?>
            <option value="<?= $dado['id_cursos']?>"><?= $dado['curso']; ?></option>

            <?php }?>
        </select>
        <input type="hidden" name="selet" value="<?=$_GET['selec']?>">
        <input type="submit" name="busca" value="Busca">        
        </form>
       <br><br>
            <?php


    if(@$_GET['busca']){
    $sql_1=$pdo->prepare("SELECT d.* from disciplinas d inner join cursos c on d.id_cursos=c.id_cursos inner join categoria cat on c.id_categoria=cat.id_categoria where d.id_cursos=:selec");
    $sql_1->bindValue(':selec',$_GET['cursos']);
    $sql_1->execute();
    $dados=$sql_1->fetchAll(PDO::FETCH_ASSOC);
    $resultado=count($dados);
if($resultado==0 ){
     echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
     var_dump($resultado);
}else if($resultado>=1){
 foreach ($dados as $res_1) {
     $disciplinas = $res_1['disciplina'];
     ?>
     <form action="" name="button" method="post">
         <input type="hidden" name="cursos" value="<?= $_GET['cursos']?>">
         <input type="hidden" name="selec" value="<?=$_GET['selec']?>">
     <table id="customers">
         <tr>
         <th>Codigo:</th>
         <th>Turma:</th>
         <th>Disciplina:</th>
         <th colspan="2">Carga Diaria: Aula</th>
        
         </tr>
         <tr>
         <td><?= $res_1['id_disciplinas']?></td>
         <td><?php 
         $buscaCurso=$pdo->query("SELECT curso FROM cursos WHERE id_cursos=".$res_1['id_cursos']);
        //  $buscaCurso->execute();
         $buscaCursos=$buscaCurso->fetch();
         echo $buscaCursos[0];
        ?></td>
         <td><?php 
         $buscaCurso=$pdo->query("SELECT nome FROM lista_disc l inner join disciplinas d on d.disciplina=l.id_lista WHERE d.disciplina=".$res_1['disciplina']);
        //  $buscaCurso->execute();
         $buscaCursos=$buscaCurso->fetch();
         echo $buscaCursos[0];
        ?></td>
         <?php if($res_1['cargaHoraria_diaria']!=0){
           echo "<td>";  
           echo $res_1['cargaHoraria_diaria'];
           echo "</td>";
           echo "<td>";
           echo'<a href="cargaHoraria.php?selec='.$_GET['selec'].'&cursos='.$_GET['cursos'].'&pg=alterar&id='.$res_1['id_disciplinas'].'"><img border="0" src="../image/deleta.png" width="22" /></a>';
           echo "</td>";
         }else{

            echo ' <td>
            <div class="row">
            
            <label for="">1
            <input type="checkbox"  name="check[]" value="'.$res_1['id_disciplinas'].';1">
            </label>
            <label for="">2
            <input type="checkbox"   name="check[]" value="'.$res_1['id_disciplinas'].';2">
            </label>
            <label for="">3
            <input type="checkbox"   name="check[]" value="'.$res_1['id_disciplinas'].';3">
            </label>
            <label for="">4
            <input type="checkbox"  name="check[]" value="'.$res_1['id_disciplinas'].';4">
            </label>
            <label for="">5
            <input type="checkbox"  name="check[]" value="'.$res_1['id_disciplinas'].';5">
            </label>
            </div>
         </td>  ';
         }?>
         
         </tr>
     </table>

     
     <?php
     
 }/// foreach
?>
<input type="submit" class="btn btn-primary" name="inserir" id="" value="Inserir dados"
                    onclick="alert('concluindo!');">
        </form>
<?php
 
}///if verifica resultado


}///if ´post
        }else{
            echo "<p>Selecione uma categoria para fazer a busca!!</p>";
        }///primeiro if 
?>
</div>

</body>
</html>           

<?php

if(@$_POST['inserir'])
{
 $dados=$_POST['check'];
 $selec=$_POST['selec'];
 $curso=$_POST['cursos'];
 foreach($dados as $dado)
 {
    $array=explode(';', $dado);
    $atualizaCarga=$pdo->prepare('UPDATE disciplinas SET cargaHoraria_diaria=:carga where id_disciplinas=:id');
    $atualizaCarga->bindValue('carga',$array[1]);
    $atualizaCarga->bindValue('id',$array[0]);
    $atualizaCarga->execute();
 }
 echo "<script language='javascript'>window.location='cargaHoraria.php?selec=$selec&cursos=$curso';</script>";
}


if(@$_GET['pg']=="alterar"){
    $id=$_GET['id'];
    $selec=$_GET['selec'];
    $curso=$_GET['cursos'];
    $atualizaCarga=$pdo->prepare('UPDATE disciplinas SET cargaHoraria_diaria=:carga where id_disciplinas=:id');
    $atualizaCarga->bindValue('carga','0');
    $atualizaCarga->bindValue('id',$id);
    $atualizaCarga->execute();
 
 echo "<script language='javascript'>window.location='cargaHoraria.php?selec=$selec&cursos=$curso';</script>";
}

?>