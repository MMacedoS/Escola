<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<!-- <link href="css/setor_financeiro.css" rel="stylesheet" type="text/css" /> -->
<title>Administração</title>
</head>

<body>
<?php require "topo.php"; $data=date('d/m/Y H:i:s');?>
<div id="caixa_preta">
</div><!-- caixa_preta -->


<div id="box_aluno">
<h1>Fluxo de caixa</h1>
<a class="btn btn-danger" href="fluxo_de_caixa.php?acao=lancamento">CADASTRAR INFORMAÇÃO</a>
<script>
  var truncate = document.querySelectorAll(".truncate");
  truncate = [].slice.apply(truncate);
  truncate.forEach(function (elemento, indice) {
  elemento.title = elemento.innerHTML;
})

</script>

<?php if(@$_GET['acao'] == 'lancamento'){ ?>

<?php if(isset($_POST['button'])){

$date = $_POST['data'];
$tipo = $_POST['tipo_lan'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$form = $_POST['form'];

$d = date("d");
$m = date("m");
$y = date("Y");
$date_completo = date("d/m/Y H:i:s");

echo $sql_6 = mysqli_query($conexao, "INSERT INTO fluxo_de_caixa (status, tipo, d, m, a, date_completo, date, codigo, descricao, valor, form_pag) VALUES ('Ativo', '$tipo', '$d', '$m', '$y', '$date_completo', '$date', 'Não informado', '$descricao', '$valor', '$form')");

$s = base64_encode("pesquisa");

echo "<script language='javascript'>
window.alert('Informação lançada com sucesso');
window.location='fluxo_de_caixa.php?s=$s';</script>'
</script>";

}?>

<form name="button" method="post" action="" enctype="multipart/form-data">
<table class="users" id="table-responsive" border="0">
  <tr>
    <td >Data do acontecimento:</td>
    <td >Tipo:</td>
    <td >Descrição:</td>
    <td >Valor</td>
    <td >Form. Pgto</td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input class="input" type="text" name="data" id="textfield" value="<?php echo date("d/m/Y"); ?>"></td>
    <td><label for="select"></label>
      <select name="tipo_lan" size="1" id="select">
        <option value="CRÉDITO">CRÉDITO</option>
        <option value="DÉBITO">DÉBITO</option>
    </select></td>
    <td><label for="textfield3"></label>
    <input class="input" name="descricao" type="text" id="textfield3"></td>
    <td><label for="textfield4"></label>
    <input class="input" type="text" name="valor" id="textfield4"></td>
    <td><label for="select2"></label>
      <select name="form" size="1" id="select2">
        <option value="Dinheiro">Dinheiro</option>
        <option value="Cheque">Cheque</option>
        <option value="Transferência Bancaria">Transferência Bancaria</option>
        <option value="Depósito Bancario">Depósito Bancario</option>
        <option value="Cartão de crédito">Cartão de crédito</option>
        <option value="Cartão de débito">Cartão de débito</option>
    </select></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Lançar"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<form>

<hr />

<?php } ?>





<form name="" method="post" action="" enctype="multipart/form-data">

<table class="users table-responsive" border="0">
  <tr>
    <td colspan="4"><h3><strong>Selecione o filtro</strong></h3></td>
  </tr>
  <tr>
    <td width="144"><strong>Dia de relatório:</strong></td>
    <td width="144"><strong>Mês do relatório</strong></td>
    <td width="144"><strong>Ano do relatório</strong></td>
    <td width="84"><strong>Tipo de relatório</strong></td>
    <td></td>
  </tr>
  <tr>
    <td><input class="input2" type="text" name="dia"></td>
    <td><input class="input2" type="text" name="mes"></td>
    <td><input class="input2" type="text" name="ano"?></td>
    <td><select name="tipo" size="1" id="select4">
      <option value="Todos">Todos</option>
      <option value="CRÉDITO">Crédito</option>
      <option value="DÉBITO">Débito</option>
    </select></td>
    <td width="412"><input type="submit" class="" name="filtrar" value="FILTRAR" /></td>
  </tr>
</table>
</form>
<?php

if(isset($_POST['filtrar'])){

  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $ano = $_POST['ano'];
  $tipo = $_POST['tipo'];
  
  if($tipo == 'Todos'){  
    $sql_1=mysqli_query($conexao,"SELECT * FROM fluxo_de_caixa where d='$dia' and m='$mes' and a='$ano'");
  }else{
 
    $sql_1=mysqli_query($conexao,"SELECT * FROM fluxo_de_caixa where d='$dia' and m='$mes' and a='$ano' and tipo='$tipo'");
    
   }///finalizando ifs dentro do if post
  }
else{
  
  $sql_1 = mysqli_query($conexao, "SELECT * FROM fluxo_de_caixa");
}

if(mysqli_num_rows($sql_1)==''){
 
	echo "Não foi encontrado filtro para sua pesquisa";
}else{

?>

<table class="users" id="table-responsive" border="0">
<thead>  
<tr>
    <td class="row-1 row-name"><strong>Data:</strong></td>
    <td class="row-1 row-email"><strong>Tipo:</strong></td>
    <td class="row-1 row-name"><strong>Código:</strong></td>
    <td class="row-1 row-name"><strong>Descrição</strong></td>
    <td class="row-1 row-name"><strong>Valor:</strong></td>
    <td class="row-1 row-name" ><strong>For. recebimento:</strong></td>
  </tr>
  </thead>
  <!-- <tr>
    <td colspan="7"><hr></td>
  </tr> -->
  <tbody>
  <?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>
  <tr>
    <td><?php echo $res_1['date_completo']; ?></td>
    <td><?php echo $res_1['tipo']; ?></td>
    <td ><?php echo $res_1['codigo']; ?></td>
    <td class="truncate" title="<?php echo $res_1['descricao']; ?>"><?php echo $res_1['descricao']; ?></td>
    <td>R$ <?php echo number_format($res_1['valor'],2); ?></td>
    <td><?php echo $res_1['form_pag']; ?></td>
    <td width="17">&nbsp;</td>
    <td width="31">&nbsp;</td>
  </tr>
  <!-- <tr>
    <td colspan="7"><hr></td>
  </tr> -->
  <?php } ?>
  <!-- <tr>
    <td colspan="7">&nbsp;</td>
  </tr> -->
  <tr>
    <td ><strong>RESUMO:</strong>
      </td>
  </tr>
  <tr>
    <td ><strong>CRÉDITOS:</strong></td>
    <td ><strong>DÉBITOS:</strong></td>
    <td ><strong>VALOR EM CAIXA:</strong></td>
  </tr>
  <tr>
    <td > R$
    <?php
    
	$sql_2 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM fluxo_de_caixa where  tipo = 'CRÉDITO'");
		while($res_2 = mysqli_fetch_assoc($sql_2)){
				echo number_format($res_2["soma"],2);
			}
	
	?>
    
    </td>
    <td>R$ 
        <?php
    
	$sql_3 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM fluxo_de_caixa where tipo = 'DÉBITO'");
		while($res_3 = mysqli_fetch_assoc($sql_3)){
				echo number_format($res_3["soma"],2);
			}
	
	?>
    </td>
    <td> R$ 
    <?php
    
		$sql_4 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM fluxo_de_caixa  where tipo = 'CRÉDITO'");
		while($res_4 = mysqli_fetch_assoc($sql_4)){
			
		$sql_5 = mysqli_query($conexao, "SELECT SUM(valor) as soma FROM fluxo_de_caixa where tipo = 'DÉBITO'");
		while($res_5 = mysqli_fetch_assoc($sql_5)){	
		
		echo number_format($res_4["soma"]-$res_5["soma"],2);
		
		}}
	
	?>
    
    </td>
  </tr>
  </tbody>
</table>
<?php } ?>

</div><!-- box_aluno -->
<?php require "rodape.php"; ?>
</body>
</html>