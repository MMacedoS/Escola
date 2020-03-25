<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Suporte Escolar</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/suporte_tecnico.css"/>
</head>

<body>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1><strong>Histórico de chamados</strong></h1>
 <a href="suporte_tecnico.php?acao=abrir_chamado" class="a_1">Abrir chamado</a>
<table width="832" border="0">
<?php if(@$_GET['acao'] == 'abrir_chamado'){ ?>



  <tr>
  <td>	 
     <form name="enviar_mensagem" method="post" action="" enctype="multipart/form-data">
	  Selecione o setor que você quer enviar esta mensagem
     <select name="setor" size="1" id="select">
       <option value="COORDENAÇÃO" style="background-color:#F3F781;">COORDENAÇÃO</option>
        <option value="" style="background-color:#F3F781;"></option>
       <option value="PROFESSOR">PROFESSORES</option>
       <?php      
		$sql_2 = "SELECT DISTINCT p.code,p.nome from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos INNER JOIN professores p on p.id_professores=d.id_professores where ce.ano_letivo=2020";
		$result_2 = mysqli_query($conexao, $sql_2);
			while($res_2 = mysqli_fetch_assoc($result_2)){
        $serie=$res_2['id_cursos'];
	   ?>
        <option value="<?php echo $res_2['code']; ?>" style="background-color:#81F79F;"><?php echo $res_2['nome'] ?></option>
       <?php } ?>
                
       <option value=""><strong> ALUNOS DE CLASSE</strong></option>
       <?php
       $sql_3 = "SELECT DISTINCT e.matricula,e.nome, c.curso from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos INNER JOIN professores p on p.id_professores=d.id_professores where ce.ano_letivo=2020 and p.code='$code' and e.status='ativo'";
	   $result_3 = mysqli_query($conexao, $sql_3);
	   	while($res_3 = mysqli_fetch_assoc($result_3)){
	   ?>
        <option value="<?php echo $res_3['matricula']; ?>" style="background-color:#58FAF4;"><?php echo $res_3['nome']." "; ?>--<?php echo " ".$res_3['curso']?></option>
        <?php } ?>
     </select>
     Caso tenha algum anexo escolha o arquivo abaixo<br />
     <input name="anexo" type="file" />
     <br />Digite sua mensagem
     <textarea name="mensagem"></textarea>
	 <input class="input" type="submit" name="enviar_mensagem" value="Enviar" />
     </form>
     <hr>
  </td>
  </tr>
<?php } ?>
  <tr>
    <td width="826" align="left">Abaixo segue seu ralatório de chamadas</td>
  </tr>
  <tr>
    <td align="center"><hr></td>
  </tr>
  <tr>
    <td align="center">
    <?php
   $sql_5 = "SELECT * FROM central_mensagem WHERE emissor = '$code' or receptor='$code' order by id desc";
	$result_5 = mysqli_query($conexao, $sql_5);
	if(mysqli_num_rows($result_5) == ''){
		echo "Não existe nenhuma mensagem";
	}else{
	?>
     <table id="table_st" border="0">
      <tr>
        <td width="70"><strong>Recptor:</strong></td>
        <td width="70"><strong>Status:</strong></td>
        <td width="70"><strong>Data:</strong></td>
        <td width="100"><strong>Anexo:</strong></td>
        <td width="100"><strong>Data da resposta:</strong></td>
      <?php while($res_5 = mysqli_fetch_assoc($result_5)){ ?>
      <tr>
        <td><?php echo $res_5['receptor']; ?></td>
        <td><?php echo $res_5['status']; ?></td>
        <td><?php echo $res_5['date']; ?></td>
        <td><a target="_blank" href="../anexos/<?php echo $res_5['anexo']; ?>">Baixar</a></td>
        <td><?php echo $res_5['data_resposta']; ?></td>
        <td width="80">
        <a href="suporte_tecnico.php?acao=responder&id=<?php echo $res_5['id']; ?>"><img src="../image/confirma.png" width="22" border="0" title="responder" /></a>
        <a href="suporte_tecnico.php?acao=ticket&id=<?php echo $res_5['id']; ?>"><img src="../image/visualizar16.gif"  border="0" title="Vizualizar chamada" /></a> |
        <a href="suporte_tecnico.php?acao=fechar&id=<?php echo $res_5['id']; ?>"><img src="../image/deleta.png" width="22" border="0" title="Excluir chamado" /></a>
        
      
        </td>
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
				 $anexo_res = $res_resp['anexo_resp'];
				 $mensagem = $res_resp['mensagem'];
			 echo "<h1 class='h1'><strong>Sua mensagem:</strong><br><br>$mensagem</h1>";
       echo "<h1 class='h2'><strong>Data:</strong>$date | <strong>Anexo:</strong> <a href='../anexos/$anexo_res' target='_blank'> $anexo_res</a><br><br>$resposta</h1>";			
       
			
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
$sql_1 = "SELECT * FROM central_mensagem WHERE id='$id' and receptor='$code'";}
$result = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($result)){
?>
 
<form name="button" method="get" action="" enctype="multipart/form-data">
<table width="950" border="0">
  <tr>
    <td><strong>Data:</strong></td>
    <td><strong>Nº de matricula do aluno:</strong></td>
    <td><strong>Anexo:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['date']; ?></td>
    <td><?php echo $res_1['emissor']; ?></td>
    <td><a target="_blank" href="../anexos/<?php echo $res_1['anexo']; ?>"><?php echo $res_1['anexo']; ?></a></td>
  </tr>
  <tr>
    <td><strong>Mensagem:</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><?php echo $res_1['mensagem']; ?></td>
  </tr>
  <tr>
    <td colspan="3"><label for="textarea"></label>
    <textarea name="resp" id="textarea" cols="110" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Escolha o arquivo para anexar abaixo</strong></td>
  </tr>
  <tr>
    <td colspan="3"><input name="anexo" type="file" /></td>
  </tr>
  <input type="hidden" name="id" value="<?php echo $id; ?>" />
  <input type="hidden" name="receptor" value="<?php echo $res_1['emissor']; ?>" />
  <?php if(isset($_GET['novaresposta'])){?>
  <input type="hidden" name="nova" value="" />
  <?php } ?> 
  <tr>
    <td><input class="input" type="submit" name="resposta" id="button" value="Enviar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>

<?php }} ?>

<?php if(isset($_GET['resposta'])){

$resp = $_GET['resp'];
$id = $_GET['id'];
$date = date("d/m/Y H:i:s");
$anexo = $_FILES['anexo']['name'];
$receptor=$_GET['receptor'];

if(file_exists("../anexos/$anexo")){
		 $a = 1;
		 while(file_exists("../anexos/[$a]$anexo")){
			 $a++;
			 }
			 
		$anexo = "[".$a."]".$anexo;	 
	}
if(isset($_GET['nova']) && $receptor!=$code){$sql_2 = "UPDATE central_mensagem SET status = 'Aguarde resposta', data_resposta = '', mensagem = '$resp', resposta='', anexo = '$anexo', emissor='$code',receptor='$receptor' WHERE id = '$id' ";}else{	
$sql_2 = "UPDATE central_mensagem SET status = 'Respondida', data_resposta = '$date', resposta = '$resp', anexo_resp = '$anexo' WHERE id = '$id' ";}
mysqli_query($conexao, $sql_2);

(move_uploaded_file($_FILES['anexo']['tmp_name'], "../anexos/".$anexo));

echo "<script language='javascript'>window.alert('Mensagem respondida com sucesso!');window.location='suporte_tecnico.php';</script>";


}?>
<!-- envio de mensagem -->

<?php if(isset($_GET['enviar_mensagem'])){

$setor = $_GET['setor'];
$mensagem = $_GET['mensagem'];
$anexo = $_FILES['anexo']['name'];
$date = date("d/m/Y H:i:s");

if(file_exists("../anexos/$anexo")){
		$a = 1;
		while(file_exists("../anexos/[$a]$anexo")){
			$a++;
			}
		$anexo = "[".$a."]".$anexo;
	}
	
$sql_4 = "INSERT INTO central_mensagem (date, status, emissor, receptor, mensagem, anexo) VALUES ('$date', 'Aguarde resposta', '$code', '$setor', '$mensagem', '$anexo')";
$result_4 = mysqli_query($conexao, $sql_4);
if($result_4 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro!');window.location='suporte_tecnico.php';</script>";
}else{

(move_uploaded_file($_FILES['anexo']['tmp_name'],"../anexos/".$anexo));	



 $sql_1 = "SELECT DISTINCT p.nome from cursos c INNER join cursos_estudantes ce on ce.id_cursos=c.id_cursos INNER JOIN estudantes e on e.id_estudantes=ce.id_estudantes INNER JOIN disciplinas d on d.id_cursos=c.id_cursos INNER JOIN professores p on p.id_professores=d.id_professores where ce.ano_letivo=2020 and e.matricula=587418";
	   $result_1 = mysqli_query($conexao, $sql_1);
	   	while($res_1 = mysqli_fetch_assoc($result_1)){
			$professor = $res_1['nome'];
		}

if($setor == 'COORDENAÇÃO'){
$sql_5 = "INSERT INTO mural_coordenacao (date, status, curso, titulo) VALUES ('$date', 'Ativo', 'Não informado', 'Existe uma nova mensagem enviada pelo aluno para ser respondida')";
mysqli_query($conexao, $sql_5);
}


else if($setor == $professor){
$sql_66 = "INSERT INTO mural_professor (date, status, curso, titulo) VALUES ('$date', 'Ativo', 'Não informado', 'Existe uma nova mensagem enviada pelo aluno para ser respondida')";
mysqli_query($conexao, $sql_66);
}

	echo "<script language='javascript'>window.alert('Mensagem enviada com sucesso!');window.location='suporte_tecnico.php';</script>";


	

}


}?>
<!-- fim de envio -->
<?php if(@$_GET['acao'] == 'fechar'){

$sql_6 = "DELETE FROM central_mensagem WHERE id = ".$_GET['id']."";
mysqli_query($conexao, $sql_6);
echo "<script language='javascript'>window.location='suporte_tecnico.php';</script>";
}?>

</div><!-- box -->

</body>
</html>