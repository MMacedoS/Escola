<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $painel_atual = "professor"; ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Nota</title>
<?php require "../config.php"; ?>
</head>

<body>
<?php if($_GET['pg'] == 'observacao'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];


$sql_trabalhos = "UPDATE notas_observacao SET nota = '$nota' WHERE code = '$aluno' AND disciplina = '$dis' AND bimestre = '$bimestre' and id='$id'";

mysqli_query($conexao, $sql_trabalhos);

$sql_busca="select nome from estudantes where code='$aluno'";
$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>

<?php if($_GET['pg'] == 'atividade_pesquisa'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];


$sql_trabalhos = "UPDATE notas_trabalhos SET nota = '$nota' WHERE code = '$aluno' AND disciplina = '$dis' AND bimestre = '$bimestre' and id='$id'";

mysqli_query($conexao, $sql_trabalhos);

$sql_busca="select nome from estudantes where code='$aluno'";
$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>

<?php if($_GET['pg'] == 'atividade_bimestral'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];

if($nota>1){?>
<script>
    alert('Nota Maxima 1.0 para esta paralela');
  </script>
  <?php
}else{
$sql_6 = "UPDATE notas_atividades SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}}

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>
<!-- interdisciplinar -->

<?php if($_GET['pg'] == 'projetos_interdisciplinar'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];

if($nota>1){?>
<script>
    alert('Nota Maxima 1.0 para esta paralela');
  </script>
  <?php
}else{
$sql_6 = "UPDATE notas_pro_inter SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}
}
die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>

<!-- fim inter -->

<!--transversal  -->

<?php if($_GET['pg'] == 'projetos_transversal'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];

if($nota>1 && $bimestre!=3){?>
<script>
    alert('Nota Maxima 1.0 para esta atividade neste bimestre');
  </script>
  <?php
}else{
$sql_6 = "UPDATE notas_pro_transversal SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}
}
die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>
<!-- fim trans -->

<!-- coc -->
<?php if($_GET['pg'] == 'coc'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];

if($nota>1){?>
<script>
    alert('Nota Maxima 1.0 para esta atividade');
  </script>
  <?php
}else{

$sql_6 = "UPDATE notas_ava_coc SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}}

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>


<!-- fim coc -->
<!-- teste -->
<?php if($_GET['pg'] == 'teste'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];
if($nota>3){?>
<script>
    alert('Nota Maxima 3.0 para esta atividade');
  </script>
  <?php
}else{

$sql_6 = "UPDATE notas_ava_teste SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";


}
}
die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>

<!-- fim teste -->

<!-- provas -->
<?php if($_GET['pg'] == 'provas'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];
if($nota>3){?>
<script>
    alert('Nota Maxima 3.0 para esta atividade');
  </script>
  <?php
}else{

$sql_6 = "UPDATE notas_ava_prova SET nota = '$nota' WHERE code = '$aluno' AND id_disciplina = '$dis' AND bimestre = '$bimestre' and id_atividade='$id'";

mysqli_query($conexao, $sql_6);

$sql_busca="SELECT nome from estudantes where matricula='$aluno'";

$con_busca=mysqli_query($conexao,$sql_busca);
while($res_busca=mysqli_fetch_assoc($con_busca)){
echo "A nota deste aluno foi alterada com sucesso!!! ".$res_busca['nome']."  clique fora e atualize a pagina";

}
}

die;

}?>
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>
<!-- fim provas -->

<?php if($_GET['pg'] == 'ponto_extra'){ ?>

<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$id=$_GET['id'];
$bimestre = $_GET['bimestre'];
$professor = $_GET['professor'];
$disciplina = $_GET['id'];
$code_aluno = $_GET['aluno'];
$notaAntiga=7-$_GET['nota'];
if($nota>$notaAntiga){?>
<script>
    alert('Nota Maxima <?php echo $notaAntiga; ?> para esta paralela');
  </script>
  <?php
}else{
$sql = "UPDATE notas_ava_teste set nota=nota+'$nota' where id_disciplina='$disciplina' AND code='$code_aluno' AND bimestre='$bimestre'";
mysqli_query($conexao, $sql);

echo "A nota deste aluno foi alterada com sucesso!!!";}
die;
	
}?>

<em>Nota abaixo corresponde ao restante para atingir a média do bimestre, será add em Nota do teste</em>
<form name="" method="post" action="" enctype="multipart/form-data">
<?php if($_GET['nota']>=7){?>
	<h2>média atingida</h2>
<?php }else{?> 
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $nota=7-$_GET['nota']; ?>" /><input type="submit" name="send" value="Inserir" />
 <?php }?>
</form>

<?php } ?>





<?php if($_GET['pg'] == 'trabalho_extra'){ ?>
 
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$id_envio = $_GET['id'];
$aluno = $_GET['aluno'];
$disciplina = $_GET['disciplina'];
$id_trabalho = $_GET['id_trabalho'];

$a_nota = $_GET['nota'];

$sql_2 = "UPDATE envio_de_trabalhos_extras SET nota = '$nota' WHERE id = '$id_envio' AND id_trabalho	 = '$id_trabalho' AND disciplina = '$disciplina' AND aluno = '$aluno'";

mysqli_query($conexao, $sql_2);

$sql_3 = "SELECT * FROM pontos_extras WHERE code = '$aluno' AND disciplina = '$disciplina'";
$result = mysqli_query($conexao, $sql_3);

	while($res_1 = mysqli_fetch_assoc($result)){
			$d_nota = $res_1['nota']-$a_nota;
			
			$nova_nota = $d_nota+$nota;
			
			$sql_4 = "UPDATE pontos_extras SET nota = '$nova_nota' WHERE code = '$aluno' AND disciplina = '$disciplina'";
			mysqli_query($conexao, $sql_4);
			echo "A nota deste aluno foi alterada com sucesso!!!";
			die;
	
		}

}?> 
 
<em>Digite abaixo qual vai ser a nova nota</em>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="text" size="4" maxlength="7" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form> 
<?php } ?>

</body>
</html>