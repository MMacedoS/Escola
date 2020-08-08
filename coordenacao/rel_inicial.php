
<?php
    include('pdf/mpdf.php');
    $painel_atual = "professor"; 
    require_once "../config.php";
    $id=$_GET['id'];
    $ano=Date('Y');
    $curso=$_GET['curso'];
    $nomed=$_GET['nomed'];
    $nomec=$_GET['nomec'];

    $pagina.="<html>";
    $pagina.='<style>
    .table td, .table tr {
        font-size: 10px;
    }
    .at{
        font-size: 10px;
    }
</style>';
$pagina.='<link rel="shortcut icon" href="../image/logo.png">';
    $pagina.="<body>";
    $pagina.='<h3 align="center">Distribuição Notas de:'.$nomed.$nomec.'</h3>';  
    
    $pagina.='<table class="table-responsive table"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">';
    $pagina.="<tr>";
    $pagina.='<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';
    
    $select="SELECT DISTINCT bimestre FROM `notas_bimestres` where id_disciplinas='$id' and ano_letivo='$ano' ";
        $con_select=mysqli_query($conexao, $select);
        $unidade=mysqli_num_rows($con_select);
        while($res_con=mysqli_fetch_assoc($con_select)){
            $arrayEmails[]= $res_con["bimestre"];

    $pagina.='<td bgcolor="#efefef" colspan="5" align="center"><strong>'.$res_con['bimestre'].' Unidade </strong></td>';}//finalizando lista de unidades na tablea
    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Total Geral</strong></td>';
    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Media Final</strong></td>';
    $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Res.Final</strong></td>';
    $pagina.="</tr>";
    if($unidade>0){
        $pagina.="<tr>"; 
    while($unidade>0){//listando os titulos da atividades
       
    $pagina.='<td bgcolor="#FFFFF1" class="at"><font color="#090000">Atividades</font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000">Trabalhos</font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000">Prova</font></td>
    <td bgcolor="#FFFFFF" class="at"><font color="#090000">Total</font></td>
    <td bgcolor="#FF643F" class="at"><font color="#090000">Situação</font></td>';
    
    
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
          $pagina.='<td bgcolor="#A9F5A9" class="at"><font color="#090000">AP</font></td>';}else{
            $pagina.='<td bgcolor="#F78181" class="at"><font color="#090000">RP</font></td>';
          }
          

}//finalizando lista de alunos
    $sqlTrans="select media from resultado_final where id_disciplinas='$id' and code=".$res['matricula'];
         $conTrans=mysqli_query($conexao,$sqlTrans);
         if(mysqli_num_rows($conTrans)==""){
            $pagina.='<td bgcolor="#FFFFFF" class="at"><font color="#090000">0</font></td>';
        }else{
         
            while($resTrans=mysqli_fetch_assoc($conTrans)){
            $media1=$resTrans['media'];
            $media=$media1/4;
            if($media1>=28){
                
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#01DF01">'.$resTrans['media'].'</font></td>';
            $pagina.='<td bgcolor="green" class="at"><font color="#090000">'.$media.'</font></td>';
            $pagina.='<td bgcolor="#FFAAA" class="at"><font color="#090000">AP</font></td>';
        }else{
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="center"><font color="#FF0000">'.$resTrans['media'].'</font></td>';
            $pagina.='<td bgcolor="#FFFFFF" class="at"><font color="#090000">'.number_format($media,2,",",".").'</font></td>';
            $pagina.='<td bgcolor="#FFAAA" class="at"><font color="#090000">RP</font></td>';
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