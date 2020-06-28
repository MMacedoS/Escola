<?php function data($data){
        return date("d-m", strtotime($data));
    }?>
<?php
// namespace Mpdf; //mpf importado
// error_reporting(0); //concertando erro de vizualizaçao
// ini_set('display_errors', 0);
// include_once ('pdf/mpdf.php');
require_once '../vendor/autoload.php';
$painel_atual = "Coordenacao"; 
require_once "../config.php";
$ano=Date('Y');
$disc=base64_decode($_GET['id']);
$bimestre=base64_decode($_GET['bimestre']);
$pagina='<!DOCTYPE html>';
$painel_atual = "Coordenacao";
$pagina.='<html lang="pt_br">';
$pagina.='<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Distribuição de Frequencia</title>';
     
    
    // $go_to_url é o link do banner
// echo "<script>window.open('gerar_pdf.php', '_blank');</script>";
$pagina.='<style type="text/css">
body{
    margin:5px;
    padding=0;
}
* {
    box-sizing: border-box;
  }
  
  .wrapper {
    border: 5px dotted black;
  }
.p {
    writing-mode: vertical-rl !important;
    -webkit-writing-mode: vertical-rl !important;
    -ms-writing-mode: vertical-rl !important;
    text-orientation: mixed;
    margin-top: 3px !important;
    margin-bottom: 1px !important;
    margin-left: 0px !important;
    margin-right: 1px !important;
}

span.test2 {
  writing-mode: vertical-rl; 
}
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    page-break-inside:avoid
  }
  
  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  #customers tr:nth-child(even){background-color: #f2f2f2;}
  
  #customers tr:hover {background-color: #ddd;}
  
  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }

</style>';

$pagina.='</head>
<body>';


    

// <!-- aqui começa tudo sobre a tabela -->

  $busca=$pdo->prepare("SELECT distinct ch.date_day,l.nome FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas inner join lista_disc l on d.disciplina=l.id_lista where d.id_disciplinas=:id and bimestre=:bimestre order by ch.date_day asc");
  $busca->bindValue(':id',$disc);
  $busca->bindValue(':bimestre',$bimestre);
  $busca->execute();
  $dados=$busca->fetchAll();
 $dado=count($dados);
 
 $pagina.='<table class="table-responsive" id="customers" width="900" >
<tr>
<td rowspan="2"  class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';

      
$pagina.=' <td bgcolor="#efefef" colspan='.$dado.' align="center"><h5><strong>Planilha da Frequência Ano: '.$ano.' '.$dados[0]['nome'].' '.$bimestre.' bimestre</h5></td>';
   

$pagina.=' <td bgcolor="#efefef" rowspan="2"><strong>Presença</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>Faltas</strong></td>
    <td bgcolor="#efefef" rowspan="2"><strong>Total</strong></td>
   
</tr>
<tr>';
    foreach($dados as $res){
        $pagina.='<td bgcolor="#FFFFFF" style="rotate:90;" id="p" class="p" ><span class="test2">'.data($res['date_day']).'</span></td>';
        

    }
    $pagina.='</tr>';


$chamada_aluno=$pdo->prepare("SELECT e.nome,e.matricula FROM estudantes e inner join cursos_estudantes ce on e.id_estudantes=ce.id_estudantes  inner join disciplinas d on d.id_cursos=ce.id_cursos  WHERE d.id_disciplinas=:id and ce.ano_letivo=:ano order by e.nome asc");
$chamada_aluno->bindValue(':id',$disc);
$chamada_aluno->bindValue(':ano',$ano);
$chamada_aluno->execute();
$alunos=$chamada_aluno->fetchAll();
$dado_alunos=count($alunos);
foreach($alunos as $aluno){ 
$pagina.='<tr>';
$pagina.='<td colspan="1" class="at" bgcolor="#efefef" align="center"><strong>'.$aluno['nome'].'</strong></td>';
$p=0;
$f=0;
$dado=0; 
foreach($dados as $alun){
$busca_faltas=$pdo->prepare("SELECT distinct ch.presente FROM chamadas_em_sala ch inner join estudantes e on e.matricula=ch.matricula inner join disciplinas d on d.id_disciplinas=ch.id_disciplinas where d.id_disciplinas=:id and ch.bimestre=:bimestre and ch.matricula=:matricula and ch.date_day=:data order by ch.date_day asc");
  $busca_faltas->bindValue(':id',$disc);
  $busca_faltas->bindValue(':bimestre',$bimestre);
  $busca_faltas->bindValue(':matricula',$aluno['matricula']);
  $busca_faltas->bindValue(':data',$alun['date_day']);
    $busca_faltas->execute();
    $dados2=$busca_faltas->fetchAll();
    
    
     foreach($dados2 as $res){
            $dado=$dado+1;
         if($res['presente']=='SIM'){
            $pagina.='<td rowspan="1" class="nome" bgcolor="#efefef"><strong>*</strong></td>';
            $p=$p+1;
         }else{
            $pagina.='<td rowspan="1" class="nome" bgcolor="#efefef"><strong>F</strong></td>';
            $f=$f+1;
         }
       
        
     
    }}
    $p=number_format(($p*100)/$dado,1);
    $f=number_format(($f*100)/$dado,1);
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong>'.$p.'%</strong></td>';
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong>'.$f.'%</strong></td>';
     $pagina.=' <td rowspan="1" class="nome" bgcolor="#efefef"><strong>'.$dado.'</strong></td>';

    
     $pagina.='</tr>';

 } 


 $pagina.='</tr>
</table>
</div>


</body>
</html>';
// echo $pagina;
// $mpdf = new \Mpdf\Mpdf();
// $mpdf = new Mpdf\Mpdf();
// $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
// $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
// $mpdf= new \Mpdf\mPDF(['','A4', 0, '2', 3, 3, 5, 4, 5, 3, 'L']);
$mpdf = new \Mpdf\Mpdf([
	'margin_top' => 3,
	'margin_left' => 2,
	'margin_right' => 2,
  'mirrorMargins' => true,
  'orientation' => 'L'
]);
// $default_config= [
//     // 'mode' => '',
//     // 'format' => 'A4-L',
//     // 'default_font_size' => 0,
//     // 'default_font' => '',
//     // 'margin_left' => 15,
//     // 'margin_right' => 15,
//     // 'margin_top' => 16,
//     // 'margin_bottom' => 16,
//     // 'margin_header' => 9,
//     // 'margin_footer' => 9,
//     // 'orientation' => 'L',
// ];
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';

$css = file_get_contents("css/distribuicao1.css");

$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($pagina);
$mpdf->shrink_tables_to_fit = 1;

// $mpdf->WriteHTML($css,1);
// $mpdf->WriteHTML($pagina);


$mpdf->Output('Frequencia.pdf', 'I');
exit();


?>
