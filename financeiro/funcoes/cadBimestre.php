<?php
$pagina="";

require_once "../bd/funcoes.php";
  $select=new funcoes;
  $bimestre=$select->buscarBimestre();
  $bimestre=count($bimestre)+1;

$funcao="Cadastrar";
$pagina.='
<div class="form-row">
<div class="col-sm-12">
    <input type="number" class="form-control" id="nome" name="nome" placeholder="Bimestre" required value="'.@$bimestre.'">
</div>';

$pagina.='
</div>
</div>
   <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       <button type="submit" name="'.$funcao.'" class="btn btn-primary">'.$funcao.'</button>
   </div>
   ';    



echo $pagina;

?>
  
