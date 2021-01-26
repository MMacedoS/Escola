<?php

require_once "../bd/funcoes.php";
  $select=new funcoes;

  $param=@$_POST['categoria'];
 $select=$select->buscaNomesDis($param);

 foreach($select as $key=>$value){
    echo '<option value="">'.$value['nome'].'</option>';
 }

  ?>

