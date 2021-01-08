
<?php 
require_once '../../Control/conexao.php';

if(@$_POST['situacao']){}
// listagem de alunos do conselho
$curso=@$_GET['turma'];
$num=0; 

    $sql_1=$pdo->prepare("SELECT IF(n.media>=27.6 and n.media<=27.9,'28.00',n.media) as media,l.nome as disciplina,e.nome,n.id_resultado,n.situacao  from resultado_final n 
    INNER JOIN estudantes e on e.matricula=n.code INNER JOIN disciplinas d ON d.id_disciplinas=n.id_disciplinas 
    INNER JOIN lista_disc l ON d.disciplina=l.id_lista INNER JOIN cursos c on c.id_cursos=d.id_cursos
    WHERE c.id_cursos=:turma and n.media<27.6 
    and n.ano_letivo=:ano  ORDER by e.nome asc;");
    $sql_1->bindValue(':turma',$curso);
    $sql_1->bindValue(':ano','2020');
    $sql_1->execute();
    $dados=$sql_1->fetchAll();
    $resultado=count($dados);
        if($resultado==0 ){
                    echo "<h2><font color='#fff' size='2px'>Não existe nenhum aluno cadastrado nesta disciplina!</font></h2>";
                    }
        else if($resultado>=1){
                    foreach ($dados as $res_1) {
                    $code_aluno = $res_1['id_resultado'];
                    $num=$num+1;
?>

   <form name="button" method="POST" enctype="multipart/form-data" action="">
                        <input type="hidden" name="" id="selec" value="<?=$_GET['selec']?>">
                        <input type="hidden" name="" id="curso" value="<?=base64_encode($_GET['turma'])?>">
       <table id="customers" border="0">
           <tr>
               <th width="50"><strong>IDs: </strong></th>
               <th width="50"><strong>Disciplina:</strong></th>
               <th width="350"><strong>Nome:</strong></th>
               <th colspan="4"><strong>Aprovado(a)? <?php //echo $num;?></strong></th>
               
           </tr>
          
           <tr>
               <td>
                   <?php echo $res_1['id_resultado']; ?><input type="hidden" name="code_aluno"
                       value="<?php echo $res_1['id_resultado']; ?>" id="id<?=$num?>" /></td>
                    <td><?=$res_1['disciplina']?></td>
               <td>
                   <input type="hidden" name="selec" value="<?=@$_GET['selec']?>">
                   <?php echo $res_1['nome']; ?><input type="hidden" name="nome" id="nome<?=$num?>"
                       value="<?php echo $res_1['nome']; ?>" /></td>
             
               

               <td colspan="4"> 
               <?php if($res_1['situacao']=='aprovado em conselho'){
                   echo '<div class="switch">

                         <input type="checkbox" id="check'.$num.'" name="checkbox[]" id="option" value="true"
                            checked>
                         <label for="option"><span></span></label>
                      </div>
                    ';
               }else{
                  echo ' <div class="switch">

                    <input type="checkbox" id="check'.$num.'" name="checkbox[]" id="option" value="false"
                      >
                    <label for="option"><span></span></label>
                    </div>';
              
               }?>
               

           </tr>
       </table>


       <?php }//fim foreach
        }//fim if resultado 
?>

<script>
var numero="<?=$num?>";
// console.log(numero);
var selec=$('#selec').val();  
var u_curso=$('#curso').val();  
for (let index = 1; index <= numero; index++) {     

$("#check"+index).click(function(){
var valor=$('#check'+index).val();
var n=(this).value;
if(n=="true"){
   $(".opcao").css("display","block");
   $(this).val("false");   
   var id=$('#id'+index).val();  
   $.ajax({
            url: 'ajax/atualiza_conselho.php',
            method:'get',
            data:{id:id,situacao:'reprovado'},
            datatype:'json',
            success:function(response){
                // console.log(response,n);
            window.location.assign("finalizar_conselho.php?selec="+selec+"&curso="+u_curso);
        },
   });
  
}
   else{
       $(".opcao").css("display","block");
           $(this).val("true");
           var id=$('#id'+index).val();
           $.ajax({
            url: 'ajax/atualiza_conselho.php',
            method:'get',
            data:{id:id,situacao:'aprovado'},
            datatype:'json',
            success:function(response){
                // console.log(response,n);
            window.location.assign("finalizar_conselho.php?selec="+selec+"&curso="+u_curso);
        },
   });
          
           
   }
   

});
}

</script>