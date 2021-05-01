<?php $painel_atual = "Aluno"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">


<link rel="shortcut icon" href="../image/logo.png">
<title>Painel do Aluno</title>
</head>

<body>
<?php require "topo.php"; 
$ano=Date('Y');
?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <div id="relatorios">
 <div class="card-1">
   <ul>
    <h1><strong>Frequência Escolar</strong> </h1>
    <li><strong>Presenças:</strong> <?php 
    $presenca=$pdo->query("SELECT * FROM chamadas_em_sala WHERE matricula = '$code' AND falta = '0' and ano_letivo='$ano'");
    $presenca=$presenca->fetchAll();
    echo count($presenca);?></li>
    <li><strong>Faltas:</strong>  <?php $falta=$pdo->query("SELECT * FROM chamadas_em_sala WHERE matricula = '$code' AND falta > '0' and ano_letivo='$ano'");
    $falta=$falta->fetchAll();
    echo count($falta); ?></li>
    <li><strong>Faltas justificada:</strong>  <?php $justificada=$pdo->query("SELECT * FROM chamadas_em_sala WHERE matricula = '$code' AND obs = 'justificada' and ano_letivo='$ano'");
    $justificada=$justificada->fetchAll();
    echo count($justificada); ?></li>
   </ul>
   </div>
  
    <div class="card-2">
   <ul>
    <h1><strong>Setor Financeiro</strong></h1>
    <li><strong>Pagamento(s) confirmado(s):</strong>  <php //echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Pagamento Confirmado'")); ?></li>
    <li><strong>Cobrança ainda não quitadas:</strong>  <php //echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = '$code' AND status = 'Aguarda Pagamento'")); ?></li>
   </ul> 
   </div>
 <div class="card-3">
   <ul>
    <h1><strong>Suporte Escolar</strong></h1>
     <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>">Alterar</a></li>
    <li><strong>Caixa de entrada:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'")); ?></li>
    <li><strong>Mensagens ainda não respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE emissor = '$code' AND status = 'Aguarde resposta'")); ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'")); ?></li>
   </ul> 
 </div>
 
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
   <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT Distinct titulo FROM mural_aluno WHERE id_cursos = '$serie' order by id_mural_aluno desc limit 15");
   	while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h2><?php echo $res_1['titulo']; ?></h2></li>
    <?php } ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->
<?php require_once("rodape.php");?>
</body>
</html>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>