
<?php

$painel_atual = "admin"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
<title>Painel da Admin</title>
<link rel="shortcut icon" href="../image/logo.png">
</head>

<body>
<?php header('Content-Type: text/html; charset=UTF-8'); require "topo.php"; ?>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
 <div id="relatorios">
 <?php
 
 $d = date("d");
 $m = date("m");
 $y = date("Y");
 
 ?>
<section>
  <div class="card-1">
  <ul>
    <h1><strong>Turmas e Disciplinas<i class="fas fa-home"></i></strong></h1>
    <li><strong>Total de Turmas cadastradas:</strong>
    <?php
    $res = $pdo->prepare("SELECT * FROM cursos");
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?>  </li>
    <li><strong>Total de disciplinas cadastradas:</strong> <?php $res = $pdo->prepare("SELECT * FROM disciplinas");
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?></li>
   </ul>   
   </div>
   <div class="card-2">
   <ul>
    <h1><strong>Professores</strong></h1>
    <li><strong>Professores Ativos:</strong> 
    <?php $res = $pdo->prepare("SELECT * FROM professores WHERE status =:status");
    $res->bindValue(':status','Ativo');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?></li>

    <li><strong>Professores Inativos:</strong> 
    <?php $res = $pdo->prepare("SELECT * FROM professores WHERE status =:status");
    $res->bindValue(':status','Inativo');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?></li>
   </ul> 
   
    </div>
    <div class="card-3">
    <ul>
    <h1><strong>Estudantes</strong></h1>
    <li><strong>Estudantes Ativos:</strong> 
    <?php $res = $pdo->prepare("SELECT * FROM estudantes WHERE status =:status");
    $res->bindValue(':status','Ativo');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?></li>

    <li><strong>Estudantes Inativos:</strong> 
  <?php
  $res = $pdo->prepare("SELECT * FROM estudantes WHERE status =:status");
  $res->bindValue(':status','Inativo');
  $res->execute();    
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  echo $linhas = count($dados);?>  
  </li>
   </ul> 
   
    </div>
    <div class="card-4">
    <ul>
    <h1><strong>Setor Financeiro</strong></h1>
    <li><strong>Cobranças geradas este mês:</strong> 
    <?php 
    $res = $pdo->prepare("SELECT * FROM mensalidades WHERE mes =:m AND ano=:y");
    $res->bindValue(':m',$m);
    $res->bindValue(':y',$y);
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?>
    </li>
    <li><strong>Cobranças pagas:</strong> 
    <?php 
    $res = $pdo->prepare("SELECT * FROM mensalidades WHERE mes =:m AND ano=:y and status=:pag");
    $res->bindValue(':m',$m);
    $res->bindValue(':y',$y);
    $res->bindValue(':pag','Pagamento Confirmado');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?>
    </li>
    <li><strong>Cobranças não pagas:</strong> <?php
    $res = $pdo->prepare("SELECT * FROM mensalidades WHERE mes =:m AND ano=:y and status=:pag");
    $res->bindValue(':m',$m);
    $res->bindValue(':y',$y);
    $res->bindValue(':pag','Aguarda Pagamento');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?>
    </li>
   </ul>  
   
    </div>
    <div class="card-5">
    <ul>
    <h1><strong>Mensagens</strong></h1>
    <li><strong>Contatos que aguarda sua resposta:</strong> <?php 
    $res = $pdo->prepare("SELECT * FROM central_mensagem WHERE receptor=:receptor and status=:status");
    $res->bindValue(':receptor','COORDENAÇÃO');
    $res->bindValue(':status','Aguarde resposta');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);?>
    </li>
    <li><strong>Contatos respondidos:</strong>
    <?php $res = $pdo->prepare("SELECT * FROM central_mensagem WHERE status=:status");
   
    $res->bindValue(':status','respondida');
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados); ?></li>
    <li><strong>Total de contatos:</strong> <?php
    $res = $pdo->prepare("SELECT * FROM central_mensagem");
    $res->execute();    
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    echo $linhas = count($dados);
    ?></li>
   </ul>  
    </div>      
 </div><!-- relatorios -->
 </section>
 
 <div id="notificacoes">
  <h1><strong> Notificações</strong></h1>
  <div id="avisos_notificacoes">
   <ul>
   <?php
   $sql_1 = mysqli_query($conexao, "SELECT * FROM mural_coordenacao ORDER BY id DESC");
   if($sql_1 == ''){
	   echo "No momento não existe novidades";
   }else{
	   while($res_1 = mysqli_fetch_assoc($sql_1)){
   ?>
    <li><h1><?php echo $res_1['titulo']; ?></h1></li>
    <?php }} ?>
   </ul>
  </div><!-- avisos_notificacoes -->
 </div><!-- notificacoes -->
 
 
</div><!-- box -->



</body>
<?php require "rodape.php"; ?>
</html>