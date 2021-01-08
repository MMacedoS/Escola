﻿<?php $painel_atual = "professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="shortcut icon" href="../image/logo_ist.gif">
<title>Administração do Professor</title>
<link rel="stylesheet" type="text/css" href="css/index.css"/>

<style>

.card-2 {
    background-color: #eb3d00 !important;
}
#a{
  color:#003dff !important;
}
</style>
</head>

<body>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<?php if (!isset($_GET['selec'])) {
  ?>
  <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Atenção!</h4>
  <p>Se deseja acessar todas as avaliações para cadastrar e lançar notas, escolha uma categoria no botão acima ao lado do botão sair.</p>
  <hr>
  
</div>
  <?php
}?>
<div id="box">

 <div id="relatorios">
   <div class="card-1">
   
   <ul>
    <h1><strong>Turmas & Alunos</strong></h1>
     
    <li><strong>Disciplinas ministradas por curso: </strong> <?php
    
    
     echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM disciplinas WHERE id_professores = '$id_professor'")); ?></li>
    <li><strong>Você ministra aula para
    
    <?php
    
  $sql_1 = mysqli_query($conexao, "SELECT * FROM disciplinas WHERE id_professores = '$id_professor'");
  $total_alunos = 0;
		while($res_1 = mysqli_fetch_assoc($sql_1)){
			
      $curso = $res_1['id_cursos'];
      
      //TRAZER DA FORMA CORRETA O TOTAL DE ALUNOS DE CADA PROFESSOR
   $result_tot_alunos = mysqli_query($conexao, "SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$curso'");
   $linhas_tot_alunos = mysqli_num_rows($result_tot_alunos);
   
   $total_alunos = ($total_alunos + $linhas_tot_alunos);

			
    }
    
    echo $total_alunos;
	
	?>
    
    alunos. </strong></li>
   </ul>
   <br>
   </div>
    <div class="card-2">
   
   <ul>
    <h1><strong>Informações de acesso</strong> </h1>
    <li><strong>Seu código de acesso:</strong> <?php echo $code; ?></li>
    <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>" id="a">Alterar</a></li>
   </ul> 
   <br>
   </div>
    <div class="card-3">
   
   <ul>
    <h1><strong>Suporte Escolar</strong></h1>
    <li><strong>Mensagens aguardando resposta:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta'")).'  '; ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'")); ?></li>
    <li><strong>Todas as mensagens:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'")); ?></li>
   </ul> 
   <br>
   </div>
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
     <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'");
   if(mysqli_num_rows($sql_1) == ''){
	   echo "No momento você não tem mensagens";
   }else{
   	while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h2>Nova Mensagem - <?php echo $res_1['mensagem']; ?></h2></li>
    <?php }} ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->

</body>
<?php require "rodape.php"; ?>
</html>