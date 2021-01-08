<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <title>Chamada</title>
    
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


        <h1>Turma: <strong>
            <?php
                $curso = base64_decode($_GET['curso']);
               
                $buscaCurso="SELECT * from cursos where id_cursos='$curso'";
                $busca=$conCurso=mysqli_query($conexao,$buscaCurso);
                if($busca){
                        while($resCurso=mysqli_fetch_assoc($conCurso)){
                        $cursos=$resCurso['curso'];
                        $turno=$resCurso['turno'];
                };
                echo $cursos.'  '."".$turno;

                }else{
                ?>
                <script>
                    alert('erro ao buscar os cursos');
                    </script><?php
                }

                ?></strong>
                <p>Alunos em conselho de Classe</p>
        
            <div class="table-responsive" id="resultado"></div>
             
            </form>
            <?php 
  if(isset($_GET['inserir'])=='Guardar'){



      var_dump($_GET['checkbox']);


// echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$c&dis=$d&cha=$datahoje&c';</script>";
 


}?>


    </div>
    <!-- box -->


    <script>
        var selec="<?=$_GET['selec']?>"
        var turma="<?=base64_decode($_GET['curso'])?>";
        $.ajax({
            url:'ajax/lista_conselho.php',
            method:'get',
            data: {selec:selec,turma:turma},
            datatype:'json',
            success:function(res){
                $('#resultado').html(res);
            }

        })
        
    </script>
    <script>
        $('#inserir').click(function(event){
            event.preventDefault();
            console.log('opaa');
        });
    </script>

    

    <?php require "rodape.php"; ?>

</body>

</html>



