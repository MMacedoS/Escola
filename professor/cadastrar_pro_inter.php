﻿<?php $painel_atual = "professor"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>Cadastro de Provas</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link rel="stylesheet" type="text/css" href="css/cadastrar_prova.css"/>
<?php require "../config.php"; $code; ?>
</head>

<body>

<div id="box">
<?php if($_GET['tipo'] == 'projetos_interdisciplinar'){
  $c=$code;
  if(isset($_GET['selec'])){$selec=$_GET['selec'];} ?>


<?php if(isset($_POST['button'])){

$dis = $_POST['dis'];
$bimestre = $_POST['bimestre'];
$aplicacao = $_POST['aplicacao'];
$detalhes = $_POST['detalhes'];
$date = date("d/m/Y");
$ano_letivo=date("Y");

$sql_2 = "SELECT * FROM disciplinas WHERE id_disciplinas = '$dis'";
$result_2 = mysqli_query($conexao, $sql_2);
	while($res_2 = mysqli_fetch_assoc($result_2)){
		$curso = $res_2['id_cursos'];

$verifica_busca="SELECT * FROM projetos_interdisciplinar where professor='$code' and id_curso='$curso' and bimestre='$bimestre' and ano_letivo='$ano_letivo'";
$con_verifica=mysqli_query($conexao,$verifica_busca);
if(mysqli_num_rows($con_verifica)==0){		
$sql_3 = "INSERT INTO projetos_interdisciplinar (data, status, professor,id_curso, id_disciplina, detalhes, bimestre,ano_letivo, data_aplicacao)
 VALUES ('$date', 'Ativo', '$code', '$curso', '$dis', '$detalhes', '$bimestre', '$ano_letivo','$aplicacao')";
mysqli_query($conexao, $sql_3);
		
$sql_4 = "INSERT INTO mural_aluno (date, status, curso, titulo,origem) VALUES ('$date', 'Ativo', '$curso', 'As notas das provas bimestrais estão sendo divulgadas','projetos Interdisciplinares')";
mysqli_query($conexao, $sql_4);

echo "<script language='javascript'>window.alert('atividade cadastrada com sucesso! Click em OK para cadastrar outras!');window.location='cadastrar_pro_inter.php?tipo=projetos_interdisciplinar&code=$code&selec=$selec';</script>";

die;		
}//fim if verifica
else{
echo "<script language='javascript'>window.alert('atividade ja existe! Click em OK para cadastrar outra!');window.location='cadastrar_pro_inter.php?tipo=projetos_interdisciplinar&code=$code&selec=$selec';</script>";
}
}}?>

<form name="send" method="post" action="" enctype="multipart/form-data">	
	

  
<div class="row">
					<div class="col-md-4 col-sm-12">
						<div class="form-group">
							<label for="exampleFormControlInput1">Disciplina e Turma</label>
      <select name="dis" id="dis">
      <?php
      $sql_busca_nome="select nome,id_professores from professores where code='$c'";
    $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=mysqli_fetch_assoc($con_busca_nome)){
      
       $id_professor=$res_busca_nome['id_professores'];
       $ano_letivo=date("Y");
       }

     $sql_1 = "SELECT * FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner JOIN categoria cat on c.id_categoria=cat.id_categoria WHERE id_professores='$id_professor' and cat.categoria='$selec'";
	  $result = mysqli_query($conexao, $sql_1);
	  	while($res_1 = mysqli_fetch_assoc($result)){
	  ?>
      <option value="<?php echo $res_1['id_disciplinas']; ?>"><?php echo $res_1['disciplina']." <|> ".$res_1['curso']; ?></option>
      <?php } ?>
      </select>
      </div>
          </div>
          <div class="col-md-4 col-sm-12">
						<div class="form-group">
							<label for="exampleFormControlInput1">Bimestre</label>     
        
    <select name="bimestre" size="1">
     <?php $buscaUnidade="SELECT * FROM unidades ";
     $conUnidade=mysqli_query($conexao,$buscaUnidade);
     while($resUnidade=mysqli_fetch_assoc($conUnidade)){
     ?>
      <option value="<?php echo $resUnidade['unidade'];?>"><?php echo $resUnidade['unidade'];?>&ordm; Bimestre</option>
     <?php } ?>
    </select>
    </div>
</div>
<div class="col-md-4 col-sm-12">
						<div class="form-group">
              <label for="exampleFormControlInput1">Data da aplicação</label>
              <input type="text" name="aplicacao" value="<?php echo date("d/m/Y"); ?>">
</div>
</div>
</div>
<div class="col-md-4 col-sm-12">
						<div class="form-group">
              <label for="exampleFormControlInput1">Informações adicionais</label>
              <textarea name="detalhes" cols="" rows="" value="<?php echo $sql_1;?>"></textarea>
              </div>
</div>
<div class="col-md-4 col-sm-12">
						<div class="form-group">
            <input class="input" type="submit" name="button" id="button" value="Cadastrar">
            </div>
</div>

  </form>
<?php } ?>
</div><!-- box -->

</body>
</html>