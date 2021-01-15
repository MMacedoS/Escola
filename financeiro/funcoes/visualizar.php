<?php
$pagina="";
require_once "../../Control/conexao.php";


$select=$pdo->query("SELECT * FROM categoria order by id_categoria asc");
$categoria=$select->fetchAll(PDO::FETCH_ASSOC);
$funcao="Salvar";

if(isset($_POST['user_id'])){    
    $query=$pdo->query("SELECT * FROM cursos WHERE id_cursos='".$_POST['user_id']."' limit 1");
    $query=$query->fetchAll(PDO::FETCH_ASSOC);

    foreach($query as $key=>$value){
        $nome=$value['curso'];
        $turno=$value['turno'];
        $ano=$value['ordem'];
        $cat=$value['id_categoria'];

    }
   $funcao="Atualizar";
}
$pagina.='
<div class="form-row">
<div class="col-sm-6">
    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da turma" required value="'.@$nome.'">
</div>';
$pagina.='
<div class="col-sm-6">
   <select name="turno" id="turno" class="form-control">';
    if(@$_POST['user_id']){
        $pagina.=' <option value="'.@$turno.'">'.@$turno.'</option>';
    }
   $pagina.='
     <option value="matutino">Matutino</option>
     <option value="vespertino">Vespertino</option>
     <option value="noturno">Noturno</option>
   </select>
</div>
</div>
<br>';
$pagina.='
<div class="form-row">
<div class="col-sm-6">
 <select name="ano" id="ano" class="form-control">';

 if(@$_POST['user_id']){
     $pagina.=' <option value="'.@$ano.'">'.@$ano.' Ano</option>';
 }
$pagina.='
     <option value="1">1º Anos Iniciais</option>
     <option value="2">2º Anos Iniciais </option>
     <option value="3">3º Anos Iniciais</option>
     <option value="4">4º Anos Iniciais</option>
     <option value="5">5º Anos Iniciais</option>
     <option value="6">6º Anos Finais</option>
     <option value="7">7º Anos Finais</option>
     <option value="8">8º Anos Finais</option>
     <option value="9">9º Anos Finais</option>
     <option value="10">1º Série Ensino Médio</option>
     <option value="11">2º Série Ensino Médio</option>
     <option value="12">3º Série Ensino Médio</option>                                
   </select>
</div>
';

$pagina.='
<div class="col-sm-6">
<select name="categoria" id="categoria" class="form-control">';

 if(@$_POST['user_id']){
     $pagina.=' <option value="'.@$cat.'">';
     switch($cat){
        case '1':
         $pagina.="Fundamental Anos Iniciais";
        break;
        case '2':
            $pagina.="Fundamental Anos Finais";
           break;
           case '3':
            $pagina.="Ensino Médio";
           break;
           case '4':
            $pagina.="Ensino Médio";
           break;
     }
     $pagina.="</option>";
 }
  foreach($categoria as $key=>$value){
    $pagina.='<option value="'.$value['id_categoria'].'">'.$value['categoria'].'</option>';
 }
   $pagina.='</select></div></div><br>
   </div>
   <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
       <button type="submit" name="'.$funcao.'" class="btn btn-primary">'.$funcao.'</button>
   </div>
   ';    



echo $pagina;

?>
  
