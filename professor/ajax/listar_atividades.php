<?php
require_once  '../../Control/conexao.php';
    $selec=@$_GET['botao'];
    $id=@$_GET['id'];
    $disciplina=@$_GET['disciplina'];
    $pagina='';
    $numero=0;
    
    $sql_1=$pdo->query("SELECT * FROM atividades_bimestrais WHERE id_ativ_bim = '$id'");
    $sql_1=$sql_1->fetchAll(PDO::FETCH_ASSOC);
    // $sql_1 = "SELECT * FROM atividades_bimestrais WHERE id_ativ_bim = '$id'";
    // $result = mysqli_query($conexao, $sql_1);
    foreach ($sql_1 as $key => $res_1) {
      # code...
    
      // while($res_1 = mysqli_fetch_assoc($result)){
        $curso = $res_1['id_curso'];
        $professor = $res_1['professor'];
        $bimestre = $res_1['bimestre'];
        $ano=Date("Y");
    $sql_2=$pdo->query("SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' and e.status='Ativo' order by e.nome asc");  
    $sql_2=$sql_2->fetchAll(PDO::FETCH_ASSOC);

    // $sql_2 = "SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes WHERE ce.id_cursos = '$curso' and ce.ano_letivo='$ano' and e.status='Ativo' order by e.nome asc";
    
    // $result_2 = mysqli_query($conexao, $sql_2);
    $countDados=count($sql_2);

    if($countDados ==0){
      $pagina.='<h2><font color="blue">não possui alunos cadastrados nesta turma</font></h2>';
    }else{
        foreach ($sql_2 as $key => $res_2) {
          # code...
          $numero++;
        // while($res_2 = mysqli_fetch_assoc($result_2)){
     
  $pagina.='
    <form name="" method="get" action="" enctype="multipart/form-data">
    <input type="hidden" name="bimestre" id="bimestre" value="'.$res_1['bimestre'].'"/>
    <input type="hidden" name="disciplina" id="disciplina" value="'. $res_1['id_disciplina'].'" />
    <input type="hidden" name="code_aluno" id="code_aluno_'.$numero.'"  value="'.$res_2['matricula'].'" />
    <input type="hidden" name="id" id="id" value="'.$id.'" />
    <input type="hidden" name="selec" id="selec" value="'. $selec.'" />
    <table id="customers" border="0">
      <tr>
        
        <th>Aluno:</th>
        <th>Bimestre:</th>
        <th>1ªAT:</th>
        <th>2ªAT:</th> 
        ';
        
        if($selec==1){
         $pagina.="<th>3ªAT:</th>";
      }else{
        $pagina.='
        <th>3ªAT:</th>
        <th>4ªAT:</th>';
       }
       $pagina.='<th>Média</th></tr><tr>';
        
      $pagina.='<td><h3>'.$res_2['nome'].'</h3></td>';
      $pagina.='<td><h3>'.$bimestre = $res_1['bimestre'].'º</h3></td>';
    
      $code_aluno = $res_2['matricula']; 
      $sql_4 =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina'");
      
      $sql_4=$sql_4->fetchAll(PDO::FETCH_ASSOC);
      $total1=count($sql_4);  

      if($total1==0){
      
        $pagina.='<td><input name="nota" type="text" id="nota" size="3" value="" disabled ></td>';
        }else{ 
    foreach($sql_4 as $value){ 
      $pagina.='<td>'. $value['nota'].'';
      $pagina.='<input type="hidden" name="bimestre" id="id_ati_'.$numero.'" value="'.$value['id_notas_atividades'].'"/>';
      $pagina.='<a id="ati_'.$numero.'" href="correcao_atividades.php?pg=atividade_bimestral&id='. $id .'&selec='.$selec.'&idNota='. $value['id_notas_atividades'].'&deleta=ati"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>';
      }
    } 

    // <!-- trabalhos -->
    
    $sql_5 =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina'");
    
      $sql_5=$sql_5->fetchAll(PDO::FETCH_ASSOC);
      $total2=count($sql_5);  

      if($total2==0){      
        $pagina.='<td><input name="nota2" type="text" id="nota2" size="3" value="" disabled ></td>';
        }else{ 
    foreach($sql_5 as $trab){
      $pagina.='<td>'. $trab['nota'].'';
      $pagina.='<input type="hidden"  id="id_trab_'.$numero.'" value="'.$trab['id_notas_ava_coc'].'"/>';
      $pagina.='<a id="trab_'.$numero.'" href="correcao_atividades.php?pg=atividade_bimestral&id='.$id .'&selec='. $selec .'&idNota='.$trab['id_notas_ava_coc'].'&deleta=trab"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>';
       }
    } 
    // <!-- notas teste -->
    $sql_4 =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina'");
      // var_dump($sql_4);
      $sql_4=$sql_4->fetchAll(PDO::FETCH_ASSOC);
      $total3=count($sql_4);  

      if($selec!=1){
        if($total3==0){
       
          $pagina.='<td><input name="nota3" type="text" id="nota3" size="3" value="" disabled ></td>';
      }else{ 
      foreach($sql_4 as $value){ 
       $pagina.=' <td>'.$value['nota'].'';
       $pagina.='<input type="hidden" id="id_teste_'.$numero.'" value="'.$value['id_notas_ava_teste'].'"/>';
       $pagina.='<a id="teste_'.$numero.'" href="correcao_atividades.php?pg=atividade_bimestral&id='.$id.'&selec='.$selec.'&idNota='.$value['id_notas_ava_teste'].'&deleta=teste"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>';
        }
      }

} 
    // <!-- notas provas -->
    
    $sql_4 =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina'");
      // var_dump($sql_4);
      $sql_4=$sql_4->fetchAll(PDO::FETCH_ASSOC);
      $total4=count($sql_4);  

      if($total4==0){
     
        $pagina.='<td><input name="nota4" type="text" id="nota4" size="3" value="" disabled ></td>';
     }else{ 
    foreach($sql_4 as $value){ 
      $pagina.='<td>'.$value['nota'].'';
      $pagina.='<input type="hidden"  id="id_prova_'.$numero.'" value="'.$value['id_notas_ava_prova'].'"/>';
      $pagina.='<a id="prova_'.$numero.'" href="correcao_atividades.php?pg=atividade_bimestral&id='.$id.'&selec='.$selec.'&idNota='.$value['id_notas_ava_prova'].'&deleta=prova"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>';
       }
    } 
    $pagina.='<td>';
     $media=$pdo->query("select nota from notas_bimestres where code='$code_aluno' and id_disciplinas='$disciplina' and bimestre='$bimestre'");
                        $media=$media->fetchAll(PDO::FETCH_ASSOC);
                        $pagina.=''.@$media[0]['nota'].'</td>';
                        $pagina.='</tr>';
        if(@$total1==0 || @$total2==0 || @$total3==0 || @$total4==0){

        $pagina.='<tr>';
        $pagina.='<td> <button id="button_'.$numero.'" type="submit"  class="btn btn-primary pull-right" >Inserir</button></td>';
        
        $pagina.='</tr>';
         } 
      
         $pagina.='</table>';
         $pagina.='</form>';

     }///
  }//else 
  
  } 

  echo $pagina;
    // var_dump($acao);

            // echo "<p>Selecione uma categoria para fazer a busca!!</p>";
      
?>
<script>
    var num_dados=<?=$countDados?>;
  for(let i=1;i<=num_dados;i++){
    $('#button_'+i).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var bimestre=$('#bimestre').val();
        var disciplina=$('#disciplina').val();
        var code_aluno=$('#code_aluno_'+i).val();
        var id=$('#id').val();
        var selec=$('#selec').val();
        var nota=$('#nota').val();
        var nota2=$('#nota2').val();
        var nota3=$('#nota3').val();
        var nota4=$('#nota4').val();
        // window.alert(code_aluno);
        $.ajax({
            url:"ajax/inserir_atividades.php",
            method: 'GET',
            data: {bimestre:bimestre,disciplina:disciplina,code_aluno:code_aluno,id:id,selec:selec,nota:nota,nota2:nota2,nota3:nota3,nota4:nota4},
            datatype:'json',
            success:function(result){
               $('#carrega').click();
               $('#mensagem').html(result);
            },
              })
    })
}
</script>

<!-- deleta -->

<script>
    var num_dados=<?=$countDados?>;
  for(let ati=1;ati<=num_dados;ati++){
    $('#ati_'+ati).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var atividade=$('#id_ati_'+ati).val();
        
     
        // window.alert(atividade);
        $.ajax({
            url:"ajax/deleta_atividades.php",
            method: 'GET',
            data: {atividade:atividade},
            datatype:'json',
            success:function(result){
               $('#carrega').click();
            },
              })
    })
}
</script>

<script>
    var num_dados=<?=$countDados?>;
  for(let ati=1;ati<=num_dados;ati++){
    $('#trab_'+ati).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var atividade=$('#id_trab_'+ati).val();
        
     
        // window.alert(atividade);
        $.ajax({
            url:"ajax/deleta_atividades.php",
            method: 'GET',
            data: {trabalho:atividade},
            datatype:'json',
            success:function(result){
               $('#carrega').click();
            },
              })
    })
}
</script>

<script>
    var num_dados=<?=$countDados?>;
  for(let ati=1;ati<=num_dados;ati++){
    $('#teste_'+ati).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var atividade=$('#id_teste_'+ati).val();
        
     
        // window.alert(atividade);
        $.ajax({
            url:"ajax/deleta_atividades.php",
            method: 'GET',
            data: {teste:atividade},
            datatype:'json',
            success:function(result){
               $('#carrega').click();
            },
              })
    })
}
</script>

<script>
    var num_dados=<?=$countDados?>;
  for(let ati=1;ati<=num_dados;ati++){
    $('#prova_'+ati).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var atividade=$('#id_prova_'+ati).val();
        
     
        // window.alert(atividade);
        $.ajax({
            url:"ajax/deleta_atividades.php",
            method: 'GET',
            data: {prova:atividade},
            datatype:'json',
            success:function(result){
               $('#carrega').click();
            },
              })
    })
}
</script>
<!-- fim deleta -->



<script>
       (function( $ ) {
            $(function() {
              //$("#date").mask("99/99/9999");
              //$("#phone").mask("(99) 999-9999");
              //$("#cep").mask("99.999-99");
              //$("#cpf").mask("99.999.999-99");
              
             
              $("#nota4").mask("9.9");
              
              $("#nota4").css('background', 'write');
              $('#nota4').attr("disabled", false);
              $('#nota4').focus();

            
              $("#nota3").mask("9.9");
              
              $("#nota3").css('background', 'write');
              $('#nota3').attr("disabled", false);
              $('#nota3').focus();

              $("#nota2").mask("9.9");
              
              $("#nota2").css('background', 'write');
              $('#nota2').attr("disabled", false);
              $('#nota2').focus();

              $("#nota").mask("9.9");
              
              $("#nota").css('background', 'write');
              $('#nota').attr("disabled", false);
              $('#nota').focus();

              
            //   $('#button_'+i).attr("disabled", false);

            // }
            });
          })(jQuery);
        </script>


