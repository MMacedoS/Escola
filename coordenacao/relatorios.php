<?php header('Content-Type: text/html; charset=UTF-8');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
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
            width:1%;
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
<!-- <script src="js/jquery-3.5.1.min.js"></script> -->
<body>   

<?php
include_once "topo.php";?>

<script language="JavaScript">
function refresh() 
{    // nome_do_form.action -->
    rel.action="relatorios.php";      //<!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    rel.submit();
}
</script>



<div id="box">
<form id="" name="rel" >

<?php $selec=@$_GET['selec']; ?>
    <div class="row col-sm-12 text-center d-flex justify-content-center">
        <div class="row col-sm-2 mt-2">
            <div class="form-group">
                    <label for="">Turma</label>
                    <select class="form-control" name="turma" id="turma">
                        <option value="">Selecione</option>
                    <?php
                        $sql_2 = mysqli_query($conexao, "SELECT * FROM cursos c inner join categoria cat on cat.id_categoria=c.id_categoria where cat.id_categoria=".$_GET['selec']);
                            while($res_2 = mysqli_fetch_assoc($sql_2)){
                        ?>
                        <option value="<?php echo $res_2['id_cursos']; ?>"><?php echo $res_2['curso']; ?></option>      
                        
                        <?php } ?>
                    </select>

            </div>
            <!-- </td>
            <td colspan="3"> -->
            
            
        </div>
        <div class="row col-sm-2 mt-2">
            <div class="form-group">
                    <label for="">Bimestre</label>
                    <select class="form-control" name="bimestre" id="bimestre">
                    <?php
                            $sql_2 = mysqli_query($conexao, "SELECT unidade FROM unidades");
                                while($res_2 = mysqli_fetch_assoc($sql_2)){
                            ?>
                            <option value="<?php echo $res_2['unidade']; ?>"><?php echo $res_2['unidade'];?></option>      
                            
                            <?php } ?>
                    </select>

            </div>
            <!-- </td>
            <td colspan="3"> -->
            
            
        </div>

        <div class="row col-sm-2 mt-2">
            <div class="form-group">
                    <label for="">Ano Letivo</label>
                   <input class="form-control" type="number" name="ano" id="ano" value="<?=date('Y');?>">
            </div>
                       
        </div>
        <div class="row col-sm-4 mt-2 ml-2 mr-2">
            <div id="disciplina">    
            </div>
        </div>

        <div class="row col-sm-2 mt-2 ">
        <label for="">Situação</label>
                    <select class="form-control" name="situacao" id="situacao">
                    <option value="AP">Aprovado</option>
                    <option value="RP">Reprovado</option>
                    <option value="AP_ano">Aprovados do Ano</option>
                    <option value="RP_ano">Reprovados do Ano</option>
                    </select>

            </div>                        
     
        
    </div>
    <div class="row mt-5">
       <div class="form-group">
            
                <button class="float-right btn btn-success" id="filtro" type="submit">Buscar</button>
            

        </div>
   
</form>

  
</div>

<?php

include_once "rodape.php";
?>

</body>
</html>
<script>
    $('#turma').change(function(){
        var turma=$('#turma').val();
        var opcao=1;
        // window.alert(turma);
        $.ajax({
            url:'ajax/busca_relatorio.php',
            method:'GET',
            data:{turma:turma,opcao:opcao},
            datatype:'html',
            success:function(result){
                $('#disciplina').html(result)
            },
        })

    })
</script>

<script>
    $(document).ready(function(){
        $.ajax({
            url:'ajax/busca_relatorio.php',
            method:'GET',
            datatype:'html',
            success:function(result){
                $('#disciplina').html(result)
            },
        })
    })

</script>

<script>
    $('#filtro').click(function(event){
        event.preventDefault();
        
        var u_turma=$('#turma').val();
        var u_disciplina=$('#alunos').val();
        var u_bimestre=$('#bimestre').val();
        var u_situacao=$('#situacao').val();
        var u_ano=$('#ano').val();
        // console.log(u_bimestre,u_turma,u_alunos,u_situacao);
        window.location.assign("alunos.php?turma="+u_turma+"&disciplinas="+u_disciplina+"&bimestre="+u_bimestre+"&situacao="+u_situacao+"&ano="+u_ano);

    })
</script>


