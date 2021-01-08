<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Atividades</title>
<link rel="shortcut icon" href="../image/logo.png">
<link rel="stylesheet" type="text/css" href="css/correcao_prova.css"/>
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:2%;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<?php require "topo.php";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $selec=$_GET['selec'];

}
else{
  $id=$_POST['id'];
}



$busca_prova="SELECT id_disciplina from atividades_bimestrais where id_ativ_bim='$id'";
$con_busca=mysqli_query($conexao,$busca_prova);
while($res_busca=mysqli_fetch_assoc($con_busca)){
$disciplina=$res_busca['id_disciplina'];}?>
<?php 
$buscaDis="SELECT l.nome,c.curso FROM disciplinas d inner JOIN cursos c on d.id_cursos=c.id_cursos inner join lista_disc l on d.disciplina=l.id_lista WHERE d.id_disciplinas='$disciplina'";
$conDis=mysqli_query($conexao,$buscaDis);
while($resDis=mysqli_fetch_assoc($conDis)){
  $disc=$resDis['nome'];
  $curso=$resDis['curso'];
}
 ?>
<script type="text/javascript">
function setFocus() {
  document.getElementById("button").focus(); 
}
</script> 
<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box" onLoad="setFocus()">
<div class="div-responsive">
<br>
<h1><a id="carrega" class="a3" rel="stylesheet" href="correcao_atividades.php?pg=atividade_bimestral&selec=<?php echo $selec; ?>&id=<?php echo $id; ?>">Atualizar Pagina</a></h1>
<br>
 <h1>Abaixo, segue os alunos desta disciplina:  <?php echo $disc."  ".$curso;?>.       <h1>Lançar a nota da 1ª Ava</h1></h1>
 <div id="listar"></div>
</div>
</div><!-- box -->

<?php if(isset($_GET['button'])){

$code_aluno = $_GET['code_aluno'];
$nota = $_GET['nota'];
$nota2 = $_GET['nota2'];
$nota3 = $_GET['nota3'];
$nota4= $_GET['nota4'];
$bimestre = $_GET['bimestre'];
$disciplina = $_GET['disciplina'];
// $prova = $_FILES['prova']['name'];
$date=Date('Y');

switch ($bimestre) {
  case '1':
    # code...
    if($nota!=''){
      $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota>$verifica[0]['primeira']){
          ?>
          <script>
            alert('Esta nota acima de <?=$verifica[0]['primeira']?>, entre em contato com o seu coordenador!');
            
          </script>  
          <?php
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
// trabalho
if($nota2!=''){
  $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
  $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

if($nota2>$verifica[0]['segunda']){
      ?>
      <script>
        alert('Esta nota acima de <?=$verifica[0]['segunda']?>, entre em contato com o seu coordenador!');
        
      </script>  
      <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota2);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // teste
    if($nota3!=''){
      $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota3>$verifica[0]['terceira']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['terceira']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota3);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // prova
    if($nota4!=''){
      $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota4>$verifica[0]['quarta']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['quarta']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
     }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota4);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
    
  } 
  echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
    break;
    case '2':
      # code...
      if($nota!=''){
        $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
  
      if($nota>$verifica[0]['primeira']){
      ?>
      <script>
        alert('Esta nota acima de <?=$verifica[0]['primeira']?>, entre em contato com o seu coordenador!');
        
      </script>  
      <?php
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->execute();
            
            $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
          ?>
          <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
          <?php
      }
        }
      }
    // trabalho
    if($nota2!=''){
      $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota2>$verifica[0]['segunda']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['segunda']?>, entre em contato com o seu coordenador!');
     
    </script>  
    <?php
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota2);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->execute();
            
            $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
         
        }else{
          ?>
          <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
          <?php
      }
        }
      }
        // teste
        if($nota3!=''){
          $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
          $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
    
        if($nota3>$verifica[0]['terceira']){
        ?>
        <script>
          alert('Esta nota acima de <?=$verifica[0]['terceira']?>, entre em contato com o seu coordenador!');
          alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
        </script>  
        <?php
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota3);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->execute();
            
            $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
          ?>
          <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
          <?php
      }
        }
      }
        // prova
        if($nota4!=''){
          $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
          $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
    
        if($nota4>$verifica[0]['quarta']){
        ?>
        <script>
          alert('Esta nota acima de <?=$verifica[0]['quarta']?>, entre em contato com o seu coordenador!');
          alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
        </script>  
        <?php
         }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota4);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->execute();
            
            $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
        
        }else{
          ?>
          <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
          <?php
      }
        }
        
      } 
      echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
      
      //  echo "<script>alert('$nota,$nota2,$nota3,$nota4')</script>";
      
      break;
      case '3':
        # code...
    if($nota!=''){
      $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota>$verifica[0]['primeira']){
          ?>
          <script>
            alert('Esta nota acima de <?=$verifica[0]['primeira']?>, entre em contato com o seu coordenador!');
            
          </script>  
          <?php
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
// trabalho
if($nota2!=''){
  $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
  $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

if($nota2>$verifica[0]['segunda']){
      ?>
      <script>
        alert('Esta nota acima de <?=$verifica[0]['segunda']?>, entre em contato com o seu coordenador!');
        
      </script>  
      <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota2);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // teste
    if($nota3!=''){
      $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota3>$verifica[0]['terceira']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['terceira']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota3);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // prova
    if($nota4!=''){
      $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota4>$verifica[0]['quarta']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['quarta']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
     }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota4);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
    
  } 
  echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
        # code...
    
        
        
        
        break;
        case '4':
          # code...
    if($nota!=''){
      $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota>$verifica[0]['primeira']){
          ?>
          <script>
            alert('Esta nota acima de <?=$verifica[0]['primeira']?>, entre em contato com o seu coordenador!');
            
          </script>  
          <?php
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
// trabalho
if($nota2!=''){
  $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
  $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

if($nota2>$verifica[0]['segunda']){
      ?>
      <script>
        alert('Esta nota acima de <?=$verifica[0]['segunda']?>, entre em contato com o seu coordenador!');
        
      </script>  
      <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota2);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // teste
    if($nota3!=''){
      $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota3>$verifica[0]['terceira']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['terceira']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota3);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
  }
    // prova
    if($nota4!=''){
      $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota4>$verifica[0]['quarta']){
    ?>
    <script>
      alert('Esta nota acima de <?=$verifica[0]['quarta']?>, entre em contato com o seu coordenador!');
      alert('Atenção:Para o ensino fundamental inicial está liberada a 4º para inserir como 3ª');
    </script>  
    <?php
     }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota4);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->execute();
        
        $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
    
    }else{
      ?>
      <script>alert('a nota do aluno ja foi inserida, atualize a pagina!!')</script>
      <?php
  }
    }
    
  } 
  echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
          # code...
      
          
          
          
          break;
  
 
}


echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";

}///primeiro if
?> 
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

              $("#nota2").mask("9.9");
              
              $("#nota2").css('background', 'write');
              $('#nota2').attr("disabled", false);
              

              $("#nota3").mask("9.9");
              
              $("#nota3").css('background', 'write');
              $('#nota3').attr("disabled", false);
             
              $("#nota4").mask("9.9");
              
              $("#nota4").css('background', 'write');
              $('#nota4').attr("disabled", false);
             
            });
          })(jQuery);
        </script>
<?php require "rodape.php"; ?>

<body>
</body>
</html>


<script type="text/javascript">
    $(document).ready(function(event){     
            var u_id=<?=$id?>;
            var u_selec=<?=$selec?>;
            var u_disci=<?=$disciplina?>;
            // window.alert(u_id);
            $.ajax({
            url:"ajax/listar_atividades.php",
            method: 'GET',
            data: {id:u_id,botao:u_selec,disciplina:u_disci},
            datatype:'json',
            success:function(result){
                $('#listar').html(result)
            },
              })        
    })

</script>
<script type="text/javascript">
    $('#carrega').click(function(event){
        event.preventDefault();     
            var u_id=<?=$id?>;
            var u_selec=<?=$selec?>;
            var u_disci=<?=$disciplina?>;
            // window.alert(u_id);
            $.ajax({
            url:"ajax/listar_atividades.php",
            method: 'GET',
            data: {id:u_id,botao:u_selec,disciplina:u_disci},
            datatype:'html',
            success:function(result){
                $('#listar').html(result)
            },
              })        
  })
</script>
