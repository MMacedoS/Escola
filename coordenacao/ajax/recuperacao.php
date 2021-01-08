<?php 
require_once '../../Control/conexao.php';


$id=@$_GET['id'];
$nota=@$_GET['nota'];    
      if($nota>=6){
        $sql_3 =$pdo->prepare("UPDATE resultado_final SET recuperacao=:nota, situacao=:res  where id_resultado=:id");
        $sql_3->bindValue(':nota',$nota);
        $sql_3->bindValue(':res','aprovado na Final');
        $sql_3->bindValue(':id',$id);
        $sql_3->execute();

        
      }elseif($nota<6 && $nota!=''){
        $sql_3 =$pdo->prepare("UPDATE resultado_final SET recuperacao=:nota  where id_resultado=:id");
        $sql_3->bindValue(':nota',$nota);
        $sql_3->bindValue(':id',$id);
        $sql_3->execute();
       
      }
      elseif($nota==''){
        $sql_3 =$pdo->prepare("UPDATE resultado_final SET recuperacao=:nota, situacao=:res  where id_resultado=:id");
        $sql_3->bindValue(':nota',$nota);
        $sql_3->bindValue(':res','reprovado');
        $sql_3->bindValue(':id',$id);
        $sql_3->execute();
        
    }
       
   

// var_dump($sql_3);
// echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";

?>