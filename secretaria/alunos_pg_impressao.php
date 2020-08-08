<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Imprimir</title>
<link rel="stylesheet" type="text/css" href="css/relatorios.css"/>
</head>

<body>

<div id="box">
<script language="javascript">
window.print() 
</script>
<H1>Lista de Alunos</H1>
<?php 
$painel_atual="admin";
require "../config.php"; 

$s = base64_decode($_GET['s']);
if($s=='pesquisa'){ $s="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where nome!='' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
}else{
  $tipo=$_GET['status'];
  $serie=$_GET['turma'];
  $s="SELECT * FROM estudantes e INNER JOIN cursos_estudantes ce on e.id_estudantes=ce.id_estudantes INNER JOIN cursos c on c.id_cursos = ce.id_cursos where c.id_cursos='$serie' and e.status='$tipo' order by nome asc";
  $sql_1 = mysqli_query($conexao, $s);
}

?>
<hr>
  
<table class="table" id="table-responsive" border="1">
  <tr>
    <td width="300"><strong>Nome:</strong></td>
    <td width="130"><strong>Nº de matricula:</strong></td>
    <td width="155"><strong>Série:</strong></td>
    <td width="194"><strong>Mensalidades pagas:</strong></td>
    <td width="149"><strong>Mensalidade devedoras:</strong></td>
  </tr>
  <?php while($res_1 = mysqli_fetch_assoc($sql_1)){ ?>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td><?php echo $res_1['matricula']; ?></td>
    <td><?php echo $res_1['curso']; ?></td>
    <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['matricula']." AND status = 'Pagamento Confirmado'")); ?></td>
    <td><?php echo mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM mensalidades WHERE matricula = ".$res_1['matricula']." AND status = 'Aguarda Pagamento'")); ?></td>
  </tr>
  <!-- <tr>
    <td colspan="5"></td>
  </tr> -->
  <?php } ?>
  <tr>
  </tr>
</table>
</div><!-- box -->

</body>
</html>