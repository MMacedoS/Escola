<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="with=device-width,initial-scale=1">
    <title>Chamada</title>

    <link rel="shortcut icon" href="../image/logo_ist.gif">
    <link rel="stylesheet" type="text/css" href="css/fazer_chamada.css" />
</head>

<body>

    <?php require_once ("topo.php"); $q_c=0;
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
    $buscaCurso="SELECT * from cursos where id_cursos='$curso'";
    $busca=$conCurso=mysqli_query($conexao,$buscaCurso);
    if($busca){
    while($resCurso=mysqli_fetch_assoc($conCurso)){
          $cursos=$resCurso['curso'];
          $turno=$resCurso['turno'];
    };echo $cursos.'  '."".$turno;}else{
            ?><script>
                alert('erro ao buscar os cursos');
                </script><?php
      }
      
      ?></strong>
            <form>
                <div>
                    <label for="festa">Escolha uma data:</label>
                    <input type="date" id="festa" onchange="submit();" name="cha" min="<?php echo $a;?>-01-01"
                        max="<?php echo $hoj;?>" value="<?php echo @$time; ?>" required>
                    <span class="validity"></span>
                    <input type="hidden" name="curso" value="<?php echo $_GET['curso']; ?>">
                    <input type="hidden" name="dis" value="<?php echo $_GET['dis']; ?>">
                    <input type="hidden" name="selec" value="">
                </div>
            </form>
          
            <h1>disciplina:
                <?php $dis=base64_decode($_GET['dis']);
   $buscaDis="SELECT l.nome FROM disciplinas d inner join lista_disc l on d.disciplina=l.id_lista where d.id_disciplinas='$dis'";
   $conDis=mysqli_query($conexao,$buscaDis);
   while($resDisc=mysqli_fetch_assoc($conDis)){
        echo $resDisc['nome'];
   }
   ?>
                <!-- <a background-color="blue" id="h1_a" rel="superbox[iframe][900x500]" href="fazer_rapida.php?curso=<?php echo $_GET['curso'];?>&dis=<?php echo $_GET['dis'];?>&turno=<?php echo $_GET['turno'];?>"><img title="chamada rapida" border="0" src="../image/confirma.png" width="50" /></a> -->
            </h1>
            <?php

$date = date("d/m/Y H:i:s");
$dis = base64_decode($_GET['dis']);

    $sql_1=$pdo->prepare("SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos=:cursos order by nome asc");
    $sql_1->bindValue(':cursos',$curso);
    $sql_1->execute();
    $dados=$sql_1->fetchAll();
    $resultado=count($dados);
if($resultado==0 ){
	 echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
}else if($resultado>=1){
 foreach ($dados as $res_1) {
	 $code_aluno = $res_1['matricula'];
?>

            <form name="button" method="POST" enctype="multipart/form-data" action="">

                <table class="users" id="table-responsive" border="0">
                    <tr>
                        <th width="94"><strong>Código:</strong></th>
                        <th width="350"><strong>Nome:</strong></th>
                        <th colspan="2"><strong>Presente?</strong></th>
                        <th colspan="2"><strong></strong></th>
                        <th></th>
                    </tr>
                    <input type="hidden" name="curso" value="<?php echo  base64_encode($curso); ?>">
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
                        <td width="315">
                            <div class="switch">

                                <input type="checkbox" name="checkbox[]" id="option"
                                    value="<?php echo $res_1['matricula']; ?>">
                                <label for="option"><span></span></label>
                            </div>

                        </td>
                        <td><strong></strong></td>
                        <td><strong></strong></td>
                        <?php 
      
       
          }//fechamento do if falta
         else{ ?>
                        <td>
                            <?php echo "presença: "; 
          
           foreach($dados_chamada as $mostrar_chamada){
                    echo $mostrar_chamada['presente'];
                    $chamada=$mostrar_chamada['id'];
                    $q_c=$q_c+1;
           }
           ?>
                        </td>
                        <td width="62">
                            <a
                                href="fazer_chamada.php?selec=nadaselecionado&pg=excluir&curso=<?php echo $_GET['curso']?>&dis=<?php echo $_GET['dis']?>&cha=<?php echo base64_encode($chamada); ?>"><img
                                    border="0" src="../image/deleta.png" width="22" /></a>
                        </td>

                        <?php }
         ?>

                    </tr>
                </table>


                <?php }

?>
                <input type="submit" class="btn btn-primary" name="inserir" id="" value="Inserir dados"
                    onclick="alert('chamada efetuada');">
            </form>
            <?php 
  if(isset($_POST['inserir'])=='Guardar'){
// $code_aluno = $_GET['code_aluno'];	
// $nome = $_GET['nome'];	
$curso =base64_decode($_POST['curso']);

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
$chgeckboxes1 = @$_GET['checkboxf'];
$chgeckboxes2 = @$_GET['checkboxj'];



  $busca_aluno =$pdo->prepare("SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos=:curso order by e.nome asc");
        $busca_aluno->bindValue(':curso',$curso);
        $busca_aluno->execute();
        $dados= $busca_aluno->fetchAll();
         foreach($dados as $res_2){
           $code_a = $res_2['matricula'];
           $sql_chamada2 = "SELECT * FROM chamadas_em_sala WHERE date_day = '$date_hoje' AND id_disciplinas = '$dis' AND matricula = '$code_a' and bimestre='$unidade'";
                 $con_chamada= mysqli_query($conexao, $sql_chamada2);
                 if(mysqli_num_rows($con_chamada)==''){
                  
                $query ="INSERT INTO chamadas_em_sala (date, date_day, id_disciplinas, matricula, presente, ano_letivo,bimestre) VALUES ('$date', '$date_hoje','$dis', '$code_a', 'SIM','$ano','$unidade')";
                mysqli_query($conexao, $query);
                   
                 }
}
if(!empty($chgeckboxes)){
  foreach( $chgeckboxes AS $dado ){      
      
    $res=$pdo->prepare("UPDATE `chamadas_em_sala` SET `presente` =:situacao WHERE date_day=:d and matricula=:code and id_disciplinas=:dis and ano_letivo=:ano and bimestre=:unidade");
      $res->bindvalue(":d",$date_hoje);
      $res->bindvalue(":dis",$dis);
      $res->bindvalue(":unidade",$unidade);
      $res->bindvalue(":code",$dado);
      $res->bindvalue(":situacao",'FALTA');
      $res->bindvalue(":ano",$ano);
      $res->execute();

}
      
}
echo "<script language='javascript'>alert('Chamada efetuada');</script>";
echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$c&dis=$d&cha=$datahoje';</script>";
 
}

}?>



            <?php 
if(isset($_GET['pg'])=='excluir'){

$chamada= base64_decode($_GET['cha']);	
$curso = $_GET['curso'];
$ano=Date('Y');
$res = $pdo->prepare("delete from chamadas_em_sala where id=:id ");

$res->bindValue(":id", $chamada);
$res->execute();
$disc=($_GET['dis']);
	echo "<script language='javascript'>window.location='fazer_chamada.php?curso=$curso&dis=$disc';</script>";
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