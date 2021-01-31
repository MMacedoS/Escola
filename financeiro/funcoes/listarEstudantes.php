<?php  
  require_once "../bd/funcoes.php";
  $select=new funcoes;
  $estudant=$select->buscaQtdeEst();
 $qtde=count($estudant);
$limite=30;

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $estudantes=$select->buscaEstudante($param);
        
    }else{
        $estudantes=$select->buscaEstudantes($param,$limite);
    }
}else{
   
    $param=1;
    $estudantes=$select->buscaEstudantes($param,$limite);
}
    $pagina="";

    $pagina.='<thead>
    <tr>
        <th scope="col">Cod</th>
        <th scope="col">Nome</th>
        <th scope="col">Cpf</th>
        <th scope="col">E-mail</th>
        <th colspan="2">Ações</th>
    </tr>
</thead>';
foreach($estudantes as $key=>$value){
$pagina.='
<tbody>
<tr>
    <th scope="row">'.$value['matricula'].'</th>
    <td>'.$value['nome'].'</td>
    <td>'.$value['cpf'].'</td>
    <td class="email">'.$value['email'].'</td>
    <td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_estudantes'].'" >Editar</button></td>';
    if($value['status']=="Ativo"){
        $pagina.='
        <td><button type="button" class="btn btn-outline-primary view_ativo" id="'.$value['id_estudantes'].'" >Ativo</button></td>';
    }else{
    $pagina.='
    <td><button type="button" class="btn btn-outline-danger view_ativo" id="'.$value['id_estudantes'].'" >Inativo</button></td>';
    }

$pagina.='
</tr>';
 }
 $pagina.='</tbody>';

 echo $pagina;

?>
  
     
      