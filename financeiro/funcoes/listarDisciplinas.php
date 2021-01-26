<?php  
  require_once "../bd/funcoes.php";
  $select=new funcoes;
$limite=25;

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $disciplinas=$select->buscaEstudante($param);
        
    }else{
        $disciplinas=$select->buscaDisciplina($param,$limite);
    }
}else{
   
    $param=1;
    $disciplinas=$select->buscaDisciplina($param,$limite);
}
    $pagina="";

    $pagina.='<thead>
    <tr>
        <th scope="col">Cod</th>
        <th scope="col">Disciplinas</th>
        <th scope="col">Turma</th>
        <th scope="col">Professor</th>
        <th colspan="2">Ações</th>
    </tr>
</thead>';
foreach($disciplinas as $key=>$value){
$pagina.='
<tbody>
<tr>
    <th scope="row">'.$value['id_disciplinas'].'</th>
    <td>'.$value['disciplinas'].'</td>
    <td>'.$value['curso'].'</td>
    <td class="email">'.$value['professor'].'</td>
    <td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_disciplinas'].'" >Editar</button></td>
    <!--<td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_disciplinas'].'" >Ativo</button></td>-->
</tr>';
 }
 $pagina.='</tbody>';

 echo $pagina;


  ?>
  
     
      