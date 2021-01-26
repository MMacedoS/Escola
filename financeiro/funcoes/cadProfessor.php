<?php
$pagina="";
require_once "../bd/funcoes.php";
  $select=new funcoes;
  

$sql_4=$select->buscaCodProfessores();
$qdados=count($sql_4);

if($qdados== 0){
    $new_code = "87415978";
}else{     
      $new_code = $sql_4[0]['code']+$sql_4[0]['id_professores']+741;
    }

$funcao="Salvar";

if(isset($_POST['user_id'])){    
    
    $query=$select->buscaIdProfessores($_POST['user_id']);

    foreach($query as $key=>$value){
        $nome=$value['nome'];
        $cpf=$value['cpf'];
        $new_code=$value['code'];
        $nascimento=$value['nascimento'];
        $graduacao=$value['graduacao'];
        $salario=$value['salario'];
        $email=$value['email'];
    }
   $funcao="Atualizar";
}
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Nome do Professor" required  disabled value="'.$new_code.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required value="'.@$nome.'">
</div>';
$pagina.='</div><br>';
// --------------
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="cpf" required value="'.@$cpf.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="nascimento" required value="'.@$nascimento.'">
</div>';
$pagina.='</div><br>';

// ==============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <input type="email" class="form-control" id="graduacao" name="graduacao" placeholder="graduacao" required value="'.@$graduacao.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <input type="salario" class="form-control" id="salario" name="salario" placeholder="salario" required value="'.@$salario.'">
</div>';
$pagina.='</div><br>';
// ===============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-12">
    <input type="email" class="form-control" id="email" name="email" placeholder="email" required value="'.@$email.'">
</div>';
$pagina.='</div><br>';
// ==============

   $pagina.='
   <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       <button type="submit" name="'.$funcao.'" class="btn btn-primary">'.$funcao.'</button>
   </div>
   ';    



echo $pagina;

?>
  
