<?php function data($data){
        return date("d-m-Y", strtotime($data));
    }?>
<?php

include_once ('pdf/mpdf.php');
$painel_atual = "admin"; 
require_once "../config.php";
$disc="Ativo";
$pagina.='<!DOCTYPE html>';
$painel_atual = "professor";
$pagina.='<html lang="pt_br">';
$pagina.='<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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


#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
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

$pagina.='<h3>Lista de acessos ao sistema painel aluno </h3>';
 $pagina.='<table id="customers" class="table-bordered" >
<tr>
<th  class="nome" bgcolor="#efefef"><strong>Alunos</strong></th>';

      
$pagina.='<th  class="nome" bgcolor="#efefef"><strong>E-mail</strong></th>';
   

$pagina.=' <th  class="nome" bgcolor="#efefef"><strong>Senha</strong></th>
        <th  class="nome" bgcolor="#efefef"><strong>Turma</strong></th>
   
</tr>';



$chamada_aluno=$pdo->prepare("SELECT l.nome as email, e.nome,c.curso, l.senha from login l inner join estudantes e on l.code=e.matricula inner join cursos_estudantes ce on ce.id_estudantes=e.id_estudantes inner join cursos c on c.id_cursos =ce.id_cursos where e.status=:status order by e.nome asc");
$chamada_aluno->bindValue(':status',$disc);
$chamada_aluno->execute();
$alunos=$chamada_aluno->fetchAll();
$dado_alunos=count($alunos);
foreach($alunos as $aluno){ 
$pagina.='<tr>';
$pagina.='<td rowspan="1" class="at"><strong>'.$aluno['nome'].'</strong></td>';
$pagina.='<td rowspan="1" class="at"><strong>'.$aluno['email'].'</strong></td>';
$pagina.='<td rowspan="1" class="at"><strong>'.$aluno['senha']." ".'</strong></td>';
$pagina.='<td rowspan="1" class="at"><strong>'.$aluno['curso'].'</strong></td>';

$pagina.='</tr>';
 } 


 $pagina.='
</table>
</div>


</body>
</html>';
// echo $pagina;

$mpdf= new mPDF('','A4-P', 0, '2', 3, 3, 5, 4, 5, 3, 'P');
$default_config= [
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => 0,
    'default_font' => '',
    'margin_left' => 15,
    'margin_right' => 15,
    'margin_top' => 16,
    'margin_bottom' => 16,
    'margin_header' => 9,
    'margin_footer' => 9,
    'orientation' => 'P',
];
$mpdf->allow_charset_conversion=true;
$mpdf->charset_in='UTF-8';

$mpdf->WriteHTML("css/bootstrap.min.css",1);
$mpdf->WriteHTML($pagina);


$mpdf->Output('Alunos.pdf', 'I');
exit();


?>
