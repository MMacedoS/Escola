<?php  

require_once "../bd/funcoes.php";
  $select=new funcoes; 

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $turmas=$select->buscaTurma($param);    
    }else{
        $turmas=$select->buscaCatTurma($param);    
    }
}else{
    $param=1;
    $turmas=$select->buscaCatTurma($param);    
}
    $pagina="";
    
    $qTurmas=count($turmas);

    $pagina.='<thead>
    <tr>
        <th scope="col">Cod</th>
        <th scope="col">Turma</th>
        <th scope="col">Turno</th>
        <th scope="col">Categoria/Ano</th>
        <th colspan="">Ações</th>
    </tr>
</thead>';
foreach($turmas as $key=>$value){
$pagina.='
<tbody>
<tr>
    <th scope="row">'.$value['id_cursos'].'</th>
    <td>'.$value['curso'].'</td>
    <td>'.$value['turno'].'</td>
    <td>'.$value['id_categoria']."/".$value['ordem']." Ano".'</td>
    <td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_cursos'].'" >Editar</button></td>
</tr>';
 }
 $pagina.='</tbody>';

 echo $pagina;


  ?>
  
     
      