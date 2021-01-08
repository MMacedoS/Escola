<?php 
require_once '../../Control/conexao.php';

$code_aluno = @$_GET['code_aluno'];
$id=@$_GET['id'];
$nota = @$_GET['nota'];
$nota2 = @$_GET['nota2'];
$nota3 = @$_GET['nota3'];
$nota4= @$_GET['nota4'];
$bimestre = @$_GET['bimestre'];
$disciplina = @$_GET['disciplina'];
// $prova = $_FILES['prova']['name'];
$date=@$_GET['ano'];

switch ($bimestre) {
  case '1':
    # code...
    if($nota!=''){
      $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota>$verifica[0]['primeira']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     This is a danger alert—check it out!
    //   </div>';
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->bindValue(':prova','professor');
        $sql_3->execute();
        
        // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        // mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
        echo'';
  }
    }
  }
// trabalho
if($nota2!=''){
    $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
    $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

  if($nota2>$verifica[0]['segunda']){
//     echo '<div class="alert alert-danger" role="alert">
//     This is a danger alert—check it out!
//   </div>';
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota2);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->bindValue(':prova','professor');
        $sql_3->execute();
        
    //     $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
    //     mysqli_query($conexao, $sql_4);
    // //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
     
    }else{
        echo'';
  }
    }
  }
    // teste
    if($nota3!=''){
        $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
  
      if($nota3>$verifica[0]['terceira']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     This is a danger alert—check it out!
    //   </div>';
     
    }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota3);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->bindValue(':prova','professor');
        $sql_3->execute();
        
        // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        // mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
     
    
    }else{
        echo'';
  }
    }
  }
    // prova
    if($nota4!=''){
      $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota4>$verifica[0]['quarta']){
        echo '<div class="alert alert-danger" role="alert">
       nota acima do valor definido pelo coordenador!
      </div>';
     }else
    {
      $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
      $result_verifica = $sql_verifica->fetchAll();
      $result_verifica= count($result_verifica);
      if($result_verifica==0){
        $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
         VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
        $sql_3->bindValue('codigo',$code_aluno);
        $sql_3->bindValue('bimestre',$bimestre);
        $sql_3->bindValue('disciplina',$disciplina);
        $sql_3->bindValue('nota',$nota4);
        $sql_3->bindValue('id_atividade',$id);
        $sql_3->bindValue('data',$date);
        $sql_3->bindValue(':prova','professor');
        $sql_3->execute();
        
        // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        // mysqli_query($conexao, $sql_4);
    //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
    
    }else{
        echo'';
  }
    }
    
  } 
//   echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
    break;


    // segundo bimestreeee
    case '2':
      # code...
      if($nota!=''){
        $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
  
      if($nota>$verifica[0]['primeira']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     '.$nota.'
    //   </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
         
            echo'';
          
      }
        }
      }
    // trabalho
    if($nota2!=''){
      $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota2>$verifica[0]['segunda']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     '.$nota2.'
    //   </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota2);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
         
        }else{
            echo'';
        }
        }
      }
        // teste
        if($nota3!=''){
            $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota3>$verifica[0]['terceira']){

           
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota3);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
            echo'';
      }
        }
      }
        // prova
        if($nota4!=''){
            $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota4>$verifica[0]['quarta']){
          
            echo '<div class="alert alert-danger" role="alert">
            nota acima do valor definido pelo coordenador!
           </div>';
         
         }else
        {
          $sql_verifica=$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue(':codigo',$code_aluno);
            $sql_3->bindValue(':bimestre',$bimestre);
            $sql_3->bindValue(':disciplina',$disciplina);
            $sql_3->bindValue(':nota',$nota4);
            $sql_3->bindValue(':id_atividade',$id);
            $sql_3->bindValue(':data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
        
        }else{
            echo'';
      }
        }
        
      } 
    //   echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
      
      //  echo "<script>alert('$nota,$nota2,$nota3,$nota4')</script>";
      
      break;
      case '3':
         # code...
      if($nota!=''){
        $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
  
      if($nota>$verifica[0]['primeira']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     This is a danger alert—check it out!
    //   </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
            echo'';
      }
        }
      }
    // trabalho
    if($nota2!=''){
      $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota2>$verifica[0]['segunda']){
         
          echo '<div class="alert alert-danger" role="alert">
       nota acima do valor definido pelo coordenador!
      </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota2);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
        //     $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
        //     mysqli_query($conexao, $sql_4);
        // //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
         
        }else{
            echo'';
      }
        }
      }
        // teste
        if($nota3!=''){
            $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota3>$verifica[0]['terceira']){
        //     echo '<div class="alert alert-danger" role="alert">
        //     This is a danger alert—check it out!
        //   </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota3);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
            echo'';
      }
        }
      }
        // prova
        if($nota4!=''){
            $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota4>$verifica[0]['quarta']){
        //     echo '<div class="alert alert-danger" role="alert">
        //     This is a danger alert—check it out!
        //   </div>';
         }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue(':codigo',$code_aluno);
            $sql_3->bindValue(':bimestre',$bimestre);
            $sql_3->bindValue(':disciplina',$disciplina);
            $sql_3->bindValue(':nota',$nota4);
            $sql_3->bindValue(':id_atividade',$id);
            $sql_3->bindValue(':data',$date);
            $sql_3->bindValue(':prova','professro');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
        
        }else{
            echo'';
      }
        }
        
      } 
    //   echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
      
      //  echo "<script>alert('$nota,$nota2,$nota3,$nota4')</script>";
      
        # code...
    
        
        
        
        break;
        case '4':
           # code...
      if($nota!=''){
        $verifica=$pdo->query("SELECT primeira from valor_ativ where categoria=".$_GET['selec']." limit 1");
        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
  
      if($nota>$verifica[0]['primeira']){
        echo '<div class="alert alert-danger" role="alert">
        nota acima do valor definido pelo coordenador!
       </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_atividades WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_atividades (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
            echo'';
      }
        }
      }
    // trabalho

    if($nota2!=''){
      $verifica=$pdo->query("SELECT segunda from valor_ativ where categoria=".$_GET['selec']." limit 1");
      $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

    if($nota2>$verifica[0]['segunda']){
    //     echo '<div class="alert alert-danger" role="alert">
    //     nota acima do valor definido pelo coordenador!
    //    </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_coc WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_coc (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota2);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
         
        }else{
            echo'';
      }
        }
      }
        // teste
        if($nota3!=''){
            $verifica=$pdo->query("SELECT terceira from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota3>$verifica[0]['terceira']){
        //     echo '<div class="alert alert-danger" role="alert">
        //     nota acima do valor definido pelo coordenador!
        //    </div>';
         
        }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_teste WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_teste (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue('codigo',$code_aluno);
            $sql_3->bindValue('bimestre',$bimestre);
            $sql_3->bindValue('disciplina',$disciplina);
            $sql_3->bindValue('nota',$nota3);
            $sql_3->bindValue('id_atividade',$id);
            $sql_3->bindValue('data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));
         
        
        }else{
            echo'';
      }
        }
      }
        // prova
        if($nota4!=''){
            $verifica=$pdo->query("SELECT quarta from valor_ativ where categoria=".$_GET['selec']." limit 1");
            $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);
      
          if($nota4>$verifica[0]['quarta']){
        //     echo '<div class="alert alert-danger" role="alert">
        //     nota acima do valor definido pelo coordenador!
        //    </div>';
         }else
        {
          $sql_verifica =$pdo->query("SELECT * FROM notas_ava_prova WHERE code = '$code_aluno' AND bimestre = '$bimestre' and id_disciplina='$disciplina' and ano_letivo='$date'");
          $result_verifica = $sql_verifica->fetchAll();
          $result_verifica= count($result_verifica);
          if($result_verifica==0){
            $sql_3 =$pdo->prepare("INSERT INTO notas_ava_prova (code, bimestre, id_disciplina, nota, id_atividade,ano_letivo,prova)
             VALUES (:codigo, :bimestre,:disciplina,:nota,:id_atividade,:data,:prova)");
            $sql_3->bindValue(':codigo',$code_aluno);
            $sql_3->bindValue(':bimestre',$bimestre);
            $sql_3->bindValue(':disciplina',$disciplina);
            $sql_3->bindValue(':nota',$nota4);
            $sql_3->bindValue(':id_atividade',$id);
            $sql_3->bindValue(':data',$date);
            $sql_3->bindValue(':prova','professor');
            $sql_3->execute();
            
            // $sql_4 = "INSERT INTO mural_aluno (date, status, id_cursos,matricula, titulo,origem) VALUES ('$date', 'Ativo', '$curso','$code_aluno', 'As notas das 3º AT estão sendo divulgadas','provas')";
            // mysqli_query($conexao, $sql_4);
        //  (move_uploaded_file($_FILES['prova']['tmp_name'], "../trabalhos_alunos/".$prova));    
        
        }else{
         echo'';
      }
        }
        
      } 
    //   echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";
      
      //  echo "<script>alert('$nota,$nota2,$nota3,$nota4')</script>";
      
          # code...
      
          
           
          
          break;
  
 
}


// echo "<script language='javascript'>window.location='correcao_atividades.php?pg=atividade_bimestral&selec=$selec&id=$id';</script>";

?>