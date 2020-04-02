<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/todas_as_avaliacoes.css"/>

<link rel="shortcut icon" href="../image/logo_ist.gif">
<title>Trabalhos</title>
</head>

<body>
<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<?php if($_GET['pg'] == 'simulados'){ ?>
<div class="row" id="row_button">
<br /><a class="a2" rel="superbox[iframe][850x350]" href="cadastrar_trabalho.php?tipo=atividade_pesquisa&code=<?php echo $code; ?>">Cadastrar Pesquisa</a>
<br /><a class="a3" rel="stylesheet" href="todas_as_trabalhos.php?pg=atividades_pesquisa">Atualizar Pagina</a>
</div>
<p></p>

 <h1>Abaixo segue seu histórico de atividades bimestrais de suas turmas!</h1>
 
<?php
$sql_1 = "SELECT * FROM atividades_pesquisa WHERE professor = '$code' ORDER BY id DESC";
$result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	 echo "<h2>No momento não existe nenhuma prova lançada no sistema!</h2>";	 
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
?> 
<table width="955" border="0">
  <tr>
    <td width="90">Nº prova</td>
    <td width="60">Status</td>
    <td width="131">Lançamento</td>
    <td width="187">Data de aplicação</td>
    <td width="323">Disciplina</td>
  </tr>
  <tr>
    <td><h3><?php echo $res_1['id']; ?></h3></td>
    <td><h3><?php echo $res_1['status']; ?></h3></td>
    <td><h3><?php echo $res_1['date']; ?></h3></td>
    <td><h3><?php echo $res_1['data_aplicacao']; ?></h3></td>
    <td><h3><?php echo $res_1['disciplina']; ?></h3></td>
  </tr>
  <tr>
    <td><a rel="superbox[iframe][850x350]" href="editar_trabalho.php?id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>">Editar</a></td>
    <td colspan="3"><a href="correcao_trabalho.php?pg=atividade_pesquisa&id=<?php echo $res_1['id']; ?>">Fazer correção</a></td>
    <td></td>
    <td><a href="todas_as_trabalhos.php?pg=excluir&id=<?php echo $res_1['id']; ?>&code=<?php echo $code; ?>"><img src="../image/deleta.png" width="22" border="0" /></a></td>
  </tr>  
  </table> 
 
<?php }}}

if($_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$code = $_GET['code'];

$sql_2 = "DELETE FROM atividades_pesquisa WHERE id = '$id'";
mysqli_query($conexao, $sql_2);

echo "<script language='javascript'>window.location='todas_as_trabalhos.php?pg=atividades_pesquisa';</script>";

}?> 
</div><!-- box-->



<?php require "rodape.php"; ?>
</body>
</html>