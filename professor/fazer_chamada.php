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
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers td {
            width:30%;
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
    $ano=Date('Y');
     date_default_timezone_set('America/Sao_Paulo');
     function data($data){
        return date("d-m-Y", strtotime($data));
    }

    $hoj=Date('Y-m-d');
    $a=Date('Y');
    if(@$_GET['cha']){
        $date_hoje=@$_GET['cha'];
        $datas=@$_GET['cha'];
        $time=$_GET['cha'];        
        // $date_hoje =data($datas);
      }else{
        $datas=$hoj;
        $time=$hoj;        
        $date_hoje=$datas;

      }
    ?>
    
    <div id="caixa_preta">
    </div>
    <!-- caixa_preta -->

    <div id="box">


        <h1>Turma: <strong>
                <?php $curso = base64_decode($_GET['curso']);
                $dis=base64_decode($_GET['dis']);
                $num=0; 
                $buscaCurso=$pdo->query("SELECT l.nome,c.curso,c.turno from cursos c inner join disciplinas d on d.id_cursos=c.id_cursos inner join lista_disc l on l.id_lista=d.disciplina where d.id_disciplinas='$dis'");
                $buscaCurso=$buscaCurso->fetchAll(PDO::FETCH_ASSOC);
                $busca=count($buscaCurso);        
    if($busca>0){
        foreach($buscaCurso as $key=>$resCurso){
          $cursos=$resCurso['curso'];
          $turno=$resCurso['turno'];
          $disciplina=$resCurso['nome'];
    }
    echo $cursos.'  '."".$turno;
    }else{
            ?><script>
                alert('erro ao buscar os cursos');
                </script><?php
      }
      
      ?></strong>
            <form>
                <div class="">
                    <label for="festa">Escolha uma data:</label>
                    <input type="date" id="festa" onchange="submit();" name="cha" min="<?php echo $a;?>-01-01"
                        max="<?php echo $hoj;?>" value="<?php echo @$time; ?>" required>
                    <span class="validity"></span>
                    <input type="hidden" name="curso" value="<?php echo $_GET['curso']; ?>">
                    <input type="hidden" name="dis" value="<?php echo $_GET['dis']; ?>">
                    <label for="fest">Bimestre:</label>
                    <select name="bimestre" id="" class="">
                    <?php if(@$_GET['bimestre']){
                       echo '<option value="'.$_GET['bimestre'].'">'.$_GET['bimestre'].'º bimestre</option>'; 
                    }
                    $bimestre=$pdo->query('SELECT * FROM unidades');
                    $bimestre=$bimestre->fetchAll();
                    foreach($bimestre as $value)
                    {
                        echo '<option value="'.$value['unidade'].'">'.$value['unidade'].'º bimestre</option>'; 
                    }
                    ?>
                    </select>
                </div>
            </form>
          
            <h1>disciplina:
                <?php echo $disciplina; ?>
                <!-- <a background-color="blue" id="h1_a" rel="superbox[iframe][900x500]" href="fazer_rapida.php?curso=<php echo $_GET['curso'];?>&dis=<php echo $_GET['dis'];?>&turno=<php echo $_GET['turno'];?>"><img title="chamada rapida" border="0" src="../image/confirma.png" width="50" /></a> -->
            </h1>
            <?php

$date = date("d/m/Y H:i:s");
$dis = base64_decode($_GET['dis']);

    $sql_1=$pdo->prepare("SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos=:cursos and e.status='Ativo' and ce.ano_letivo='$ano' order by nome asc");
    $sql_1->bindValue(':cursos',$curso);
    $sql_1->execute();
    $dados=$sql_1->fetchAll();
    $resultado=count($dados);
if($resultado==0 ){
	 echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
}else if($resultado>=1){
 foreach ($dados as $res_1) {
     $code_aluno = $res_1['matricula'];
     $num=$num+1;
?>

            <form name="button" method="POST" enctype="multipart/form-data" action="">

                <table id="customers" border="0">
                    <tr>
                        <th width="94"><strong>Código:</strong></th>
                        <th width="350"><strong>Nome:</strong></th>
                        <th colspan="4"><strong>Falta? <?php //echo $num;?></strong></th>
                        
                    </tr>
                    <input type="hidden" name="curso" value="<?php echo  base64_encode($curso); ?>">
                    <input type="hidden" name="dis" value="<?php echo  base64_encode($dis); ?>">
                    <input type="hidden" name="bimestre" value="<?=@$_GET['bimestre']; ?>">
                    <input type="hidden" name="dis" value="<?php echo  base64_encode($dis); ?>">
                    <tr>
                        <td>
                            <?php echo $res_1['matricula']; ?><input type="hidden" name="code_aluno"
                                value="<?php echo $res_1['matricula']; ?>" /></td>
                        <td>
                            <?php echo $res_1['nome']; ?><input type="hidden" name="nome"
                                value="<?php echo $res_1['nome']; ?>" /></td>
                        <input type="hidden" name="data" value="<?php echo @$_GET['cha']; ?>">
                        <?php 
                            $sql_chamada=$pdo->prepare("SELECT * FROM chamadas_em_sala WHERE date_day = :data AND id_disciplinas =:dis AND matricula =:code");
                            $sql_chamada->bindValue(':data',$date_hoje);
                            $sql_chamada->bindValue(':dis',$dis);
                            $sql_chamada->bindValue(':code',$code_aluno);
                            $sql_chamada->execute();
                            $dados_chamada=$sql_chamada->fetchAll();
                            $qtde_chamada=count($dados_chamada);                   

                        if($qtde_chamada==0){
    ?>      
                        <td colspan="4">
                        
                        <div class="switch">

                            <input type="checkbox" name="check" class="check"
                                value="true">
                            <label for="option"><span></span></label>
                            </div>   
                            <div class="row">
                            <?php $verif=$pdo->query("SELECT cargaHoraria_diaria FROM disciplinas where id_disciplinas=".$dis);                            
                                $verif=$verif->fetch();
                                 $v=$verif[0]+1;
                                 for ($i=1; $i <$v ; $i++) { 
                                     # code...
                                     echo' <label class="opcao">'.$i.'
                                     <input type="checkbox" name="checkbox[]" class="opcao"  id="ok1" value="'.$code_aluno.';'.$i.'" />
                                         </label>';
                                 }
                                ?>
                           
                                <!-- <label class="opcao"> 2
                            <input type="checkbox" name="checkbox[]" class="opcao" id="ok2"  value="<= $code_aluno.';2';?>"/>
                                </label>
                                <label class="opcao"> 3
                            <input type="checkbox" name="checkbox[]" class="opcao" id="ok3"  value="<= $code_aluno.';3';?>"/>
                                </label>
                                <label class="opcao"> 4
                            <input type="checkbox" name="checkbox[]" class="opcao"  id="ok4" value="<= $code_aluno.';4';?>"/>
                                </label> -->
                                <label class="opcao"> FJ
                            <input type="checkbox" name="checkbox2[]" class="opcao" value="<?= $code_aluno.';FJ';?>"/>
                                </label>
                                </div>   
   
    
   

                            </td>
                            <script>
    
    $(".check").click(function(){
        var n=(this).value;
        if(n=="true"){
            $(".opcao").css("display","block");
            $(".switch").css("display","none");
            $(this).val("false");
        }
            else{
                $(".opcao").css("display","block");
                    $(this).val("true");
            }
            
        
        });

    </script>
                       
                        <?php 
      
       
          }//fechamento do if falta
         else{ ?>
                        <td>
                            <?php           
           foreach($dados_chamada as $mostrar_chamada){
                    echo $mostrar_chamada['falta']." ".$mostrar_chamada['obs'];
                    $chamada=$mostrar_chamada['id'];
                    $data=$mostrar_chamada['date_day'];
                    $q_c=$q_c+1;
           }
           ?>
                        </td>
                        <td width="62">
                            <a
                                href="fazer_chamada.php?selec=nadaselecionado&pg=excluir&curso=<?php echo $_GET['curso']?>&dis=<?php echo $_GET['dis']?>&cha=<?php echo base64_encode($chamada); ?>&data=<?=$data;?>"><img
                                    border="0" src="../image/deleta.png" width="22" /></a>
                        </td>

                        <?php }
         ?>

                    </tr>
                </table>


                <?php }

?>
                <input type="submit" class="btn btn-primary" name="inserir" id="" value="Guardar"
                    onclick="alert('concluindo chamada');">
            </form>
            <?php 
  if(isset($_POST['inserir'])=='Guardar'){
// $code_aluno = $_GET['code_aluno'];	
// $nome = $_GET['nome'];	
$curso =base64_decode($_POST['curso']);
$bimestre=$_POST['bimestre'];

$c=$_GET['curso'];
// @$presensa = $_GET['presenca'];
$ano=Date('Y');
$disc=base64_decode($_POST['dis']);
$d=$_GET['dis'];
$datahoje=@$_POST['data'];
$busca_bimestre=$pdo->prepare('SELECT * FROM unidades where status=:status');
$busca_bimestre->bindValue(':status','ativa');
$busca_bimestre->execute();
$unidades=$busca_bimestre->fetchAll();
$unidade=count($unidades);

if($unidade==0){
    ?><script>alert('Nenhum Bimestre criado, entre em contato com o administrador!');</script><?php
    
echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$c&dis=$d&cha=$datahoje';</script>";
}else{
// if($presensa == ''){
// 	echo "<script language='javascript'>window.alert('Por favor, informe se este aluno está presente ou não na sala de aula!');</script>";
// }else if($presensa=='SIM'){
// $sql_4 = "INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo) VALUES ('$date', '$date_hoje','$dis', '$code_aluno', '$presensa','$ano')";	
// $insere=mysqli_query($conexao, $sql_4);
// if($insere){
// 	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc; ?';</script>";

//   }else{
//   ? 
//     <script>
//     alert('Erro ao inserir a chamada');
//     </script>
//   <?php
//   }
// }


$chgeckboxes = @$_POST['checkbox'];
$chgeckboxes2 = @$_POST['checkbox2'];
echo count($chgeckboxes);
echo "<br/>";

    # code...
  
foreach($chgeckboxes as $ch){
    $dados= explode(";", $ch);
       # code...
       echo $dados[0]."\n";
       
   


}


  $busca_aluno =$pdo->prepare("SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos=:curso and e.status='Ativo' order by e.nome asc");
        $busca_aluno->bindValue(':curso',$curso);
        $busca_aluno->execute();
        $dados= $busca_aluno->fetchAll();
         foreach($dados as $res_2){
           $code_a = $res_2['matricula'];
           $sql_chamada2 = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND id_disciplinas = '$dis' AND matricula = '$code_a' and bimestre='$unidade'";
                 $con_chamada= mysqli_query($conexao, $sql_chamada2);
                 if(mysqli_num_rows($con_chamada)==''){
                  
                $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, falta, ano_letivo,bimestre,responsavel) VALUES ('$date', '$date_hoje','$dis', '$code_a', '0','$ano','$bimestre','professor')";
                mysqli_query($conexao, $query);
                
                   
                 }
}
foreach($chgeckboxes AS $dados ){      
    $dado= explode(";", $dados); 
  
    $res=$pdo->prepare("UPDATE `chamadas_em_sala` SET `falta` =:situacao WHERE date_day=:d and matricula=:code and id_disciplinas=:dis and ano_letivo=:ano and bimestre=:unidade");
      $res->bindvalue(":d",$date_hoje);
      $res->bindvalue(":dis",$dis);
      $res->bindvalue(":unidade",$unidade);
      $res->bindvalue(":code",$dado[0]);
      $res->bindvalue(":situacao",$dado[1]);
      $res->bindvalue(":ano",$ano);
      $res->execute();
 
}
foreach($chgeckboxes2 AS $just ){      
    $justificada= explode(";", $just);
    $res=$pdo->prepare("UPDATE `chamadas_em_sala` SET `obs` =:situacao WHERE date_day=:d and matricula=:code and id_disciplinas=:dis and ano_letivo=:ano and bimestre=:unidade");
      $res->bindvalue(":d",$date_hoje);
      $res->bindvalue(":dis",$dis);
      $res->bindvalue(":unidade",$unidade);
      $res->bindvalue(":code",$justificada[0]);
      $res->bindvalue(":situacao",$justificada[1]);
      $res->bindvalue(":ano",$ano);
      $res->execute();
 

}
      


echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$c&dis=$d&cha=$datahoje&c';</script>";
 
}

}?>



            <?php 
if(isset($_GET['pg'])=='excluir'){

$chamada= base64_decode($_GET['cha']);	
$curso = $_GET['curso'];
$ano=Date('Y');
$datahoje=@$_GET['data'];
$res = $pdo->prepare("delete from chamadas_em_sala where id=:id ");

$res->bindValue(":id", $chamada);
$res->execute();
$disc=($_GET['dis']);

	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc&cha=$datahoje';</script>";
  }

 ?>




            <!-- <!  alterar falta ou colocar falta> -->
            <?php 

}else{ echo "";}
?>

    </div>
    <!-- box -->

    <?php require "rodape.php"; ?>

</body>

</html>

