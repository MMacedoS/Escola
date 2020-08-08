<?php function data($data){
        return date("d-m-Y", strtotime($data));
    }?>

<?php
    // include_once ('pdf/mpdf.php');
    $painel_atual = "professor"; 
    require_once "../config.php";
    $ano=Date('Y');
    $disc=$_GET['id'];
    $bimestre=$_GET['bimestre'];

$pagina='<!DOCTYPE html>';
$painel_atual = "professor";
$pagina.='<html lang="pt_br">';
$pagina.='<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/distribuicao.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" href="../image/logo.png">
    <title>Distribuição de Notas</title>';
     
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";
$pagina.='<style>
.table td, .table tr {
    font-size: 8px;
}
td {
border-collapse: collapse;
border: 1px black solid;
}
tr:nth-of-type(5) td:nth-of-type(1) {
visibility: hidden;
}
.rotate {
/* FF3.5+ */
-moz-transform: rotate(-90.0deg);
/* Opera 10.5 */
-o-transform: rotate(-90.0deg);
/* Saf3.1+, Chrome */
-webkit-transform: rotate(-90.0deg);
/* IE6,IE7 */
filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.083);
/* IE8 */
-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
/* Standard */
transform: rotate(-90.0deg);
}
.at{
    font-size: 10px;
}
p {
    writing-mode: vertical-rl;
    margin-top: 0px !important;
    margin-bottom: 0 !important;
    margin-left: -5px;
    margin-right: 1px;
}

</style>';

$pagina.='</head>
<body>';


    

// <!-- aqui começa tudo sobre a tabela -->

  $busca=$pdo->prepare("SELECT ch.date_day FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.disciplina=:id and bimestre=:bimestre order by ch.date_day asc");
  $busca->bindValue(':id',$disc);
  $busca->bindValue(':bimestre',$bimestre);
  $busca->execute();
  $dados=$busca->fetchAll();
 echo $dado=count($dados);
    
 $pagina.='<table class="table  table-bordered" >
<tr>
<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';

      
$pagina.=' <td bgcolor="#efefef" colspan='.$dado.' align="center"><h5><strong>Aulas Ministradas</h5></td>';
   

$pagina.=' <td bgcolor="#efefef" rowspan="2"><strong>MF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>RF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>S</strong></td>
   
</tr>
<tr>';
    foreach($dados as $res){
        $pagina.='<td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>'.data($res['date_day']).'</p></font></td>';

    }
    $pagina.='</tr>';


$chamada_aluno=$pdo->prepare("SELECT e.nome FROM estudantes e inner join cursos_estudantes ce on e.id_estudantes=ce.id_estudantes  inner join disciplinas d on d.id_cursos=ce.id_cursos  WHERE d.disciplina=:id and ce.ano_letivo=:ano order by e.nome asc");
$chamada_aluno->bindValue(':id',$disc);
$chamada_aluno->bindValue(':ano',$ano);
$chamada_aluno->execute();
$alunos=$chamada_aluno->fetchAll();
$dado_alunos=count($alunos);
foreach($alunos as $aluno){ 
$pagina.='<tr>';
$pagina.='<td colspan="1" class="at" bgcolor="#efefef" align="center"><strong>'.$aluno['nome'].'</strong></td>';
$busca_faltas=$pdo->prepare("SELECT ch.presente FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.disciplina=:id and bimestre=:bimestre order by ch.date_day asc");
  $busca_faltas->bindValue(':id',$disc);
  $busca_faltas->bindValue(':bimestre',$bimestre);
    $busca_faltas->execute();
    $dados=$busca_faltas->fetchAll();
    $dado=count($dados); 
     foreach($dados as $res){
         switch ($res['presente']) {
             case 'FALTA':
                 # code...
                 $pagina.='<td rowspan="1" class="nome" bgcolor="#efefef"><strong>F</strong></td>';
                   
                 break;
                 case 'SIM':
                    $pagina.='<td rowspan="1" class="nome" bgcolor="#efefef"><strong>*</strong></td>';
                   
                    break;
             
         }
        
     }
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong></strong></td>';
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong></strong></td>';
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong>*</strong></td>';

    
     $pagina.='</tr>';

 } 


 $pagina.='</tr>
</table>
</div>


</body>
</html>';

echo $pagina;