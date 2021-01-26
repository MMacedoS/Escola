<?php
$pagina="";

require_once "../bd/funcoes.php";
  $select=new funcoes;
  $bimestre=$select->buscarBimestre();

$funcao="Criar atividades";
$pagina.='<p>Cadastro de Atividades</p>
<div class="form-row">
<div class="col-sm-12">
    <select class="form-control" id="ativ">';
     foreach($bimestre as $key =>$value){
       $pagina.='<option value="'.$value['unidade'].'">'.$value['unidade'].' Bimestre</option>';
     }

$pagina.='
    </select>
</div>';

$pagina.='
</div>
</div>
   <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       <button type="button" id="cadAtividade" name="'.$funcao.'" class="btn btn-primary">'.$funcao.'</button>
   </div>
   ';    



echo $pagina;

?>
  
<script>
 $('#cadAtividade').click(function(event){
    event.preventDefault();
    // $.post('./funcoes/cadAtividade.php',function(retorna){
    //     $('#bimestre').html(retorna);
    //     // console.log(retorna);
    //     $('#editaBimestre').modal('show');
    //   });
    var user_id=$('#ativ').val();
      if(user_id!==''){
        var dados={
        user_id:user_id
      };

    $.post('./cadastros/bimestres.php',dados);
      }
  });
</script>