<?php $painel_atual = "Aluno";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link href="css/setor_financeiro.css" rel="stylesheet" type="text/css" />
<title>Mensalidades</title>
<link rel="shortcut icon" href="../image/logo.png">
</head>

<body>
<?php require "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <h1><strong>Histórico de mensalidades</strong></h1>
<table class="users" id="table-responsive" border="1">
  <tr>
    <td align="center">Abaixo segue seu ralatório de mensalidades</td>
  </tr>
  
  <tr>
    <td align="center">
     <table class="users" id="table-responsive" border="0">
      <tr>
        <td ><strong>Nº da cobrança:</strong></td>
        <td ><strong>Vencimento:</strong></td>
        <td ><strong>Valor:</strong></td>
        <td ><strong>Status:</strong></td>
        <td ><strong>Data do pagamento:</strong></td>
        <td ><strong>Forma de pagamento:</strong></td>
      </tr>
      <?php
      $sql_1 = mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$code'");
	  	while($res_1 = mysqli_fetch_assoc($sql_1)){
	  ?>
      <tr>
        <td><?php echo $res_1['code']; ?></td>
        <td><?php echo $res_1['vencimento']; ?></td>
        <td><?php echo number_format($res_1['valor'],2); ?></td>
        <td><?php echo $res_1['status']; ?></td>
        <td><?php echo $res_1['data_pagamento']; ?></td>
        <td><?php echo $res_1['metodo_pagamento']; ?></td>
        </tr>
      <tr>
        <td colspan="6"><hr></td>
        </tr>
       <?php } ?> 
    </table></td>
  </tr>
</table> 
</div><!-- box -->

</body>
</html>