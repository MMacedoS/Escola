﻿<?php $painel_atual = "Aluno"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Painél do Aluno</title>
<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>

<body>
<?php require "topo.php"; 
$ano=Date('Y');
?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <div id="relatorios">
 
   <ul>
    <h1><strong>Frequência Escolar</strong> </h1>
    <li><strong>Presenças:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE matricula = '$code' AND presente = 'SIM' and ano_letivo='$ano'")); ?></li>
    <li><strong>Faltas justificadas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE  matricula = '$code' AND presente = 'JUSTIFICADA' and ano_letivo='$ano'")); ?></li>
    <li><strong>Faltas não justificada:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM chamadas_em_sala WHERE  matricula = '$code' AND presente = 'NAO' and ano_letivo='$ano'")) / 3; ?></li>
   </ul>
   
  
    <div class="card">
   <ul>
    <h1><strong>Setor Financeiro</strong></h1>
    <li><strong>Pagamento(s) confirmado(s):</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Pagamento Confirmado'")); ?></li>
    <li><strong>Cobrança ainda não quitadas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Aguarda Pagamento'")); ?></li>
   </ul> 
   </div>
 <div class="card">
   <ul>
    <h1><strong>Suporte Escolar</strong></h1>
    <li><strong>Caixa de entrada:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE emissor = '$code'")); ?></li>
    <li><strong>Mensagens ainda não respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE emissor = '$code' AND status = 'Aguarda resposta'")); ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE emissor = '$code' AND status = 'Respondida'")); ?></li>
   </ul> 
 </div>
 
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
   <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM mural_aluno WHERE id_cursos = '$serie' order by id_mural_aluno desc");
   	while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h1><?php echo $res_1['titulo']; ?></h1></li>
    <?php } ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->

</body>
</html>