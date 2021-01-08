<?php 
require_once '../../Control/conexao.php';

$primeira=@$_GET['primeira'];
$segunda=@$_GET['segunda'];
$terceira=@$_GET['terceira'];
$quarta=@$_GET['quarta'];
$categoria=@$_GET['categoria'];
$acao=@$_GET['acao'];

if($acao=='Inserir'){

    $consulta=$pdo->prepare('INSERT INTO valor_ativ(primeira,segunda,terceira,quarta,categoria) 
    values(:primeira,:segunda,:terceira,:quarta,:categoria)');
    $consulta->bindValue(':primeira',$primeira);
    $consulta->bindValue(':segunda',$segunda);
    $consulta->bindValue(':terceira',$terceira);
    $consulta->bindValue(':quarta',$quarta);
    $consulta->bindValue(':categoria',$categoria);
    $consulta->execute();
    echo "Dados inseridos com sucesso!!";  

}elseif($acao=="Alterar"){
    $consulta=$pdo->prepare('UPDATE valor_ativ set primeira=:primeira,segunda=:segunda,terceira=:terceira,quarta=:quarta where categoria=:categoria');
    $consulta->bindValue(':primeira',$primeira);
    $consulta->bindValue(':segunda',$segunda);
    $consulta->bindValue(':terceira',$terceira);
    $consulta->bindValue(':quarta',$quarta);
    $consulta->bindValue(':categoria',$categoria);
    $consulta->execute();
    echo "Dados alterados com sucesso!!";  

}

?>

