<?php

function connectar(){
    $servidor ="localhost";
    $usuario="root";
    $senha="";
    $bd="ist";

    $con= new mysqli($servidor,$usuario,$senha,$bd);
    return $con;
}
$conexao=connectar();
?>