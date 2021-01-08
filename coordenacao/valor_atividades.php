<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <title>Chamada</title>
    
    <link rel="shortcut icon" href="../image/logo.png">
    <!-- <link rel="stylesheet" type="text/css" href="css/fazer_chamada.css" /> -->
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

        <?php if(@$_GET['selec'] || @$_GET['selet']){
            $selec=@$_GET['selec'];
            
            ?>

            <form action="" id="form" name="form" method="GET">
        <label for="">Selecione uma categoria:</label>
        <select name="categoria" id="categoria">
            <!-- <option value=" ">Turmas</option> -->
            
          <option value="<?=@$selec?>"><?=@$selec;?></option>
        </select>
        
        <input type="submit" id="botao" name="botao" value="Busca">        
        </form>
       <br>
       <div id="mensagem" class="col-md-12 text-center" role="alert">

       
       </div>
       <br>

       <div id="listar">

       </div>
</div>
        <?php }?>
        
       
</body>
</html>           

<?php

if(@$_POST['inserir'])
{
?>

    <script>
        window.alert('opaaaa');
    </script>
<?php
}


if(@$_POST['pg']=="alterar"){
//     $id=$_GET['id'];
//     $selec=$_GET['selec'];
//     $curso=$_GET['cursos'];
//     // $atualizaCarga=$pdo->prepare('UPDATE disciplinas SET cargaHoraria_diaria=:carga where id_disciplinas=:id');
//     // $atualizaCarga->bindValue('carga','0');
//     // $atualizaCarga->bindValue('id',$id);
//     // $atualizaCarga->execute();
 
//  echo "<script language='javascript'>window.location='cargaHoraria.php?selec=$selec&cursos=$curso';</script>";
}

?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#botao').click(function(event){
            event.preventDefault();
            var u_name=$('#categoria').val();
            var u_situacao=$('#botao').val();
            // window.alert(u_situacao);
            $.ajax({
            url:"ajax/listar.php",
            method: 'GET',
            data: {categoria:u_name,botao:u_situacao},
            datatype:'json',
            success:function(result){
                $('#listar').html(result)
            },
              })


        });
        
    })

</script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#inserir').click(function(event){
            event.preventDefault();
            var u_name=$('#categoria').val();
            var u_situacao=$('#inserir').val();
            window.alert(u_situacao);
            // $.ajax({
            // url:"ajax/listar.php",
            // method: 'POST',
            // data: {categoria:u_name,botao:u_situacao},
            // datatype:'json',
            // success:function(result){
            //     $('#listar').html(result)
            // },
            //   })


        });
        
    })

</script> -->
<!-- $('#alterar').click(function(event){
            event.preventDefault();
            var u_name=$('#categoria').val();
            var u_situacao=$('#botao').val();
            // window.alert(u_situacao);
            $.ajax({
            url:"ajax/listar.php",
            method: 'GET',
            data: {categoria:u_name,botao:u_situacao},
            datatype:'json',
            success:function(result){
                $('#listar').html(result)
            },
              })


        });

        $('#inserir').click(function(event){
            event.preventDefault();
            var u_name=$('#categoria').val();
            var u_situacao=$('#botao').val();
            // window.alert(u_situacao);
            $.ajax({
            url:"ajax/listar.php",
            method: 'GET',
            data: {categoria:u_name,botao:u_situacao},
            datatype:'json',
            success:function(result){
                $('#listar').html(result)
            },
              })


        }) -->