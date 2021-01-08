<?php
require_once  '../../Control/conexao.php';
    $pagina='';
    $numero=0;
    
    $sql_2=$pdo->query("SELECT r.media,r.id_resultado as id,r.id_disciplinas,e.nome as aluno,r.code as matricula,l.nome as disciplina,c.curso,r.situacao,r.recuperacao from resultado_final r inner join estudantes e on e.matricula=r.code  inner join disciplinas d on d.id_disciplinas=r.id_disciplinas inner join lista_disc l on l.id_lista=d.disciplina inner join cursos c on c.id_cursos=d.id_cursos where c.id_categoria=".$_GET['professor']." and r.media<'27.6' order by c.ordem asc");  
    $sql_2=$sql_2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sql_2 as $key => $res_2) {
          # code...
          $numero++;

     
  $pagina.='
    <form name="" method="get" action="" enctype="multipart/form-data">
    
    
    <table id="customers" border="0">
      <tr>
        
        <th>Aluno:</th>
        <th>discicplina:</th>
        <th>Turma</th>
        <th>Nota</th> 
        ';
        $pagina.='
        <th>Sistuação</th>
        <th>Recuperação:</th>';
       
       $pagina.='</tr> <tr>';
        
      $pagina.='<td><h3>'.$res_2['aluno'].'</h3></td>';
      $pagina.='<td><h3>'.$res_2['disciplina'].'</h3></td>';
      $pagina.='<td><h3>'.$res_2['curso'].'</h3></td>';
      $pagina.='<td><h3>'.$res_2['media'].'</h3></td>';
      $pagina.='<td><h3>'.$res_2['situacao'].'</h3></td>';
      $pagina.='<input type="hidden" name="" id="id'.$numero.'" value="'.$res_2['id'].'">';
      $code_aluno = $res_2['matricula']; 
      $disciplina=$res_2['id_disciplinas'];
      $sql_4 =$pdo->query("SELECT recuperacao as nota,id_resultado as id FROM resultado_final WHERE code = '$code_aluno' and id_disciplinas='$disciplina' and recuperacao!=''");
      $sql_4=$sql_4->fetchAll(PDO::FETCH_ASSOC);
      $total1=count($sql_4);  

      if($total1==0){
       
        $pagina.='<td><input class="nota" name="nota" type="text" id="nota'.$numero.'" size="3" value="" placeholder="01.0"></td>';
        }else{ 
    foreach($sql_4 as $value){ 
      $pagina.='<td>'. $value['nota'].'';
      $pagina.='<input type="hidden" name="bimestre" id="id_ati_'.$numero.'" value="'.$value['id'].'"/>';
      $pagina.='<a id="ati_'.$numero.'" href="correcao_atividades.php?pg=atividade_bimestral&id='.@$id .'&selec='.@$selec.'&idNota='. $value['id'].'&deleta=ati"><img src="../image/deleta.png" width="30" border="0" title="deleta nota" /></a></td>';
      }
    } 

    
   $pagina.='</tr>';
        if(@$total1==0){

        $pagina.='<tr>';
        $pagina.='<td> <button id="button_'.$numero.'" type="submit"  class="btn btn-primary pull-right" >Inserir</button></td>';
        
        $pagina.='</tr>';
         } 
      
         $pagina.='</table>';
         $pagina.='</form>';

     }///
 

  echo $pagina;
    // var_dump($acao);

            // echo "<p>Selecione uma categoria para fazer a busca!!</p>";
      
?>
<script>


     function atualiza(){
      window.location.reload(true);
     }

    var num_dados=<?=$numero?>;
  for(let i=1;i<=num_dados;i++){
    $('#button_'+i).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var id=$('#id'+i).val();
        var nota=$('#nota'+i).val();
        if(nota<=10){
        $.ajax({
            url:"ajax/recuperacao.php",
            method: 'GET',
            data: {id:id,nota:nota},
            datatype:'json',
            success:function(result){
              window.location.reload(true);          
              },
              });
        }else{
          window.alert('nota acima de 10.0');
        }
    })
}
</script>

<!-- deleta -->

<script>
    var num_dados=<?=$numero?>;
  for(let ati=1;ati<=num_dados;ati++){
    $('#ati_'+ati).click(function(event){
        event.preventDefault();
        // window.alert('funcionou');
        var id=$('#id_ati_'+ati).val();       
        $.ajax({
            url:"ajax/recuperacao.php",
            method: 'GET',
            data: {id:id,nota:''},
            datatype:'json',
            success:function(result){
              window.location.reload(true); 
            },
              });
    })
}
</script>



<!-- fim deleta -->



<script>
       (function( $ ) {
            $(function() {
              var num_dados=<?=$numero?>;
              for(let a=1;a<=num_dados;a++){
              $("#nota"+a).mask("99.9");
              
              $("#nota"+a).css('background', 'write');
              $('#nota'+a).attr("disabled", false);
              // $('#nota'+a).focus();
              }
              
            //   $('#button_'+i).attr("disabled", false);

            // }
            });
          })(jQuery);
        </script>


