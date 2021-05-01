<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<?php require_once "../../Control/conexao.php";

//  $turma='6';

//  $aluno='593438';

// $aluno='todos';

 $turma=$_GET['turma'];

 $aluno=$_GET['aluno'];

 $ano=$_GET['ano'];

 $clientes = [];

 

 include_once('../pdf/mpdf.php');

 

 if ($aluno=='todos') {

          # code...

     $busca_aluno=$pdo->query("SELECT e.nome,e.matricula,c.curso,c.id_categoria FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on ce.id_cursos=c.id_cursos where c.id_cursos='$turma' and ce.ano_letivo='$ano'");

     $busca_aluno=$busca_aluno->fetchAll(PDO::FETCH_ASSOC);

     $countBoletim=count($busca_aluno);

    //  echo $countBoletim;

    //  die;

 }else{

    $busca_aluno=$pdo->query("SELECT e.nome,e.matricula,c.curso FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on ce.id_cursos=c.id_cursos where c.id_cursos='$turma' AND e.matricula='$aluno' and ce.ano_letivo='$ano'");

    $busca_aluno=$busca_aluno->fetchAll(PDO::FETCH_ASSOC);

    $countBoletim=count($busca_aluno);

 }

 $pagina="";

$pagina.='<html>';

    $pagina.='<head>

    <style>

        

        #customers {

            // margin-top:3%;

            margin-top:5%;

            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

            border-collapse: collapse;

            width: 100%;

            border: 1px solid #ddd;

        }

        

        #customers tr:nth-child(even) {

            background-color: #ffff99;

        }

        

        #customers tr:hover {

            background-color: #ddd;

        }

        

        #customers th {

            padding-top: 10px;

            padding-bottom: 10px;

            text-align: left;

            background-color: #4CAF50;

            color: white;

        }

        

        table,

        th,

        td {

            border: 1px solid black;

            white-space: nowrap;

        }

        .titulo{

            text-align:center;

        }

        .rodape{

            // margin-top:100px;

        }

        

    </style>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <title>Boletim Alunos</title>

</head>

';





$pagina.='<body>';

if($busca_aluno[0]['id_categoria']>=3)
{
    $ensino=$busca_aluno[0]['curso']." do Ensino Médio";
}elseif($busca_aluno[0]['id_categoria']==2)
{
    $ensino=$busca_aluno[0]['curso']." do Ensino Fundamental Anos Finais";
}else
{
    $ensino=$busca_aluno[0]['curso']." do Ensino Fundamental Anos Iniciais";
}
$pagina.='<table id="customers" width="100%">
<tr>
<th width="33%" colspan="3"  style="font-size: 24;" align="center"><strong>Instituto Social de Tucano</strong></th> 
</tr>
<tr>
    <td width="50%">End: Avenida Francisco Araújo de Souza, s/n.</td>

    <td width="25%" align="center">Cep: 48790-000</td>

    <td width="25%" style="text-align: right;">Cidade: Tucano-Ba</td>

</tr>
</table>

<h4>ATA DE RESULTADOS FINAIS - '.$ensino.' - '.$ano.' </h4>

';

 


   $pagina.='<table id="customers">';

    $pagina.='<tr>';

    $pagina.='<th colspan="1" rowspan="2"><center>Estudantes</center></th>';

    $disciplinas=$pdo->query("SELECT l.nome,d.id_disciplinas as disciplina FROM lista_disc l INNER JOIN disciplinas d on d.disciplina=l.id_lista where d.id_cursos='$turma'");

    $disciplinas=$disciplinas->fetchAll(PDO::FETCH_ASSOC);

    $countBimestre=count($disciplinas);

    $pagina.='<th colspan="'.$countBimestre.'"><center>Disciplinas</center></th>';

    // $pagina.='<th colspan="1" rowspan="2"><center>RF</center></th>';

    $pagina.='</tr>';

    $pagina.='<tr>';    

            foreach($disciplinas as $bim=>$res_bim){
                $nomedisciplina=substr($res_bim['nome'],0,11);
                $pagina.= '

                <th color="#ffffff"><center>'.$nomedisciplina.'</center></th>'; }   

 $pagina.='</tr>';

    

 $pagina.='<tr>';

            

            foreach($busca_aluno as $key=>$value){
             $pagina.='<tr>';
             
             $pagina.='<td colspan="1" >'.$value['nome'].'</td>';   
             foreach($disciplinas as $key=>$disc){             
             $busca_notas=$pdo->query("SELECT n.media,n.code FROM resultado_final n where n.id_disciplinas=".$disc['disciplina']." and n.code=".$value['matricula']." and n.ano_letivo='$ano'");

             $busca_notas=$busca_notas->fetchAll(PDO::FETCH_ASSOC);
             foreach($busca_notas as $nota=>$notas){

                $soma=number_format($notas['media']/4,1,'.','');

                        $pagina.='<td><center><font color="blue">'.$soma.'</font></center></td>';
                   
                
            }

        }

            //  $pagina.="<td>000</td>";   
            $pagina.='</tr>';

        }



            

$pagina.='</tr>';






    $pagina.='</table>';



   

   

    $pagina.='</body>';



$pagina.='</html>';



$html=$pagina;



// echo $pagina;



// var_dump($clientes[1]);

// die




$mpdf = new \mPDF("utf-8", 'A4-L');
$mpdf->allow_charset_conversion = true;                                
$mpdf->pdf->charset_in = 'iso-8859-1';
$mpdf->DeflMargin = 3;

$mpdf->DefrMargin = 3;

$mpdf->SetTopMargin(3);

$mpdf->AddPage();



    $mpdf->WriteHTML($html);

    $mpdf->Ln(2);



$mpdf->Output('Boletim.pdf', 'I');




 

?>