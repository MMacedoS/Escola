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
$painel_atual="admin"; header('Content-Type: text/html; charset=UTF-8');
require "../config.php"; 

$s = base64_decode($_GET['s']);
// $s= $pdo->prepare("SELECT d.disciplina, p.code,p.nome,p.graduacao,p.salario FROM professores p INNER JOIN disciplinas d on p.id_professores=d.id_professores INNER JOIN cursos c on c.id_cursos = d.id_cursos where nome!=:nome order by nome asc");
// $s->bindValue(':nome','');
// $s->execute();
// $dados=$s->fetchAll(PDO::FETCH_ASSOC);
if($s=='pesquisa'){ 
  $s=$pdo->prepare("SELECT p.code as Matricula,p.nome as Nome,COALESCE((select GROUP_CONCAT(CONCAT(c.curso,' - ',lista.nome,' ')) from lista_disc lista INNER JOIN disciplinas d on lista.id_lista=d.disciplina inner JOIN cursos c on c.id_cursos=d.id_cursos where d.id_professores=p.id_professores),'Nenhuma disciplina') as 'Turmas e disciplinas',p.graduacao as Graduação,p.salario as Salário FROM professores p where p.nome!=:nome ORDER BY p.nome asc");
  $s->bindValue(':nome','');
  $s->execute();
  $dados=$s->fetchAll(PDO::FETCH_ASSOC);
}else{
  $tipo=$_GET['status'];
  $serie=$_GET['turma'];
  $s=$pdo->prepare("SELECT p.code as Matricula,p.nome as Nome,COALESCE((select GROUP_CONCAT(CONCAT(c.curso,' - ',lista.nome,' ')) from lista_disc lista INNER JOIN disciplinas d on lista.id_lista=d.disciplina inner JOIN cursos c on c.id_cursos=d.id_cursos where d.id_professores=p.id_professores),'Nenhuma disciplina') as 'Turmas e disciplinas',p.graduacao as Graduação,p.salario as Salário FROM professores p INNER JOIN disciplinas d on p.id_professores=d.id_professores 
  where p.status=:tipo and d.id_cursos=:serie order by p.nome asc");
  $s->bindValue(':tipo',$tipo);
  $s->bindValue(':serie',$serie);
  $s->execute();
  $dados=$s->fetchAll(PDO::FETCH_ASSOC);
  
}

?>
<script>
  window.itens = JSON.parse('<?=json_encode($dados)?>');
  window.titulo="Lista de Professores";
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