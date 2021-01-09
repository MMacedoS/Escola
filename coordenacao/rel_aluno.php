<?php
    include('pdf/mpdf.php');
    $painel_atual = "Coordenacao"; 
    require_once "../config.php";
    $id=$_GET['id'];
    $ano=$_GET['ano'];
    $curso=$_GET['curso'];
    $nomed=$_GET['nomed'];
    $nomec=$_GET['nomec'];
    $rel=$_GET['pg'];
    
    switch ($rel) {
        case 'rp':
            $pagina.="<html>";
            $pagina.='<style>
            .table td, .table tr {
                font-size: 18px;
            }
            .at{
                font-size: 18px;
            }
        </style>';
        $pagina.='<link rel="shortcut icon" href="../image/logo.png">';
            $pagina.="<body>";
            $pagina.='<h2 align="center">Lista de Reprovados em '.$nomed.' Turma '.$nomec.'</h2>';    
            $pagina.='<table align="center" class="table-responsive table"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">';
            $pagina.="<tr>";
            $pagina.='<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Código</strong></td>';
            $pagina.='<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';
            
            //finalizando lista de unidades na tablea
            
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Total</strong></td>';
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Media</strong></td>';
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Situação</strong></td>';
            
            $pagina.="</tr>";
            
                
           //finalizando whilw lista atividades
            $pagina.="<tr>";
                    $sql="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and e.status='Ativo' and ce.ano_letivo='$ano' order by e.nome asc";
                    $con=mysqli_query($conexao,$sql);
                    while($res=mysqli_fetch_assoc($con)){///listando os alunoss
                        
                        $pagina.="<tr>";
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['matricula'].'</font></td>';
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['nome'].'</font></td>';
            $pagina.="</tr>"; 
                    $selet_1="SELECT * FROM resultado_final WHERE id_disciplinas='$id' and media<'28' and code=".$res['matricula'];
                    $con_1=mysqli_query($conexao,$selet_1);
                    while($res_1=mysqli_fetch_assoc($con_1)){
                        $media=number_format($res_1['media']/4, 1);
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$res_1['media'].'</font></td>';
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$media.'</font></td>';
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$res_1['situacao'].'</font></td>';
                    }
           
         
        
                    }//listando os alunos
                   
                   
        $pagina.="</tr>";
            $pagina.="</table>";
            $pagina.="<br>";
            // $pagina.='<p>TO=total</br>MF=media final/RF=Resultado Final/AT=>Atividades/P_I=>Proj_Inter/ P_T=>Proj_transversal/ AV=>Teste/ COC / AF=>Prova/ T=total unidade/S= situação<</p>';
            $pagina.="</body>";
            $pagina.='';
                
            $pagina.="</html>";
            break;
        case 'ap':
            $pagina.="<html>";
            $pagina.='<style>
            .table td, .table tr {
                font-size: 18px;
            }
            .at{
                font-size: 18px;
            }
        </style>';
        $pagina.='<link rel="shortcut icon" href="../image/logo.png">';
            $pagina.="<body>";
            $pagina.='<h2 align="center">Lista de Reprovados em '.$nomed.' Turma '.$nomec.'</h2>';    
            $pagina.='<table align="center" class="table-responsive table"  border="1" cellpadding="5" cellspacing="4" bgcolor="#FFF4EA">';
            $pagina.="<tr>";
            $pagina.='<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Código</strong></td>';
            $pagina.='<td rowspan="2" class="nome" bgcolor="#efefef"><strong>Alunos</strong></td>';
            
            //finalizando lista de unidades na tablea
            
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Total</strong></td>';
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Media</strong></td>';
            $pagina.='<td bgcolor="#efefef" rowspan="2"><strong>Situação</strong></td>';
            
            $pagina.="</tr>";
            
                
           //finalizando whilw lista atividades
            $pagina.="<tr>";
                    $sql="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and e.status='Ativo' and ce.ano_letivo='$ano' order by e.nome asc";
                    $con=mysqli_query($conexao,$sql);
                    while($res=mysqli_fetch_assoc($con)){///listando os alunoss
                        
                        $pagina.="<tr>";
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['matricula'].'</font></td>';
            $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'. $res['nome'].'</font></td>';
            $pagina.="</tr>"; 
                    $selet_1="SELECT * FROM resultado_final WHERE id_disciplinas='$id' and media<'28' and code=".$res['matricula'];
                    $con_1=mysqli_query($conexao,$selet_1);
                    while($res_1=mysqli_fetch_assoc($con_1)){
                        $media=number_format($res_1['media']/4, 1);
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$res_1['media'].'</font></td>';
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$media.'</font></td>';
                        $pagina.='<td bgcolor="#FFFFFF" class="at" align="left"><font color="#090000">'.$res_1['situacao'].'</font></td>';
                    }
           
         
        
                    }//listando os alunos
                   
                   
        $pagina.="</tr>";
            $pagina.="</table>";
            $pagina.="<br>";
            // $pagina.='<p>TO=total</br>MF=media final/RF=Resultado Final/AT=>Atividades/P_I=>Proj_Inter/ P_T=>Proj_transversal/ AV=>Teste/ COC / AF=>Prova/ T=total unidade/S= situação<</p>';
            $pagina.="</body>";
            $pagina.='';
                
            $pagina.="</html>";
            break;
        default:
            # code...
            $pagina+="<h1>Nenhum arquivo encontrado</h1>";
            break;
    }
    
                
    $arquivo="Cadastro01.pdf";
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