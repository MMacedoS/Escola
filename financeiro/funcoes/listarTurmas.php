<?php  
 require_once "../../Control/conexao.php"; 

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $select=$pdo->query("SELECT * FROM cursos where curso like '%$param%'  order by ordem asc");        
    }else{
        $select=$pdo->query("SELECT * FROM cursos where id_categoria='$param'  order by ordem asc");  
    }
}else{
    $param=1;
    $select=$pdo->query("SELECT * FROM cursos where id_categoria='$param'  order by ordem asc");
}
    $pagina="";
    
    $turmas=$select->fetchAll(PDO::FETCH_ASSOC);
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
  
     
      