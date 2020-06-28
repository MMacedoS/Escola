<?php $painel_atual = "professor"; 
    require_once "../config.php";?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php
    include('pdf/mpdf.php');
    require_once "../config.php";
    $id=base64_decode($_GET['id']);
    $ano=Date('Y');
    $curso=base64_decode($_GET['curso']);
    $nomed=base64_decode($_GET['nomed']);
    $nomec=base64_decode($_GET['nomec']);
    $bimestre=base64_decode($_GET['bimestre']);
    $pagina="<html>";
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
    table, th, td {
        border: 1px solid black;
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
    
</style>';
// $pagina.='<link rel="shortcut icon" href="../image/logo_ist.gif">';
    $pagina.="<body>";
    $pagina.='<h1 align="center">Planilha de Notas:'.$nomed.' '.$nomec.'</h1>';    
    $pagina.='<table id="customers" class="table-responsive{-sm|-md|-lg|-xl} table"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">';
    $pagina.="<tr>";
    $pagina.='<th rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></th>';
    
    $select="SELECT DISTINCT bimestre FROM `notas_bimestres` where id_disciplinas='$id' and ano_letivo='$ano' and bimestre='$bimestre'";
        $con_select=mysqli_query($conexao, $select);
        $unidade=mysqli_num_rows($con_select);
        while($res_con=mysqli_fetch_assoc($con_select)){
            $arrayEmails[]= $res_con["bimestre"];

    $pagina.='<th bgcolor="#efefef" colspan="7" align="center"><strong>'.$res_con['bimestre'].' Unidade </strong></th>';}//finalizando lista de unidades na tablea
    
    $pagina.="</tr>";
    if($unidade>0){
        $pagina.="<tr>"; 
    while($unidade>0){//listando os titulos da atividades
    
    $pagina.='<td bgcolor="#FFFFF1" class="at"><font color="#090000"><p>1ª Atividade</p></font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>2ª Atividade</p></font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>3ª Atividade</p></font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>4ª Atividade</p></font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>Paralela</p></font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000"><p>Total</p></font></td>
    <td bgcolor="#FF643F" class="at"><font color="#090000"><p>Situação</p></font></td>';
  
    
    $unidade-=1;
    }//finalizando whilw lista atividades
    $pagina.="</tr>";
            $sql="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' order by e.nome asc";
            $con=mysqli_query($conexao,$sql);
            while($res=mysqli_fetch_assoc($con)){///listando os alunoss
    $pagina.="<tr>";
    $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['nome'].'</font></td>';
    $pagina.="</tr>"; 
                    // listando notas atividades
    for($i=0;$i< count($arrayEmails);$i++){
     $sqlTrans="select nota from notas_atividades where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        $media1=0;
        
        $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';
            
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    
    $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resTrans['nota'].'</font></td>';

    
     }
     }///finalizando lista atividades
    //  p-i
   //  <!-- coc -->:
   $sqlTrans="select nota from notas_ava_coc where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula'];
   $conTrans=mysqli_query($conexao,$sqlTrans);
   if(mysqli_num_rows($conTrans)==""){
      $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';

       }else{
   
   while($resTrans=mysqli_fetch_assoc($conTrans)){
   $media1=$media1+$resTrans['nota'];
   $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resTrans['nota'].'</font></td>';
    }
    }
    //  <!-- teste -->

    
    $sqlTrans="select nota from notas_ava_teste where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula'];
    $conTrans=mysqli_query($conexao,$sqlTrans);
    if(mysqli_num_rows($conTrans)==""){
        
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';
            
        }else{
    
    while($resTrans=mysqli_fetch_assoc($conTrans)){
    $media1=$media1+$resTrans['nota'];
    
    $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resTrans['nota'].'</font></td>';
       
     }
     }
    
    //  <!-- prova -->
     
         
         $sqlTrans="select nota from notas_ava_prova where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula'];
         $conTrans=mysqli_query($conexao,$sqlTrans);
        if(mysqli_num_rows($conTrans)==""){
             
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';
                 
             }else{
         
         while($resTrans=mysqli_fetch_assoc($conTrans)){
         $media1=$media1+$resTrans['nota'];
         
         $pagina.='<td bgcolor="#FFFFFF"  class="at" align="center"><font color="#090000">'.$resTrans['nota'].'</font></td>'; 
         
          }
          }
          //  <!-- pARALELA -->:
         $sqlTrans="select nota from paralela where bimestre=".$arrayEmails[$i]." and id_disciplina='$id' and code=".$res['matricula'];
         $conTrans=mysqli_query($conexao,$sqlTrans);
         if(mysqli_num_rows($conTrans)==""){
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">0</font></td>';

             }else{
         
         while($resTrans=mysqli_fetch_assoc($conTrans)){
         $media1=$media1+$resTrans['nota'];
         $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#090000">'.$resTrans['nota'].'</font></td>';
          }
          }
          
           //  <!-- notas_bimestres -->:
         $sqlTrans="select nota from notas_bimestres where bimestre=".$arrayEmails[$i]." and id_disciplinas='$id' and code=".$res['matricula'];
         $conTrans=mysqli_query($conexao,$sqlTrans);
         if(mysqli_num_rows($conTrans)==""){
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="blue">aguarda</font></td>';

             }else{
         
         while($resTrans=mysqli_fetch_assoc($conTrans)){
         $media1=$resTrans['nota'];
         if($media1>=7){
         $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#01DF01">'.$resTrans['nota'].'</font></td>';}else{
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#FF0000">'.$resTrans['nota'].'</font></td>';
         }

          }
          }
          if($media1>=7){
          $pagina.='<td bgcolor="#A9F5A9" align="center" class="at"><font color="#090000">Aprovado</font></td>';}else{
            $pagina.='<td bgcolor="#F78181" align="center" class="at"><font color="#090000">Reprovado</font></td>';
          }
          

}//finalizando lista de alunos
   


            }//listando os alunos
}//if unidade
    $pagina.="</table>";
    $pagina.="<br>";
    // $pagina.='<p>TO=total</br>MF=media final/RF=Resultado Final/AT=>Atividades/P_I=>Proj_Inter/ P_T=>Proj_transversal/ AV=>Teste/ COC / AF=>Prova/ T=total unidade/S= situação<</p>';
    $pagina.="</body>";
    $pagina.='';
        
    $pagina.="</html>";
        //   echo $pagina;      
    $arquivo= "Cadastro01.pdf";
    $mpdf= new mPDF('','A4-P', 0, '2', 3, 3, 5, 4, 5, 3, 'P');
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