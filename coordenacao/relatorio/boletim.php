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



    

 foreach($busca_aluno as $est=>$estudantes){

     $aluno=$estudantes['matricula'];





$pagina="";

$pagina.='<html>';



if($estudantes['id_categoria']<3){

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

            background-color: #f2f2f2;

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

}else{

    $pagina.='<head>

    <style>

        

        #customers {

            margin-top:3%;

            

            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

            border-collapse: collapse;

            width: 100%;

            border: 1px solid #ddd;

        }

        

        #customers tr:nth-child(even) {

            background-color: #f2f2f2;

        }

        

        #customers tr:hover {

            background-color: #ddd;

        }

        

        #customers th {

            padding-top: 0px;

            padding-bottom: 0px;

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

}



$pagina.='<body>';

    

$pagina.='<table id="customers" width="100%">

<tr>

   

    <th width="33%" colspan="3"  style="font-size: 24;" align="center"><strong>Instituto Social de Tucano</strong></th>

   

</tr>

<tr>

    <td width="50%">End: Avenida Francisco Araújo de Souza, s/n.</td>

    <td width="25%" align="center">Cep: 48790-000</td>

    <td width="25%" style="text-align: right;">Cidade: Tucano-Ba</td>

</tr>

<tr>

    <td width="50%">Aluno:<strong> '.$estudantes['nome'].'</strong></td>

    <td width="25%" align="center">Turma: '.$estudantes['curso'].'</td>

    <td width="25%" style="text-align: right;">Codigo: '.$aluno.'</td>

</tr>

</table>

segue abaixo as notas e suas respectivas disciplinas

';

    // $pagina.='<div class="titulo">';

    // // $pagina.='<h1> Boletim Escolar</h1>';

    // $pagina.='</div>';

    $pagina.='<br>';

    

    // $pagina.='<div class="row"><h2>Aluno:<font color="blue">  '.$estudantes['nome'].'</font>    Turma:<font color="blue">  '.$estudantes['curso'].'</font></h2></div>';

    $pagina.='<br>';

    $pagina.='<table id="customers">';

    $pagina.='<tr>';

    $pagina.='<th colspan="1" rowspan="2"><center>Disciplinas</center></th>';

    $bimestre=$pdo->query('SELECT unidade from unidades order by unidade asc');

    $bimestre=$bimestre->fetchAll(PDO::FETCH_ASSOC);

    $countBimestre=count($bimestre);

    $pagina.='<th colspan="'.$countBimestre.'"><center>Bimestres</center></th>';

    $pagina.='<th colspan="1" rowspan="2"><center>Total</center></th>';

    $pagina.='<th colspan="1" rowspan="2"><center>MF</center></th>';

    $pagina.='<th colspan="1" rowspan="2"><center>RF</center></th>';

    // $pagina.='<th colspan="1" rowspan="2"><center>RF</center></th>';

    $pagina.='</tr>';

    $pagina.='<tr>';    

            foreach($bimestre as $bim=>$res_bim){

                $pagina.= '

                <th><center>'.$res_bim['unidade'].' Bimestre:</center></th>'; }   

 $pagina.='</tr>';

    

 $pagina.='<tr>';

    $busca_disciplina=$pdo->query("select l.nome,d.id_disciplinas as disciplina FROM lista_disc l INNER JOIN disciplinas d on d.disciplina=l.id_lista where d.id_cursos='$turma'");

            $busca_disciplina=$busca_disciplina->fetchAll(PDO::FETCH_ASSOC);

            foreach($busca_disciplina as $key=>$value){

             $pagina.='<tr>';

                $pagina.='<td colspan="1"><center>'.$value['nome'].'</center></td>';

                // busca notas

               

                for ($i=1; $i <= $countBimestre; $i++) { 

                    # code...

                   

                $busca_notas=$pdo->query("select n.nota as nota FROM notas_bimestres n where n.id_disciplinas=".$value['disciplina']." and n.code='$aluno' and bimestre=".$i." and n.ano_letivo='$ano'");

                    $busca_notas=$busca_notas->fetchAll(PDO::FETCH_ASSOC);

                    $countNota=count($busca_notas);

                    

                    

                    

                    foreach($busca_notas as $nota=>$notas){

                        $nota=$notas['nota'];

                        if($nota==6.9){

                            $nota=7;

                        }

                        if($nota>=7){

                        $pagina.= '<td><center>'.$nota.'</center></td>';

                        }else{

                            $pagina.='<td><center><font color="red">'.$notas['nota'].'</font></center></td>';

                        }

                    }

                    if($busca_notas==false){

                        $pagina.='<td></td>';

                    }

                }



                // buaca dos valor total da nota final

                $busca_notas=$pdo->query("SELECT n.media FROM resultado_final n where n.id_disciplinas=".$value['disciplina']." and n.code='$aluno' and n.ano_letivo='$ano'");

                        $busca_notas=$busca_notas->fetchAll(PDO::FETCH_ASSOC);

                        foreach($busca_notas as $nota=>$notas){

                            $soma=$notas['media'];

                            if($soma>=27.6 && $soma<=27.9){

                                $soma=28.00;

                            }

                            if($soma>=28){

                            $pagina.= '<td><center>'.number_format($soma,1,'.','').'</center></td>';

                            }else{
                                
                                    $pagina.='<td><center><font color="red">'.number_format($notas['media'],1,'.','').'</font></center></td>';
                                
                                

                            }

                        }

                // media da nota final 

                        $busca_notas=$pdo->query("SELECT n.media,n.recuperacao FROM resultado_final n where n.id_disciplinas=".$value['disciplina']." and n.code='$aluno' and n.ano_letivo='$ano'");

                        $busca_notas=$busca_notas->fetchAll(PDO::FETCH_ASSOC);

                        foreach($busca_notas as $nota=>$notas){

                            $media=$notas['media'];

                            if($media>=27.6 && $media<=27.9){

                                $media=28.00;

                            }

                            $media=number_format($media/4,1,'.','');

                            if($media>=7){

                               

                            $pagina.= '<td><center>'.$media.'</center></td>';

                            }else{
                                if($notas['recuperacao']>=6){
                                    $pagina.='<td><center><font color="blue">'.number_format($notas['recuperacao'],1,'.','').'</font></center></td>';
                                }else{
                                    $pagina.='<td><center><font color="red">'.$media.'</font></center></td>';
                                }

                                

                            }

                        }



                        $busca_notas=$pdo->query("SELECT n.situacao as situacao FROM resultado_final n where n.id_disciplinas=".$value['disciplina']." and n.code='$aluno' and n.ano_letivo='$ano'");

                        $busca_notas=$busca_notas->fetchAll(PDO::FETCH_ASSOC);

                        foreach($busca_notas as $nota=>$notas){

                            if($notas['situacao']=='aguardando resultado'){

                                $pagina.= '<td><center>Aguarda</center></td>';

                            }else

                            {

                                $pagina.= '<td><center>'.$notas['situacao'].'</center></td>';

                            }

                        }



            //     $pagina.='<td>';

            //     $pagina.='sdasdsad';                

            // $pagina.='</td>'; 

               

            $pagina.='</tr>';

            }



            

$pagina.='</tr>';





    $pagina.='<tr>';

    $pagina.='<th colspan="7">As siglas MF= Média Final, RF=  Resultado final</th>';

    $pagina.='<tr>';

    $pagina.='</table>';



   

   

    $pagina.='</body>';



$pagina.='</html>';

array_push($clientes,$pagina);





}

// echo $pagina;



// var_dump($clientes[1]);

// die



$mpdf = new \mPDF("", 'A4');

$mpdf->DeflMargin = 3;

$mpdf->DefrMargin = 3;

$mpdf->SetTopMargin(3);

$mpdf->AddPage();



foreach ($clientes as $boleto) {

    

    $html =$boleto;

    $mpdf->WriteHTML($html);

    $mpdf->Ln(2);

}

$mpdf->Output('Boletim.pdf', 'I');



// for($i=0;$i<10; $i++){

//     $mpdf= new mPDF('','A4-P', 0, '2', 3, 3, 5, 4, 5, 3, 'P');

//     $mpdf->AddPage();

//     $mpdf->WriteHTML($clientes[$i]);

//     $mpdf->Ln(2);

//     $mpdf->Output('sadasd', 'F');

    

// }



// $mpdf->Output('Boletim.pdf', 'I');

// $arquivo= "Cadastro01.pdf";

// $mpdf= new mPDF('','A4-P', 0, '2', 3, 3, 5, 4, 5, 3, 'P');

// // $default_config= [

// //     'mode' => '',

// //     'format' => 'A4',

// //     'default_font_size' => 0,

// //     'default_font' => '',

// //     'margin_left' => 15,

// //     'margin_right' => 15,

// //     'margin_top' => 16,

// //     'margin_bottom' => 16,

// //     'margin_header' => 9,

// //     'margin_footer' => 9,

// //     'orientation' => 'P',

// // ];

// $mpdf->showImageErrors = true;

// $mpdf->SetHTMLHeader(

//     '<table id="customers" width="100%">

// <tr>

   

//     <th width="33%" colspan="3"  style="font-size: 24;" align="center"><strong>Instituto Social de Tucano</strong></th>

   

// </tr>

// <tr>

//     <td width="50%">End: Avenida Francisco Araújo de Souza, s/n.</td>

//     <td width="25%" align="center">Cep: 487930-000</td>

//     <td width="25%" style="text-align: right;">Cidade: Tucano-Ba</td>

// </tr>

// <tr>

//     <td width="50%">Aluno:<strong> '.$estudantes['nome'].'</strong></td>

//     <td width="25%" align="center">Turma: '.$estudantes['curso'].'</td>

//     <td width="25%" style="text-align: right;">Codigo: '.$aluno.'</td>

// </tr>

// </table>

// segue abaixo as notas e suas respectivas disciplinas

// ');



// $mpdf->SetHTMLFooter('

// <table width="100%">

//     <tr>

//         <td width="33%">{DATE d-m-Y}</td>

//         <td width="33%" align="center">{PAGENO}/{nbpg}</td>

//         <td width="33%" style="text-align: right;">Meu Boletim</td>

//     </tr>

// </table>');

// $mpdf->AddPage('E');

// $mpdf->SetDisplayMode('fullpage');

// // $mpdf->SetDisplayMode('fullwidth');



// $mpdf->WriteHTML($pagina);



// $mpdf->Output('Boletim.pdf', 'I');

 

?>