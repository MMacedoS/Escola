<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<!---<link href="css/turmas_e_alunos.css" rel="stylesheet" type="text/css" />--->

<link rel="shortcut icon" href="../image/logo.png">
</head>

<body>
<?php require_once "topo.php"; ?>
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box">
<h1>Abaixo, observa-se seu histórico de disciplinas e alunos!</h1>
<?php

 $sql_1 = "SELECT d.*,c.curso FROM disciplinas d inner join cursos c on c.id_cursos=d.id_cursos WHERE id_professores = '$id_professor'";
 $result = mysqli_query($conexao, $sql_1);
if(mysqli_num_rows($result) == ''){
	echo "Você não ministra nenhuma disciplina!";
}else{
	while($res_1 = mysqli_fetch_assoc($result)){
		$curso = $res_1['id_cursos'];
?>	
 <table class="users" id="table-responsive" border="0">
  <tr>
    <td width="400"><strong>Disciplina ministrada:</strong> <?php $b_disc=$res_1['disciplina'];
      $buscar_d="SELECT l.id_lista,l.nome,c.categoria FROM lista_disc l inner join categoria c on c.id_categoria=l.categoria where l.id_lista='$b_disc'";
      $busca_con=mysqli_query($conexao,$buscar_d);
      while($busca_r=mysqli_fetch_assoc($busca_con)){
        echo $busca_r['nome'];
        
    echo ' '.$res_1['curso']; 
    echo ' '.$busca_r['categoria'];  } ?></td>
    <td width="300"><strong>Total de alunos:</strong><?php 
	$sql_2 = "SELECT * from estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes where ce.id_cursos='$curso'";
	echo mysqli_num_rows(mysqli_query($conexao, $sql_2)); ?></td>
    <td width="123">
    
    <button id="button" type="button" color="red" onclick="window.location='fazer_chamada.php?selec=selecioneaqui&curso=<?php echo base64_encode($res_1['id_cursos']); ?>&dis=<?php echo base64_encode($res_1['id_disciplinas']); ?>'">Realizar Chamada</button>
    
    </td>
  </tr>
 </table>	
<?php }} ?>
</div><!-- box -->

<?php require "rodape.php"; ?>
</body>
</html>