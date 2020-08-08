<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Suporte Escolar</title>
<link rel="shortcut icon" href="../image/logo.png">
<link rel="stylesheet" type="text/css" href="css/suporte_tecnico.css"/>
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       .customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        
        .customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .text-overflow-dynamic-container {
    position: relative;
    max-width: 100%;
    padding: 0 !important;
    display: -webkit-flex;
    display: -moz-flex;
    display: flex;
    vertical-align: text-bottom !important;
}
.text-overflow-dynamic-ellipsis {
    position: absolute;
    white-space: nowrap;
    overflow-y: visible;
    overflow-x: hidden;
    text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    max-width: 100%;
    min-width: 0;
    width:100%;
    top: 0;
    left: 0;
}
.text-overflow-dynamic-container:after,
.text-overflow-dynamic-ellipsis:after {
    content: '-';
    display: inline;
    visibility: hidden;
    width: 0;
}

        .diminuir {
          display: block;
          white-space: normal;
          overflow: hidden;
          text-overflow: ellipsis;
          height: 40px;          
          
        }
        .customers th {
            width:31%;
        }
        
        .customers tr:nth-child(even){background-color: #f2f2f2;}
        
        .customers tr:hover {background-color: #ddd;}
        
        .customers th {
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
 <h1><strong>Histórico de chamados</strong></h1>
 <a href="suporte_tecnico.php?acao=abrir_chamado&selec=<?php echo @$_GET['selec'];?>" class="a_1">Abrir chamado</a>
 <table class="customers" border="0">
<?php if(@$_GET['acao'] == 'abrir_chamado'){ $ano=Date('Y');?>

  <tr>
  <th>	 
     <form name="enviar_mensagem" method="post" action="" enctype="multipart/form-data">
	  Selecione o setor que você quer enviar esta mensagem
     <select name="setor" size="1" id="select">
        <option value="<?php if($_GET['selec']==1){echo "COORDENAÇÃO-2";}else{echo "COORDENAÇÃO-1";}?>" style="background-color:#F3F781;">COORDENAÇÃO</option>
        <option value="" style="background-color:#F3F781;"></option>
       <option value="PROFESSOR">PROFESSORES</option>
       <?php      
		$sql_2 = "SELECT DISTINCT p.code,p.nome from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos INNER JOIN professores p on p.id_professores=d.id_professores where ce.ano_letivo='$ano'";
		$result_2 = mysqli_query($conexao, $sql_2);
			while($res_2 = mysqli_fetch_assoc($result_2)){
        $serie=$res_2['id_cursos'];
	   ?>
        <option value="<?php echo $res_2['code']; ?>" style="background-color:#81F79F;"><?php echo $res_2['nome'] ?></option>
       <?php } ?>
                
       <option value=""><strong> Estudantes</strong></option>
       <?php
       $sql_3 = "SELECT DISTINCT e.matricula,e.nome, c.curso from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos where ce.ano_letivo='$ano' and c.id_categoria=".@$_GET['selec']." and e.status='ativo'";
	   $result_3 = mysqli_query($conexao, $sql_3);
	   	while($res_3 = mysqli_fetch_assoc($result_3)){
	   ?>
        <option value="<?php echo $res_3['matricula']; ?>" style="background-color:#58FAF4;"><?php echo $res_3['nome']; ?></option>
        <?php } ?>
     </select>
     
     <br />Digite sua mensagem
     <textarea name="mensagem"></textarea>
     <input type="hidden" name="selec" value="<?php echo @$_GET['selec'];?>">
	 <input class="input" type="submit" name="enviar_mensagem" value="Enviar" />
     </form>
     <hr>
  </th>
  </tr>
<?php } ?>
  <tr>
    <td  align="left">Abaixo segue seu relatório de chamadas</td>
  </tr>
  <tr>
    <td align="center"><hr></td>
  </tr>
  <tr>
    <th align="center">
    <?php
    $sql_5 = "SELECT * FROM central_mensagem WHERE emissor = 'COORDENAÇÃO-2' or receptor='COORDENAÇÃO-2' order by id desc";
	$result_5 = mysqli_query($conexao, $sql_5);
	if(mysqli_num_rows($result_5) == ''){
		echo "Não existe nenhuma mensagem";
	}else{
	?>
     <table class="customers" border="0">
      <tr>
      <th ><strong>Emissor:</strong></th>
        <th ><strong>Receptor:</strong></th>
        <th ><strong>Status:</strong></th>
        <th ><strong>Data:</strong></th>
      <?php while($res_5 = mysqli_fetch_assoc($result_5)){ ?>
      <tr>
      <td><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><?php $you=$res_5['emissor']; if($you==$code){ echo "VOCÊ";}else{echo $you;}; ?></span></span></td>
      <td><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><?php $you=$res_5['receptor']; if($you==$code){ echo "VOCÊ";}else{echo $you;}; ?></span></span></td>
        <td><span class="text-overflow-dynamic-container">
        <span class="text-overflow-dynamic-ellipsis"><?php echo $res_5['status']; ?></span></span></td>
        <td><?php echo $res_5['date']; ?></td>        
        </tr>
        <tr>
        <td><?php echo $res_5['data_resposta']; ?></td>
        <td><a href="suporte_tecnico.php?acao=responder&id=<?php echo $res_5['id']; ?>"><img src="../image/confirma.png" width="22" border="0" title="responder" /></a></td>
        <td><a href="suporte_tecnico.php?acao=ticket&id=<?php echo $res_5['id']; ?>"><img src="../image/visualizar16.gif"  border="0" title="Vizualizar chamada" /></a> </td>
        <td><a href="suporte_tecnico.php?acao=fechar&id=<?php echo $res_5['id']; ?>"><img src="../image/deleta.png" width="22" border="0" title="Excluir chamado" /></a></td>
        
      
        </th>

        </tr>
      	
      <?php } if(@$_GET['acao'] == 'ticket'){
        $id=$_GET['id'];
        $sql_res = "SELECT * FROM central_mensagem WHERE id='$id'";
        $con_res = mysqli_query($conexao, $sql_res);
        while($res_resp = mysqli_fetch_assoc($con_res)){
        ?>
        <tr>
        <td colspan="6"><hr />
        <?php
        if($res_resp['resposta'] ==''){
			 echo "<h4 class='h4'>Ainda não existe resposta para este chamado!</h4>";
		}else{
			
				 $date = $res_resp['date'];
				 $resposta = $res_resp['resposta'];
				 $mensagem = $res_resp['mensagem'];
			 echo "<h1 class='h1'><strong>Sua mensagem:</strong><br><br>$mensagem</h1>";
       echo "<h1 class='h2'><strong>Data:</strong>$date | </a><br><br>$resposta</h1>";			
       
			
		?>
         <a href="suporte_tecnico.php?acao=responder&novaresposta=sim&id=<?php echo $res_resp['id']; ?>" margin="10">Responder novamente</a>
        </td>
        </tr>
        <?php } ?>
      	<tr><br />
        <td colspan="6"><hr></td>
        </tr>
      <?php }}} ?>
    </table>
    </td>
  </tr>
</table> 
    <?php  ?>
    </td>
  </tr>
</table> 


<?php
if(@$_GET['acao'] == 'responder'){
  $id=$_GET['id'];
  if(isset($_GET['novaresposta'])){$sql_1 = "SELECT * FROM central_mensagem WHERE id='$id'";}else{
$sql_1 = "SELECT * FROM central_mensagem WHERE id='$id' and receptor='COORDENAÇÃO-2' and resposta='' ";}
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
?>
 
<form name="button" method="post" action="" enctype="multipart/form-data">
<table class="users" id="table-responsive" border="0">
  <tr>
    <th><strong>Data:</strong></th>
    <th><strong>Nº de matricula do aluno:</strong></th>
  </tr>
  <tr>
    <td><?php echo $res_1['date']; ?></td>
    <td><?php echo $res_1['emissor']; ?></td>    
  </tr>
  <tr>
    <th><strong>Mensagem:</strong></th>
    <th></th>
  </tr>
  <tr>
    <td colspan="2"><?php echo $res_1['mensagem']; ?></td>
  </tr>
  <tr>
    <th colspan="2"><label for="textarea"></label>
    <textarea name="resp" id="textarea" cols="110" rows="5"></textarea></th>
  </tr>
  
  <input type="hidden" name="id" value="<?php echo $id; ?>" />
  <?php if(isset($_GET['novaresposta'])){?>
  <input type="hidden" name="nova" value="" />
  <?php } ?> 
  <tr>
    <td><input class="input" type="submit" name="resposta" id="button" value="Enviar"></td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>

<?php }} ?>

<?php if(isset($_GET['resposta'])){

  
$resp = $_GET['resp'];
$id = $_GET['id'];
$date = date("d/m/Y H:i:s");


if(isset($_POST['nova'])){$sql_2 = "UPDATE central_mensagem SET status = 'Aguarde resposta', data_resposta = '', mensagem = '$resp', resposta='', emissor='$code' WHERE id = '$id' ";}else{	
$sql_2 = "UPDATE central_mensagem SET status = 'Respondida', data_resposta = '$date', resposta = '$resp' WHERE id = '$id' ";}
mysqli_query($conexao, $sql_2);



echo "<script language='javascript'>window.alert('Mensagem respondida com sucesso!');window.location='suporte_tecnico.php?selec=".@$_GET['selec']."';</script>";


}?>
<!-- enviar mensagem -->

<?php if(isset($_GET['enviar_mensagem'])){

$setor = $_GET['setor'];
$mensagem = $_GET['mensagem'];
$date = date("d/m/Y H:i:s");
	
$sql_4 = "INSERT INTO central_mensagem (date, status, emissor, receptor, mensagem) VALUES ('$date', 'Aguarde resposta', 'COORDENAÇÃO-2', '$setor', '$mensagem')";
$result_4 = mysqli_query($conexao, $sql_4);
if($result_4 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro!');window.location='suporte_tecnico.php?selec=".@$_GET['selec']."';</script>";
}else{
  switch ($setor) {
    case 'COORDENAÇÃO-2':
      $sql_1 = "SELECT DISTINCT c.id_cursos,c.curso from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos INNER JOIN professores p on p.id_professores=d.id_professores where ce.ano_letivo='$ano' and p.code='$code'";
	   $result_1 = mysqli_query($conexao, $sql_1);
	   	while($res_1 = mysqli_fetch_assoc($result_1)){
      
      $turma=$res_1['curso'];
      $id=$res_1['id_cursos'];
		}
    echo $sql_5 = "INSERT INTO mural_coordenacao (date, status, curso, id_cursos, titulo) VALUES ('$date', 'Ativo','$turma','$id', 'Existe uma nova mensagem enviada pelo aluno para ser respondida')";
    mysqli_query($conexao, $sql_5);
    echo "<script language='javascript'>window.alert('Mensagem enviada com sucesso!');window.location='suporte_tecnico.php?selec=".@$_GET['selec']."';</script>";
   
  break;
    
    default:
    
     $sql_66 = "INSERT INTO mural_professor (date, status, id_cursos, titulo) VALUES ('$date', 'Ativo', '1', 'Existe uma nova mensagem enviada pelo aluno para ser respondida')";
      mysqli_query($conexao, $sql_66);
      echo "<script language='javascript'>window.alert('Mensagem enviada com sucesso!');window.location='suporte_tecnico.php?selec=".@$_GET['selec']."';</script>";
      break;
  }//fim while
 
  }//switch}
}
?>
<!-- fechar  -->


<?php if(@$_GET['acao'] == 'fechar'){
$sql_6=$pdo->prepare("DELETE FROM central_mensagem WHERE id=:id");
$sql_6->bindValue(':id',$_GET['id']);
$sql_6->execute();

echo "<script language='javascript'>window.location='suporte_tecnico.php?selec=".@$_GET['selec']."';</script>";
}?>

</div><!-- box -->

</body>
</html>