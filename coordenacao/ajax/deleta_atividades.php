<?php
require_once '../../Control/conexao.php';

if(isset($_GET['atividade'])){
    $idnota=$_GET['atividade'];
    $deleta_nota=$pdo->prepare("DELETE FROM notas_atividades where id_notas_atividades=:id");
    // $deleta_nota="DELETE FROM notas_atividades where id_notas_atividades='$idnota'";
    $deleta_nota->bindValue(':id',$idnota);
    $deleta_nota->execute();
    }
    if(isset($_GET['trabalho'])){
      $idnota=$_GET['trabalho'];
      $deleta_nota=$pdo->prepare("DELETE FROM notas_ava_coc where id_notas_ava_coc=:id");
    //   $deleta_nota="DELETE FROM notas_ava_coc where id_notas_ava_coc='$idnota'";
      $deleta_nota->bindValue(':id',$idnota);
      $deleta_nota->execute();
     
    }

      if(isset($_GET['teste'])){
        $idnota=$_GET['teste'];
        $deleta_nota=$pdo->prepare("DELETE FROM notas_ava_teste where id_notas_ava_teste=:id");
        $deleta_nota->bindValue(':id',$idnota);
        $deleta_nota->execute();
        
        }
        if(isset($_GET['prova'])){
          $idnota=$_GET['prova'];
          $deleta_nota=$pdo->prepare("DELETE FROM notas_ava_prova where id_notas_ava_prova=:id");
        $deleta_nota->bindValue(':id',$idnota);
        $deleta_nota->execute();
          
          }
?>