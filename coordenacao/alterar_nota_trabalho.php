<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $painel_atual = "Coordenacao"; ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
  

	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
  
  <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>

<?php if($_GET['pg'] == 'atividade_bimestral'){ ?>
<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$aluno = $_GET['aluno'];
$id = $_GET['id'];
$dis = $_GET['disciplina'];
$bimestre = $_GET['bimestre'];
$selec=$_GET['selec'];

if($nota>1){?>
<script>
    alert('Nota Maxima 1.0 para esta atividade, delete a nota caso tenha inserido errada!');
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
    alert('Nota Maxima 1.0 para esta atividade');
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
 <input type="text" size="4" maxlength="7"  id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
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
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form>
<?php }?>
<!-- fim provas -->

<?php if($_GET['pg'] == 'ponto_extra'){ ?>

<?php if(isset($_POST['send'])){

$nota = $_POST['nota'];
$id=$_GET['id'];
$selec=$_GET['selec'];
$bimestre = $_GET['bimestre'];
$professor = $_GET['professor'];
$disciplina = $_GET['id'];
$code_aluno = $_GET['aluno'];
$notaAntiga=7-$_GET['nota'];
$ano=Date('Y');

$verif_nota=$pdo->prepare('SELECT id_paralela FROM  paralela where code=? and id_disciplina=? and bimestre=? and ano_letivo=?');
$verif_nota->bindValue(1,$code_aluno);
$verif_nota->bindValue(2,$disciplina);
$verif_nota->bindValue(3,$bimestre);
$verif_nota->bindValue(4,$ano);
$verif_nota->execute();
$dados=$verif_nota->fetchALL();
$qtde=count($dados);
foreach($dados as $dado){
  $id_paralela=$dado['id_paralela'];
}
if($qtde==0){
  if($nota<0 || $nota>2){?>
    <script>
        alert('Nota Maxima 2 para esta paralela');
      </script>
      <?php
    
    }elseif($nota<=2){
      if($selec=="1"){
        $sql=$pdo->prepare('INSERT INTO  paralela (code,id_disciplina,bimestre,ano_letivo,nota) VALUES (:code,:dis,:bimestre,:ano,:nota)');
        $sql->bindValue(':code',$code_aluno);
        $sql->bindValue(':dis',$disciplina);
        $sql->bindValue(':bimestre',$bimestre);
        $sql->bindValue(':ano',$ano);
        $sql->bindValue(':nota',$nota);
        $sql->execute();
    
        echo "A nota deste aluno foi alterada com sucesso!!! clique no botão <Atualizar pagina> ou recarregue a pagina! ";
    }else{
      $sql=$pdo->prepare('INSERT INTO  paralela (code,id_disciplina,bimestre,ano_letivo,nota) VALUES (:code,:dis,:bimestre,:ano,:nota)');
        $sql->bindValue(':code',$code_aluno);
        $sql->bindValue(':dis',$disciplina);
        $sql->bindValue(':bimestre',$bimestre);
        $sql->bindValue(':ano',$ano);
        $sql->bindValue(':nota',$nota);
        $sql->execute();
    
        echo "A nota deste aluno foi alterada com sucesso!!! clique no botão <Atualizar pagina> ou recarregue a pagina! ";
    }
    
    }
    
}else{
  if($nota<0 || $nota>2){?>
    <script>
        alert('Nota Maxima 2 para esta paralela');
      </script>
      <?php
    
    }elseif($nota<=2){
      if($selec=="1"){
        $sql=$pdo->prepare('UPDATE paralela SET code=?,id_disciplina=?,bimestre=?,ano_letivo=?,nota=? where id_paralela=?');
        $sql->bindValue(1,$code_aluno);
        $sql->bindValue(2,$disciplina);
        $sql->bindValue(3,$bimestre);
        $sql->bindValue(4,$ano);
        $sql->bindValue(5,$nota);
        $sql->bindValue(6,$id_paralela);
        $sql->execute();
    // $sql = "UPDATE notas_ava_coc set nota=nota+'$nota' where id_disciplina='$disciplina' AND code='$code_aluno' AND bimestre='$bimestre'";
    // mysqli_query($conexao, $sql);
    
    echo "A nota deste aluno foi alterada com sucesso!!! clique no botão <Atualizar pagina> ou recarregue a pagina! ";
    }else{
    // $sql = "UPDATE notas_ava_teste set nota=nota+'$nota' where id_disciplina='$disciplina' AND code='$code_aluno' AND bimestre='$bimestre'";
    // mysqli_query($conexao, $sql);
    $sql=$pdo->prepare('UPDATE paralela SET code=?,id_disciplina=?,bimestre=?,ano_letivo=?,nota=? where id_paralela=?');
        $sql->bindValue(1,$code_aluno);
        $sql->bindValue(2,$disciplina);
        $sql->bindValue(3,$bimestre);
        $sql->bindValue(4,$ano);
        $sql->bindValue(5,$nota);
        $sql->bindValue(6,$id_paralela);
        $sql->execute();
        echo "A nota deste aluno foi alterada com sucesso!!! clique no botão <Atualizar pagina> ou recarregue a pagina! ";
    }
    
    }
    
}

die;
	
}?>

<em>Nota abaixo corresponde ao restante para atingir a média do bimestre, será add em Nota na tabela Paralela</em>
<form name="" method="post" action="" enctype="multipart/form-data">
<?php if($_GET['nota']>=7){?>
	<h2>média atingida</h2>
<?php }else{?> 
 <input type="text" size="4" maxlength="7" id="nota" name="nota" value="<?php echo $nota=7-$_GET['nota']; ?>" /><input type="submit" name="send" value="Inserir" />
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
 <input type="text" size="4" maxlength="7"  id="nota" name="nota" value="<?php echo $_GET['nota']; ?>" /><input type="submit" name="send" value="Alterar" />
</form> 
<?php } ?>

<script>
       (function( $ ) {
            $(function() {
              //$("#date").mask("99/99/9999");
              //$("#phone").mask("(99) 999-9999");
              //$("#cep").mask("99.999-99");
              //$("#cpf").mask("99.999.999-99");
              $("#nota").mask("9.9");
              
              $("#nota").css('background', 'write');
              $('#nota').attr("disabled", false);
              $('#nota').focus();
            });
          })(jQuery);
        </script>
</body>
</html>