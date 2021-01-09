<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Atividades</title>
<link rel="shortcut icon" href="../image/logo.png">
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
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
            width:2%;
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

<?php require "topo.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $selec=$_GET['selec'];
  $ano_letivo=$_GET['ano'];

}
else{
  $id=$_POST['id'];
}



$busca_prova=$pdo->query("SELECT id_disciplina from atividades_bimestrais where id_ativ_bim='$id'");
$busca_prova=$busca_prova->fetchAll(PDO::FETCH_ASSOC);
// $busca_prova="SELECT id_disciplina from atividades_bimestrais where id_ativ_bim='$id'";
// $con_busca=mysqli_query($conexao,$busca_prova);
foreach ($busca_prova as $key =>$res_busca) {
  # code...
$disciplina=$res_busca['id_disciplina'];}?>
<?php 
$buscaDis=$pdo->query("SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$disciplina'");
// $buscaDis="SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$disciplina'";
$buscaDis=$buscaDis->fetchAll(PDO::FETCH_ASSOC);
foreach ($buscaDis as $key => $resDis) {
  # code...

  $disc=$resDis['nome'];
  $curso=$resDis['curso'];
}
 ?>
<script type="text/javascript">
function setFocus() {
  document.getElementById("button").focus(); 
}
</script> 
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box" onLoad="setFocus()">
<div class="div-responsive">
<br>
<h1><a class="a3" rel="stylesheet" id="carrega" href="correcao_atividades.php?pg=atividade_bimestral&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo, segue os alunos desta disciplina:  <?php echo $disc."  ".$curso;?>.       <h1>Lançar a nota da 1ª Ava</h1></h1>
<div id="mensagem"></div>
 <div id="listar">
          
   </div>
</div><!--- div responsive-->





</div><!-- box -->

<?php if(isset($_GET['button'])){



}///primeiro if
?> 

<script type="text/javascript">
    $(document).ready(function(event){     
            var u_id=<?=$id?>;
            var u_selec=<?=$selec?>;
            var u_disci=<?=$disciplina?>;
            var u_ano=<?=$ano_letivo?>;
            // window.alert(u_id);
            $.ajax({
            url:"ajax/listar_atividades.php",
            method: 'GET',
            data: {id:u_id,botao:u_selec,ano:u_ano,disciplina:u_disci},
            datatype:'json',
            success:function(result){
                $('#listar').html(result)
            },
              })        
    })

</script>
<script type="text/javascript">
    $('#carrega').click(function(event){
        event.preventDefault();     
            var u_id=<?=$id?>;
            var u_selec=<?=$selec?>;
            var u_disci=<?=$disciplina?>;            
            var u_ano=<?=$ano_letivo?>;
            // window.alert(u_id);
            $.ajax({
            url:"ajax/listar_atividades.php",
            method: 'GET',
            data: {id:u_id,botao:u_selec,ano:u_ano,disciplina:u_disci},
            datatype:'html',
            success:function(result){
                $('#listar').html(result)
            },
              })        
  })
</script>

<?php require "rodape.php"; ?>


<body>
</body>
</html>


