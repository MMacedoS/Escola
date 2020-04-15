<?php

function connectar(){
    $servidor ="mysql873.umbler.com";
    $usuario="kamaur";
    $senha="kamaur2711";
    $bd="ist";

    $con= new mysqli($servidor,$usuario,$senha,$bd);
    return $con;
}
$conexao=connectar();
?>
<!-- 
    $servidor ="mysql873.umbler.com";
    $usuario="kamaur";
    $senha="kamaur2711";
    $bd="ist";
 -->