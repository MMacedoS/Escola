<?php
require_once '../../Control/conexao.php';
// if para atualizarsituação  no banco 

    $id_resultado=@$_GET['id'];
    if($_GET['situacao']=='aprovado'){
    
    $atualiza=$pdo->query("UPDATE resultado_final set situacao='aprovado em conselho' where id_resultado='$id_resultado'");    
        // var_dump($atualiza);

    }if($_GET['situacao']=='reprovado'){
        $atualiza=$pdo->query("UPDATE resultado_final set situacao='reprovado' where id_resultado='$id_resultado'");   
        // var_dump($atualiza); 
    }
