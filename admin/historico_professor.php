<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/historico_do_professor.css">
    
    <title>Historico Professor</title>
    <?php require_once("../control/conexao.php"); ?>
</head>
<body>
<div id="box">
<?php
$id = $_GET['id'];

$sql_1 = "SELECT * FROM professores WHERE id_professores = '$id'";
$consulta = mysqli_query($conexao, $sql_1);
	while($res_1 = mysqli_fetch_assoc($consulta)){
  $id=$res_1['id_professores'];
?>
   <table width="900" border="0">
    <tr>
      <td><h2>Status:</h2></td>
      <td><h2>Salário:</h2></td>
      <td><h2>Código:</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['status']; ?></h3></td>
      <td><h3><?php echo $res_1['salario']; ?></h3></td>
      <td><h3><?php echo $code = $res_1['code']; ?></h3></td>
    </tr>
    <tr>
      <td><h2>Nome:</h2></td>
      <td><h2>CPF:</h2></td>
      <td><h2>Data de nascimento:</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['nome']; ?></h3></td>
      <td><h3><?php echo $res_1['cpf']; ?></h3></td>
      <td><h3><?php echo $res_1['nascimento']; ?></h3></td>
    </tr>
    <tr>
      <td><h2>Formação Acadêmica:</h2></td>
      <td><h2>Graduação(ões):</h2></td>
      <td><h2>Pos-graduação(ões):</h2></td>
    </tr>
    <tr>
      <td><h3><?php echo $res_1['formacao']; ?></h3></td>
      <td><h3><?php echo $res_1['graduacao']; ?></h3></td>
      <td><h3><?php echo $res_1['pos_graduacao']; ?></h3></td>
    </tr>
    <tr>
      
      <td><h2>Mestrado(s):</h2></td>
      <td><h2>Doutorado(s):</h2></td>
    </tr>
    <tr>
      
      <td><h3><?php echo $res_1['mestrado']; ?></h3></td>
      <td><h3><?php echo $res_1['doutorado']; ?></h3></td>
    </tr>
    <tr>
      <td><h2><strong>Disciplinas que este professor ensina:</strong> <?php
       $sql_2 = "SELECT * FROM disciplinas WHERE id_professores = '$id'";
	   $result_disc = mysqli_query($conexao, $sql_2);
	   echo mysqli_num_rows($result_disc); ?></h2></td>
    </tr>
    <?php while($res_2 = mysqli_fetch_assoc($result_disc)){ ?>
    <tr>
      <td><h2>Série:</h2></td>
      <td><h2>Turno:</h2></td>
      <td><h2>Disciplina:</h2></td>
    </tr>
    <tr>
      <td><h3>      
      <?php 
      
      $turmas=$res_2['id_cursos']; 
      $busca_turmas="select * from cursos where id_cursos='$turmas'";
      $con_busca_turmas=mysqli_query($conexao, $busca_turmas);
    while($res_busca=mysqli_fetch_assoc($con_busca_turmas)) {
        echo $res_busca['curso'];
    
      
      ?></h3></td>
      <td><h3> <?php echo $res_busca['turno'];}?> </h3></td>
      <td><h3><?php echo $res_2['disciplina']; ?></h3></td>
    </tr>
    <?php } ?>
  </table>
<?php } ?>  

</div><!-- box -->


</body>
</html>