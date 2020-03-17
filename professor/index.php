<?php $painel_atual = "professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../image/logo_ist.gif">
<title>Painél do Professor</title>
</head>

<body>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">

 <div id="relatorios">
   <div class="card">
   
   <ul>
    <h1><strong>Turmas & Alunos</strong></h1>
     
    <li><strong>Disciplinas ministradas por você: </strong> <?php
    
    
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
   </div>
    <div class="card">
   
   <ul>
    <h1><strong>Informações de acesso</strong> </h1>
    <li><strong>Seu código de acesso:</strong> <?php echo $code; ?></li>
    <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>">Alterar</a></li>
   </ul> 
   </div>
    <div class="card">
   
   <ul>
    <h1><strong>Suporte Escolar</strong></h1>
    <li><strong>Mensagens aguardando resposta:</strong> <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta'")); ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'")); ?></li>
    <li><strong>Todas as mensagens:</strong>  <?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'")); ?></li>
   </ul> 
   </div>
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1 id=""> Notificações</h1>
  <div id="avisos_notificacoes">
     <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'");
   if(mysqli_num_rows($sql_1) == ''){
	   echo "No momento você não tem mensagens";
   }else{
   	while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h1>Nova Mensagem - <?php echo $res_1['mensagem']; ?></h1></li>
    <?php }} ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->


</body>
<?php require "rodape.php"; ?>
</html>