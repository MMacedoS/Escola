<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>
<title>Provas</title>

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
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:17%;
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
<?php if(isset($_GET['pg']) && $_GET['pg'] == 'notas'){
    $selec=$_GET['selec'];
    $code=$_GET['code'];
 ?>
<!-- <div class="row" id="row_button">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_atividades.php?tipo=atividade_bimestral&code=php echo $id_professor; ?>">Cadastrar Atividade</a>
<br /><a class="a3" rel="stylesheet" href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=php echo $selec;?>">Atualizar Pagina</a>
</div> -->
<script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="todas_notas.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>

<!--  -->
 <h1>Abaixo segue seu histórico de atividades bimestrais de suas turmas!</h1>
  <?php $res='<div id="resultado"/>';?>
<?php

if(isset($_GET['selec'])){
$ensino=$_GET['selec'];
if(isset($_GET['busca'])){
  $res=$_GET['busca'];
  $sql_1  = "SELECT DISTINCT l.nome,d.*,c.* FROM disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina  INNER JOIN cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' ";

}else{
 $sql_1  = "SELECT DISTINCT l.nome,d.*,c.* FROM disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina  INNER JOIN cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' and cat.id_categoria='$ensino' ";
}// fim if busca
 }else{

 $sql_1 = "SELECT DISTINCT l.nome,d.*,c.* FROM disciplinas d INNER JOIN lista_disc l on l.id_lista=d.disciplina inner join cursos c ON c.id_cursos=d.id_cursos INNER JOIN categoria cat on cat.id_categoria=c.id_categoria INNER JOIN professores p on p.id_professores=d.id_professores where p.code='$code' and cat.id_categoria='$ensino'";
 }
$result = mysqli_query($conexao, $sql_1);

if(mysqli_num_rows($result)==''){
	 echo '<h2><font color="blue">No momento não existe!</font></h2>';	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
    // echo $sql_1;
?> 
<table id="customers" border="0">
  <tr>
    <th>Disciplina</th>
    <th>Curso</th>
    <th>Quantidade de Aluno</th>
    <th></th>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['nome'];  ?></h3></td>
    <td><h3><?php echo $res_1['curso']; ?></h3></td>
    <td><h3><?php $DIS=$res_1['id_cursos'];
    $buscaDisc="SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$DIS' and e.status='ativo'";
    $conDisc=mysqli_query($conexao,$buscaDisc);
    echo mysqli_num_rows($conDisc);
    ?></h3></td>
    <td colspan="3"><a href="lancar_notas.php?pg=notas&selec=<?php echo $_GET['selec']; ?>&id=<?php echo $res_1['id_disciplinas']; ?>"><font color="blue">Visualizar média</font></a></td>
   
  </tr>  
  </table> 
 
<?php }}}

if(isset($_GET['pg']  ) && $_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

// $sql_2 = "DELETE FROM atividades_bimestrais WHERE id = '$id'";
// mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_ativ_tarefas.php?pg=atividades_bimestrais'&selec=".$_GET['selec']."';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>