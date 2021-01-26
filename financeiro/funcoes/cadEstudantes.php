<?php
$pagina="";
require_once "../bd/funcoes.php";
  $select=new funcoes;
  $cod=$select->buscaCodEstudante();
  $qdados=count($cod);

if($qdados==0){
    $new_code = "587418";
}else{     
    $new_code = $cod[0]['matricula']+741+$cod[0]['id_estudantes'];
    }

$funcao="Salvar";

if(isset($_POST['user_id'])){ 
    $query=$select->buscaIdEstudante($_POST['user_id']);

    foreach($query as $key=>$value){
        $nome=$value['nome'];
        $cpf=$value['cpf'];
        $new_code=$value['matricula'];
        $nascimento=$value['nascimento'];
        $endereco=$value['endereco'];
        $tel=$value['celular'];
        $email=$value['email'];
        $vencimento=$value['vencimento'];
        $mensalidade=$value['mensalidade'];
    }
   $funcao="Atualizar";
}
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Matrícula</label>
    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo" required  disabled value="'.$new_code.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Nome do Estudante</label>
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do estudante" required value="'.@$nome.'">
</div>';
$pagina.='</div><br>';
// --------------
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">CPF</label>
    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required value="'.@$cpf.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Data de Nascimento</label>
    <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="nascimento" required value="'.@$nascimento.'">
</div>';
$pagina.='</div><br>';

// ==============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Telefone</label>
    <input type="email" class="form-control" id="telefone" name="telefone" placeholder="telefone" required value="'.@$tel.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Endereço</label>
    <input type="salario" class="form-control" id="endereco" name="endereco" placeholder="endereço" required value="'.@$endereco.'">
</div>';
$pagina.='</div><br>';
// ===============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Mensalidade</label>
    <input type="email" class="form-control" id="mensalidade" name="mensalidade" placeholder="mensalidade" required value="'.@$mensalidade.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Salário</label>
    <input type="salario" class="form-control" id="vencimento" name="vencimento" placeholder="vencimento" required value="'.@$vencimento.'">
</div>';
$pagina.='</div><br>';
// ===============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-12">
<label for="">E-mail</label>
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
  
