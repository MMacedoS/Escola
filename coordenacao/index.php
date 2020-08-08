<?php $painel_atual = "Coordenacao"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="shortcut icon" href="../image/logo.png">
<title>Coordenação</title>
<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>

<body>

<?php require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->
<?php if (!isset($_GET['selec'])) {
  ?>
  <div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Alerta!</h4>
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
     
    <li><strong>Quantidade de Turmas: </strong> <?php
    $selec=@$_GET['selec'];
    $sql_1=$pdo->prepare("SELECT * FROM cursos WHERE id_categoria =:selec");
    $sql_1->bindValue(':selec',$selec);
    $sql_1->execute();
    $q_t=$sql_1->fetchAll();
    echo count($q_t);
    //  echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM cursos WHERE id_categoria ='$selec'")); ?></li>
    <li><strong>Você ministra aula para
    
    <?php
      
      //TRAZER DA FORMA CORRETA O TOTAL DE ALUNOS DE CADA PROFESSOR
    $sql_1=$pdo->prepare("SELECT COUNT(*) as q from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes inner join cursos c on c.id_cursos=ce.id_cursos inner join categoria cat on cat.id_categoria=c.id_categoria where cat.id_categoria='$selec' and e.status='Ativo'");
    $sql_1->bindValue(':selec',$selec);
    $sql_1->execute();
    $q_a=$sql_1->fetchAll();
    echo $q_a[0]['q'];
  //  $result_tot_alunos = mysqli_query($conexao, "SELECT COUNT(*) as q from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes inner join cursos c on c.id_cursos=ce.id_cursos inner join categoria cat on cat.id_categoria=c.id_categoria where cat.id_categoria='$selec' and e.status='Ativo'");
  //  $linhas_tot_alunos = mysqli_fetch_assoc($result_tot_alunos);
 
  //   echo $linhas_tot_alunos['q'];
	
	?>
    
    alunos. </strong></li>
   </ul>
   <br>
   </div>
    <div class="card-2">
   
   <ul>
    <h1><strong>Informações de acesso</strong> </h1>
    <li><strong>Seu código de acesso:</strong> <?php echo $code; ?></li>
    <li><strong>Senha:</strong>***** <a rel="superbox[iframe][285x100]" href="altera_senha.php?code=<?php echo $code; ?>">Alterar</a></li>
   </ul> 
   <br>
   </div>
    <div class="card-3">
   
   <ul>
    <h1><strong>Suporte Escolar</strong></h1>
    <li><strong>Mensagens aguardando resposta:</strong> <?php 
    $sql_2=$pdo->prepare('SELECT * FROM central_mensagem WHERE receptor =:code AND status =:status');
    $sql_2->bindValue(':code','COORDENAÇÃO-2');
    $sql_2->bindValue(':status','Aguarde resposta');
    $sql_2->execute();
    $dados=$sql_2->fetchAll();
    echo count($dados);
    // echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Aguarda resposta'")).'  '; ?></li>
    <li><strong>Mensagens respondidas:</strong>  <?php 
    $sql_2=$pdo->prepare('SELECT * FROM central_mensagem WHERE receptor = :code AND status =:status');
    $sql_2->bindValue(':code','COORDENAÇÃO-2');
    $sql_2->bindValue(':status','Respondida');
    $sql_2->execute();
    $dados=$sql_2->fetchAll();
    echo count($dados);
    // echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code' AND status = 'Respondida'")); ?></li>
    <li><strong>Todas as mensagens:</strong>  <?php 
    $sql_2=$pdo->prepare('SELECT * FROM central_mensagem WHERE receptor =:code');
    $sql_2->bindValue(':code','COORDENAÇÃO-2');
    $sql_2->execute();
    $dados=$sql_2->fetchAll();
    echo count($dados);
    // echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'")); ?></li>
   </ul> 
   <br>
   </div>
 </div><!-- relatorios -->
 
 <div id="notificacoes">
  <h1>Notificações</h1>
  <div id="avisos_notificacoes">
     <ul>
   <?php
   $sql_n=$pdo->prepare("SELECT * FROM central_mensagem WHERE receptor = :code");
   $sql_n->bindValue(':code',$code);
   $sql_n->execute();
   $n=$sql_n->fetchAll();
   $qt=count($n);
  //  $sql_1 = mysqli_query($conexao, "SELECT * FROM central_mensagem WHERE receptor = '$code'");
   if($qt==0){
	   echo "No momento você não tem mensagens";
   }else{
   	foreach($n as $res_1){
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