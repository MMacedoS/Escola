
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
$painel_atual="Coordenacao"; 
header('Content-Type: text/html; charset=UTF-8');
require_once "../config.php"; 

$turma=@$_GET['turma'];
$disciplinas=@$_GET['disciplinas'];
$situacao=@$_GET['situacao'];
$bimestre=@$_GET['bimestre'];
$ano=@$_GET['ano'];

if(($disciplinas=='todos') && ($situacao=='AP'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,n.bimestre as Bimestre,IF(n.nota=6.9,'7.0',n.nota) as Média from notas_bimestres n INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos WHERE n.bimestre=:bimestre and c.id_cursos=:turma and n.nota>=:nota and n.ano_letivo=:ano ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':bimestre',$bimestre);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':nota',6.9);
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

}elseif(($disciplinas=='todos') && ($situacao=='RP'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,n.bimestre as Bimestre,n.nota as Média from notas_bimestres n INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos WHERE n.bimestre=:bimestre and c.id_cursos=:turma and n.nota<7 and n.ano_letivo=:ano and n.situacao=:res ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':bimestre',$bimestre);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':res','reprovado');
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

} elseif(($disciplinas!='todos') && ($situacao=='AP'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,n.bimestre as Bimestre,IF(n.nota=6.9,'7.0',n.nota) as Média from notas_bimestres n INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos WHERE n.bimestre=:bimestre and c.id_cursos=:turma and n.nota>=:nota and n.ano_letivo=:ano and d.id_disciplinas=:disciplina ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':bimestre',$bimestre);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':disciplina',$disciplinas);
      $s->bindValue(':nota',6.9);
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

} 
elseif(($disciplinas!='todos') && ($situacao=='RP'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,n.bimestre as Bimestre,n.nota as Média from notas_bimestres n INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos WHERE n.bimestre=:bimestre and c.id_cursos=:turma and n.nota<7 and n.ano_letivo=:ano and d.id_disciplinas=:disciplina and n.situacao=:res ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':bimestre',$bimestre);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':disciplina',$disciplinas);
      $s->bindValue(':res','reprovado');
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

}
elseif(($disciplinas=='todos') && ($situacao=='RP_ano'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,n.media as NotaFinal
      from resultado_final n 
     INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas 
     INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos
      WHERE c.id_cursos=:turma and n.media<:media 
      and n.ano_letivo=:ano and n.situacao=:res ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':media',27.6);
      $s->bindValue(':res','reprovado');
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

}
elseif(($disciplinas=='todos') && ($situacao=='AP_ano'))
{ 
      $s=$pdo->prepare("SELECT e.nome as Nome,l.nome as Disciplina,c.curso as Turma,IF(n.media>=27.6 and n.media<=27.9,'28.0',n.media) as NotaFinal,
      n.situacao as Status  from resultado_final n 
     INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas 
     INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos
      WHERE c.id_cursos=:turma and n.situacao!=:res 
      and n.ano_letivo=:ano  ORDER by e.nome asc");
      $s->bindValue(':turma',$turma);
      $s->bindValue(':ano',$ano);
      $s->bindValue(':res','reprovado');
      $s->execute();

  $dados=$s->fetchAll(PDO::FETCH_ASSOC);

  // var_dump($dados);

}

?>


<script>
  
  window.itens = JSON.parse('<?=json_encode($dados)?>');
 var s='<?=$situacao?>';
 if (s=="AP" || s=="AP_ano") {
  window.titulo="Lista de Aprovados";
 }else{
  window.titulo="Lista de Reprovados";
 }
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