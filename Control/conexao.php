<?php

function connectar(){
    $servidor ="localhost";
    $usuario="root";
    $senha="";
    $bd="sistema_escolar_teste";

    $con= new mysqli($servidor,$usuario,$senha,$bd);
    return $con;
}
$conexao=connectar();
?>