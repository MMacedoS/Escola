<?php  
 require_once "../../Control/conexao.php"; 
$limite=10;

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $select=$pdo->query("SELECT * FROM professores where nome like '%$param%'  order by nome asc");        
    }else{
        $select=$pdo->query("SELECT * FROM professores limit $param,$limite");
    }
}else{
    $param=1;
    $select=$pdo->query("SELECT * FROM professores limit $param,$limite");
}
    $pagina="";
    
    $professor=$select->fetchAll(PDO::FETCH_ASSOC);
    $qTurmas=count($professor);

    $pagina.='<thead>
    <tr>
        <th scope="col">Cod</th>
        <th scope="col">Nome</th>
        <th scope="col">Cpf</th>
        <th scope="col">E-mail</th>
        <th colspan="2">Ações</th>
    </tr>
</thead>';
foreach($professor as $key=>$value){
$pagina.='
<tbody>
<tr>
    <th scope="row">'.$value['id_professores'].'</th>
    <td>'.$value['nome'].'</td>
    <td>'.$value['cpf'].'</td>
    <td class="email">'.$value['email'].'</td>
    <td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_professores'].'" >Editar</button></td>
    <td><button type="button" class="btn btn-outline-primary view_data" id="'.$value['id_professores'].'" >Ativo</button></td>
</tr>';
 }
 $pagina.='</tbody>';

 echo $pagina;


  ?>
  
     
      