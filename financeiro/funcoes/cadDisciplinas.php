<?php
$pagina="";
require_once "../bd/funcoes.php";
  $select=new funcoes;
  $cate=$select->buscarCategoria();
  $professor=$select->buscaQtdeProf();

$funcao="Salvar";

if(isset($_POST['user_id'])){ 
    $query=$select->buscaIdDisc($_POST['user_id']);

    foreach($query as $key=>$value){
        $categoria=$value['id_categoria'];
        $nome=$value['disciplinas'];
        $id_disc=$value['disciplina'];
        $nomeprofessor=$value['professor'];
        $id_professor=$value['id_professores'];
        $curso=$value['curso'];
        $id_curso=$value['id_cursos'];
        $carga=$value['cargaHoraria_diaria'];
        $sala=$value['sala'];
    }
   $funcao="Atualizar";
}
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Categoria</label>
    <select class="form-control" id="categoria" name="" required>';
 if(@$_POST['user_id']){
    switch($categoria){case '1': $nomeCate='Fundamental Anos Iniciais'; break;case '2': $nomeCate='Fundamental Anos FInais'; break;case '3': $nomeCate='Ensino Médio'; break;case '4': $nomeCate='Ensino Médio';}
     $pagina.='<option value="'.$categoria.'">'.$nomeCate.'</option>';
 }else{
     $pagina.='
     <option value="">...</option>
    ';}
    
    foreach($cate as $key=>$value){
 $pagina.='<option value="'.$value['id_categoria'].'">'.$value['categoria'].'</option>';
    }
 $pagina.='
    </select>
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Nome da Disciplina</label>
    <select class="form-control" id="disciplinas" name="">';
        if(@$_POST['user_id']){
            $pagina.='<option value="'.@$id_disc.'">'.@$nome.'</option>';
        }
    $pagina.='
    </select>
</div>';
$pagina.='</div><br>';
// --------------
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Turma</label>
    <select class="form-control" id="turmas" name="">';
    if(@$_POST['user_id']){
        $pagina.='<option value="'.@$id_curso.'">'.@$curso.'</option>';
    }
    $pagina.='
    </select>
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Professor</label>
    <select class="form-control" id="categoria" name="" required>';
    if(@$_POST['user_id']){
        $pagina.='<option value="'.@$id_professor.'">'.@$nomeprofessor.'</option>';
    }
    $pagina.='
     <option value="">...</option>
    ';
    
    foreach($professor as $key=>$value){
 $pagina.='<option value="'.$value['id_professores'].'">'.$value['nome'].'</option>';
    }
 $pagina.='
    </select>
</div>';
$pagina.='</div><br>';

// ==============
$pagina.='
<div class="form-row">';
$pagina.='
<div class="col-sm-6">
    <label for="">Sala</label>
    <input type="text" class="form-control" id="sala" name="sala" placeholder="sala ex: 03" required value="'.@$sala.'">
</div>';
$pagina.='
<div class="col-sm-6">
    <label for="">Hora/aula</label>
    <input type="text" class="form-control" id="hora" name="hora" placeholder="hora aula " required value="'.@$carga.'">
</div>';
$pagina.='</div><br>';
// ===============

   $pagina.='
   <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       <button type="submit" name="'.$funcao.'" class="btn btn-primary">'.$funcao.'</button>
   </div>
   ';    



echo $pagina;

?>
  
