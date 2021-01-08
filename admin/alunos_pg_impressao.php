<!DOCTYPE >
<html>
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<meta charset="utf-8">
  
  
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Imprimir</title>
<link rel="stylesheet" type="text/css" href="../relatorios/css/relatorio.css"/>
</head>

<?php 
$painel_atual="admin";
// header('Content-Type: text/html; charset=utf-8');
require "../config.php"; 

$s = base64_decode($_GET['s']);
if($s=='pesquisa'){ 
  $s=$pdo->prepare("SELECT  e.nome as Nome,e.matricula as Matricula,c.curso as Turma,(SELECT COUNT(status) from mensalidades m where m.matricula=e.matricula and status='Pagamento Confirmado' )as Recebido, (SELECT COUNT(status) from mensalidades m where m.matricula=e.matricula and status='Aguarda Pagamento' )as 'Em aberto' from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where nome!=:nome order by c.id_categoria asc");
  $s->bindValue(':nome','');
  $s->execute();
  $dados=$s->fetchAll(PDO::FETCH_ASSOC);
}else{
  $tipo=$_GET['status'];
  $serie=$_GET['turma'];
  $s=$pdo->prepare("SELECT  e.nome,e.matricula,c.curso,(SELECT COUNT(status) from mensalidades m where m.matricula=e.matricula and status='Pagamento Confirmado' )as pago, (SELECT COUNT(status) from mensalidades m where m.matricula=e.matricula and status='Aguarda Pagamento' )as devendo from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where c.id_cursos=:serie and e.status=:tipo order by c.curso asc");
  $s->bindValue(":serie",$serie);
  $s->bindValue(":tipo",$tipo);
  $s->execute();
  $dados=$s->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($dados);
}

?>
<script>
  window.itens = JSON.parse('<?=json_encode($dados)?>');
  window.titulo="Mensalidades";
</script>
<body>
<div class="float" onclick="window.print();">
    <img src="../relatorios/images/print.png" alt="">
</div>
</body>
<script src="../relatorios/js/Empresa.js"></script>
<script src="../relatorios/configurations/Configurations.js"></script>
<script src="../relatorios/js/Relatorio.js"></script>
<script src="../relatorios/js/GeraRelatorio.js"></script>
</html>