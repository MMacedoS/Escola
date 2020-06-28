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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/distribuicao.css">
    <title>Distribuição de Notas</title>';
     
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";
$pagina.='<style>
body{
    margin:5px;
    padding=0;
}
.table td, .table tr {
    font-size: 8px;
    width:5px;
    height:100%
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
    margin-top: 3px !important;
    margin-bottom: 1px !important;
    margin-left: 0px;
    margin-right: 1px;
}

table { page-break-inside:auto }
tr    { page-break-inside:avoid; page-break-after:auto }
thead { display:table-header-group }
tfoot { display:table-footer-group }


</style>';

$pagina.='</head>
<body>';


    

// <!-- aqui começa tudo sobre a tabela -->

  $busca=$pdo->prepare("SELECT distinct ch.date_day,l.nome FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas inner join lista_disc l on d.disciplina=l.id_lista where d.disciplina=:id and bimestre=:bimestre order by ch.date_day asc");
  $busca->bindValue(':id',$disc);
  $busca->bindValue(':bimestre',$bimestre);
  $busca->execute();
  $dados=$busca->fetchAll();
 $dado=count($dados);
 
 $pagina.='<table class="table-responsive" width="900" >
<tr>
<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';

      
$pagina.=' <td bgcolor="#efefef" colspan='.$dado.' align="center"><h5><strong>Planilha da Frequência '.$dados[0]['nome'].'</h5></td>';
   

$pagina.=' <td bgcolor="#efefef" rowspan="2"><strong>MF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>RF</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>S</strong></td>
   
</tr>
<tr>';
    foreach($dados as $res){
        $pagina.='<td bgcolor="#FFFFFF" width class="at"><font color="#090000"><p>'.data($res['date_day']).'</p></font></td>';
        

    }
    $pagina.='</tr>';


$chamada_aluno=$pdo->prepare("SELECT e.nome,e.matricula FROM estudantes e inner join cursos_estudantes ce on e.id_estudantes=ce.id_estudantes  inner join disciplinas d on d.id_cursos=ce.id_cursos  WHERE d.disciplina=:id and ce.ano_letivo=:ano order by e.nome asc");
$chamada_aluno->bindValue(':id',$disc);
$chamada_aluno->bindValue(':ano',$ano);
$chamada_aluno->execute();
$alunos=$chamada_aluno->fetchAll();
$dado_alunos=count($alunos);
foreach($alunos as $aluno){ 
$pagina.='<tr>';
$pagina.='<td colspan="1" class="at" bgcolor="#efefef" align="center"><strong>'.$aluno['nome'].'</strong></td>';
$n=0;
foreach($dados as $alun){
$busca_faltas=$pdo->prepare("SELECT distinct ch.presente FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.disciplina=:id and ch.bimestre=:bimestre and ch.matricula=:matricula and ch.date_day=:data order by ch.date_day asc");
  $busca_faltas->bindValue(':id',$disc);
  $busca_faltas->bindValue(':bimestre',$bimestre);
  $busca_faltas->bindValue(':matricula',$aluno['matricula']);
  $busca_faltas->bindValue(':data',$alun['date_day']);
    $busca_faltas->execute();
    $dados2=$busca_faltas->fetchAll();
    $dado=count($dados2); 
    
     foreach($dados2 as $res){
        $pagina.='<td rowspan="1" class="nome" bgcolor="#efefef"><strong>'.$res['presente'].'</strong></td>';
        
     
    }}
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

// $mpdf= new mPDF('','A4-L', 0, '2', 3, 3, 5, 4, 5, 3, 'L');
// $default_config= [
//     'mode' => '',
//     'format' => 'A4',
//     'default_font_size' => 0,
//     'default_font' => '',
//     'margin_left' => 15,
//     'margin_right' => 15,
//     'margin_top' => 16,
//     'margin_bottom' => 16,
//     'margin_header' => 9,
//     'margin_footer' => 9,
//     'orientation' => 'P',
// ];
// $mpdf->allow_charset_conversion=true;
// $mpdf->charset_in='UTF-8';

// $mpdf->WriteHTML("css/bootstrap.min.css",1);
// $mpdf->WriteHTML($pagina);


// $mpdf->Output('mEU PDF', 'I');
// exit();


?>
