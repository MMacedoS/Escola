<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<?php

    include('pdf/mpdf.php');

    $painel_atual = "professor"; 

    require_once "../config.php";



    $id=$_GET['id'];

    $ano=$_GET['ano'];

    $curso=$_GET['curso'];

    $nomed=$_GET['nomed'];

    $nomec=$_GET['nomec'];

    $pagina.="<html>";

    $pagina.='<link rel="shortcut icon" href="../image/logo.png">';

    $pagina.='<style>

    .table td, .table tr {

        font-size: 10px;

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

    #customers {

        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

        border-collapse: collapse;

        width: 100%;

        border: 1px solid #ddd;

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

      table, th, td {

        border: 1px solid black;

      }

    

</style>';

///pode remover o costumer e as bordas que a table fica ajustada tambem 



    // $pagina.="<body>";

    // $pagina.='<h1 align="center">Planilha de Notas:'.$nomed.' '.$nomec.'</h1>';    

    $pagina.='<table id="customers" width="100%">

<tr>

   

    <th width="33%" colspan="3"  style="font-size: 18;" align="center"><strong>Instituto Social de Tucano</strong></th>

   

</tr>

<tr>

    <td width="50%" colspan="3" align="center">Distribuição de Notas</td>

   

</tr>

<tr>

    <td width="50%">Turma:<strong> '.$nomec.'</strong></td>

    <td width="25%" align="center">Disciplina: '.$nomed.'</td>

    <td width="25%" style="text-align: right;">Ano: '.$ano.'</td>

</tr>

</table>

';

    $pagina.='<table id="customers" class=".table-responsive{-sm|-md|-lg|-xl} table"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">';

    $pagina.="<tr>";

    $pagina.='<td rowspan="2" width="20%" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';

    

    $select=$pdo->query("SELECT DISTINCT bimestre FROM `notas_bimestres` where id_disciplinas='$id' and ano_letivo='$ano' ");
        $select=$select->fetchAll(PDO::FETCH_ASSOC);
        $unidade=count($select);

        foreach($select as $key=>$res_con){

            $arrayEmails[]= $res_con["bimestre"];



    $pagina.='<td bgcolor="#efefef" colspan="7" align="center"><strong>'.$res_con['bimestre'].' Unidade </strong></td>';}//finalizando lista de unidades na tablea

    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>TO</strong></td>';

    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>MF</strong></td>';

    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>RF</strong></td>';

    $pagina.="</tr>";

    if($unidade>0){

        $pagina.="<tr>"; 

    while($unidade>0){//listando os titulos da atividades

    

    $pagina.='<td bgcolor="#FFFFF1" class="at"><font color="#090000"><p>1ªA</p></font></td>

    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>2ªA</p></font></td>

    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>3ªA</p></font></td>

    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>4ªA</p></font></td>

    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>AP</p></font></td>

    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>Nota</p></font></td>

    <td bgcolor="#FF643F" class="at"><font color="#090000"><p>RS</p></font></td>';

  

    

    $unidade-=1;

    }//finalizando whilw lista atividades

    $pagina.="</tr>";

            $sql=$pdo->query("SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' and e.status='Ativo' order by e.nome asc");
            $sql=$sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($sql as $est=>$res){///listando os alunoss

    $pagina.="<tr>";

    $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['nome'].'</font></td>';

    $pagina.="</tr>"; 

                    // listando notas atividades

    for($i=0;$i< count($arrayEmails);$i++){

     $atividade=$pdo->query("select nota from notas_atividades where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula']);
        $atividade=$atividade->fetchAll(PDO::FETCH_ASSOC);
        $qtdeAti=count($atividade);
    if($qtdeAti==0){

        $media1=0;

        

        $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';

            

        }else{

    

    foreach($atividade as $ativ=>$resAti){

    $media1=$media1+$resAti['nota'];

    

    $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resAti['nota'].'</font></td>';



    

     }

     }///finalizando lista atividades

    //  p-i

   //  <!-- coc -->:

   $COC=$pdo->query("select nota from notas_ava_coc where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula']);
     $COC=$COC->fetchAll(PDO::FETCH_ASSOC);

     $qtdeCoc=count($COC);
   if($qtdeCoc==0){

      $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';



       }else{

   

   foreach($COC as $coc=>$resCoc){

   $media1=$media1+$resCoc['nota'];

   $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resCoc['nota'].'</font></td>';

    }

    }

    //  <!-- teste -->



    

    $sqlTeste=$pdo->query("select nota from notas_ava_teste where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula']);
    $sqlTeste=$sqlTeste->fetchAll(PDO::FETCH_ASSOC);
    
    
    $qtdeTeste=count($sqlTeste);
    if($qtdeTeste==0){

        

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';

            

        }else{

    

    foreach($sqlTeste as $key=>$resTeste){

    $media1=$media1+$resTeste['nota'];

    

    $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resTeste['nota'].'</font></td>';

       

     }

     }

    

    //  <!-- prova -->

     

         

         $sqlProva=$pdo->query("select nota from notas_ava_prova where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula']);
        $sqlProva=$sqlProva->fetchAll(PDO::FETCH_ASSOC);
        $qtdeProva=count($sqlProva);
        if($qtdeProva==0){

             

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';

                 

             }else{

         

         foreach($sqlProva as $key=>$resProva){

         $media1=$media1+$resProva['nota'];

         

         $pagina.='<td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000">'.$resProva['nota'].'</font></td>'; 

         

          }

          }

          //  <!-- pARALELA -->:

         $sqlPara=$pdo->query("select nota from paralela where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula']);
          $sqlPara=$sqlPara->fetchAll(PDO::FETCH_ASSOC);
          $qtdePara=count($sqlPara);


         if($qtdePara==0){

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">0</font></td>';



             }else{

         

         foreach($sqlPara as $key=>$resPara){

         $media1=$media1+$resPara['nota'];

         $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resPara['nota'].'</font></td>';

          }

          }

          

           //  <!-- notas_bimestres -->:

         $sqlNotaB=$pdo->query("select nota from notas_bimestres where bimestre=".$arrayEmails[$i]." and id_disciplinas='$id' and code=".$res['matricula']);
          $sqlNotaB=$sqlNotaB->fetchAll(PDO::FETCH_ASSOC);

          $qtdeNota=count($sqlNotaB);

         if($qtdeNota==0){

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';



             }else{

         

         foreach($sqlNotaB as $key=>$resNotas){

         $media1=$resNotas['nota'];

            if($media1==6.9){

              $media1=7;

            }

         if($media1>=7){

         $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#01DF01">'.$resNotas['nota'].'</font></td>';}else{

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#FF0000">'.$resNotas['nota'].'</font></td>';

         }



          }

          }

          if($media1>=7){

          $pagina.='<td bgcolor="#A9F5A9" class="at"><font color="#090000">AP</font></td>';
        }else{

            $pagina.='<td bgcolor="#F78181" class="at"><font color="#090000">RP</font></td>';

          }

          



}//finalizando lista de alunos

    $sqlResFinal=$pdo->query("select media,recuperacao from resultado_final where id_disciplinas='$id' and code=".$res['matricula']);
        $sqlResFinal=$sqlResFinal->fetchAll(PDO::FETCH_ASSOC);

        $qtdeRes=count($sqlResFinal);
         if($qtdeRes==0){

            $pagina.='<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>';

        }else{

         

            foreach($sqlResFinal as $key=>$resFinal){

            $media1=$resFinal['media'];

            if($media1>=27.6 && $media1<=27.9){ $media1=28.00;}

            $media=round($media1/4,1);

            if($media1>=28){               

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#01DF01">'.$resFinal['media'].'</font></td>';

            $pagina.='<td bgcolor="green" class="at" align="center"><font color="#090000">'.$media.'</font></td>';

            $pagina.='<td bgcolor="#FFAAA" class="at" align="center"><font color="#090000">AP</font></td>';

        }else{

            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#FF0000">'.$resFinal['media'].'</font></td>';
            if($resFinal['recuperacao']>=6){
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resFinal['recuperacao'].'</font></td>';
            $pagina.='<td bgcolor="#FFAAA" class="at" align="center"><font color="#090000">AF</font></td>';
            
            }else{
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.number_format($media,2,",",".").'</font></td>';
            $pagina.='<td bgcolor="#FFAAA" class="at" align="center"><font color="#090000">RP</font></td>';
            }

            }//if media

   

             }//whileee

             }//if num rows





            }//listando os alunos

}//if unidade

    $pagina.="</table>";

    $pagina.="<br>";

    // $pagina.='<p>TO=total</br>MF=media final/RF=Resultado Final/AT=>Atividades/P_I=>Proj_Inter/ P_T=>Proj_transversal/ AV=>Teste/ COC / AF=>Prova/ T=total unidade/S= situação<</p>';

    $pagina.="</body>";

    $pagina.='';

        

    $pagina.="</html>";

                

    $arquivo= "Cadastro01.pdf";

    $mpdf= new mPDF('','A4-L', 0, '2', 3, 3, 5, 4, 5, 3, 'L');

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

    $mpdf->SetDisplayMode('fullwidth');

    $mpdf->WriteHTML($pagina);



    $mpdf->Output($arquivo, 'I');







?>

<script>

$(document).ready(function() {

  $('.rotate').css('height', $('.rotate').width());

});

</script>