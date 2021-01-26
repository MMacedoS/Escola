<?php

require_once "../bd/funcoes.php";
  $select=new funcoes;

  $param=@$_POST['categoria'];
 $select=$select->buscaCatTurma($param);

 foreach($select as $key=>$value){
    echo '<option value="'.$value['id_cursos'].'">'.$value['curso'].'</option>';
 }

  ?>

