<?php  

require_once "../bd/funcoes.php";
  $select=new funcoes; 

 
if(isset($_POST['page']) || isset($_POST['texto'])){
    $param=@$_POST['page'];
    if(@$_POST['texto']){
        $param=@$_POST['texto'];
        $bimestre=$select->buscarAtiBimestre($param);    
    }else{
        $bimestre=$select->buscarAtiBimestre($param);    
    }
}else{
    $param=1;
    $bimestre=$select->buscarAtiBimestre($param);    
}
    $pagina="";
    
   

    $pagina.='<thead>
    <tr>
   
        <th scope="col">Bimestre</th>
              
    </tr>
</thead>';
foreach($bimestre as $key=>$value){
$pagina.='
<tbody>
<tr>
    <td>'.$value['dados'].' Atividades geradas no '.$param.'º bimestre</td>    
    
</tr>';
 }
 $pagina.='</tbody>';

 echo $pagina;


  ?>
  
     
      