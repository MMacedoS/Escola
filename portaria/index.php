<?php $painel_atual="portaria";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<title>Portaria</title>
<link rel="stylesheet" type="text/css" href="css/stilo.css"/>
<?php require "../config.php"; ?>
</head>

<body>

<div id="box">
 
 <div id="porteiro">
  <h1><strong><i><?php echo $nome; ?></i> Seu código é:</strong> <?php echo $code; ?>
  <a href="../config.php?acao=quebra"><strong>SAIR</strong></a></h1>
 </div><!-- porteiro -->
 
 <div id="logo">
  <img src="../image/logo.png" width="250px" />
 </div><!-- logo -->
 
 <div id="campo_busca">
   <form name="" method="post" action="" enctype="multipart/form-data">
   <input type="text" name="cpf" value="" placeholder="matricula ou cpf" /><input class="input" type="submit" name="enviar" value="" />
  </form>
  <?php 
        if (isset($_POST['enviar'])) {
            # code...
            $_GET['pg']='';
            $cpf = $_POST['cpf'];

            if ($cpf == '') {
                # code...
                echo "<br><br><br><br><h2>Por favor, 
                digite seu cpf ou matricula!')</h2>";
            } else {
                # code...
                $sql = "select * from estudantes where cpf ='$cpf' or code='$cpf' or nome='$cpf' ";

                $resultado = mysqli_query($conexao, $sql);
                if(mysqli_num_rows($resultado) <= 0) {
                    # code...
                   echo "<br><br><br><br><br><h2>Aluno não encontrado, verifique a informação inserida!</h2>";
                } else {
                    # code...
                    while ($res_1 = mysqli_fetch_assoc($resultado)) {
                        # code...
                        $nome = $res_1['nome'];
                        $code_aluno = $res_1['code'];
                        $doc = $res_1['cpf'];

                     
        
  ?>

<br><br><br><br><h3><strong>Aluno: </strong> <?php echo $nome; ?> 
<strong>Nº de matricula: </strong> <?php echo $code_aluno; ?>
<strong>CPF: </strong> <?php echo $doc; ?>
<a href="index.php?pg=confirma&code_a=<?php echo $code_aluno; ?>"><img src="../image/confirma.png" title="Confirmar" border="0" width="22px"/></a>
<a href="index.php">
<img src="../image/deleta.png" width="24px" title="Cancelar" /></a>
 </h3>
 <input type="hidden" name="codes" value="" />  
 
 <?php  
    }//while 
}//ultimp if 
}//segundo if 
}//primeiro if
 ?>
<?php  
    if (@$_GET['pg']=='confirma') {

        # code...
        $data = date("d/m/Y H:i:s");
        $date = date("d/m/Y");
        $code_a = $_GET['code_a'];
        $sql ="insert into confirma_entrada_de_alunos (date, data_hoje,porteiro, code_aluno) 
        values ('$date', '$date', '$code', '$code_a')";

        mysqli_query($conexao, $sql);

        echo "<br><br><br><h2 style='color:green;'>os dados de entrada do aluno inseridos com sucesso!!</h2> ";
    } else {
        # code...
    }
    
?>


 </div><!-- campo_busca -->
 <br><br><br>
</div><!-- box -->
</body>
</html>

