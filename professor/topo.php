<?php $painel_atual = "professor";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">

<?php require_once "../config.php";require_once "../gerador_cobranca.php"; $code; ?>

<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="css/top.css" rel="stylesheet" type="text/css" />

<title>Administração do Professor</title>

<link rel="shortcut icon" href="../image/logo.png">

<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>

<script src="../js/lightbox.js"></script>

<link href="../css/lightbox.css" rel="stylesheet" />

<link rel="stylesheet" href="css/styli.css">





<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

  



	<script type="text/javascript" src="../jquery.superbox-min.js"></script>

  

  <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

	<script type="text/javascript">



		$(function(){



			$.superbox.settings = {



				closeTxt: "Fechar",



				loadTxt: "Carregando...",



				nextTxt: "Next",



				prevTxt: "Previous"



			};



			$.superbox();



		});



	</script>

  <style>

  #form {

    /* margin: auto; */

    margin-left: 0;

    margin-right: 0;



}

.btn-voltar {

    display: none;

    position: fixed;

    margin-top: 70vh;

    margin-left: 15rem;}



  </style>

</head>



<body>

<div id="box_topo">

 <div class="row">

 <div class="logo col-sm-6">

   

  <img id="img" src="../image/logo.png" />

 </div><!-- logo -->

 <script language="JavaScript">

function refresh() 

{     <!--  nome_do_form.action -->

    incluir.action="index.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->

    incluir.submit();

}

</script>

</div>

 <div class="mostra_login col-sm-6">

 <div class="row">

 <div class="col-sm-6">

  <label for=""> Olá, Professor(a)

  

   <?php 

    
    $sql_busca_nome=$pdo->query("select nome,id_professores from professores where code='$code'");
    $sql_busca_nome=$sql_busca_nome->fetchAll(PDO::FETCH_ASSOC);
    foreach($sql_busca_nome as $key=>$res_busca_nome){

       echo $nome_professor=substr($res_busca_nome['nome'],0,9).'...';

       $id_professor=$res_busca_nome['id_professores'];

       $ano_letivo=date("Y");

       }

    ?>,

    </label>

    </div>

    <div class="col-sm-6 ml-2">

    <div class="row">

      <form id="form" name='incluir' ... />

      <label for="">Escolha uma Categoria:</label>

       <select class="custom-select" name="selec" LANGUAGE="JAVASCRIPT" ONCHANGE="submit()" >

         <?php

            

             switch (@$_GET['selec']){

               case '1':

                echo '<option value="1">Fundamental Anos Iniciais</option>';

                 break;

                 case '2':

                  echo '<option value="2">Fundamental Anos Finais</option>';

                   break;

                   case '3':

                    echo '<option value="3">Ensino Médio Inicial</option>';

                     break;

                     case '4':

                      echo '<option value="4">Ensino Médio Final</option>';

                       break;

              

             }

             ?>

         <option value="">Selecione aqui.</option>

      <?php  

      $sql_busca_cur="SELECT DISTINCT cat.categoria,cat.id_categoria FROM disciplinas d inner join professores p on d.id_professores=p.id_professores inner join cursos c on d.id_cursos=c.id_cursos inner join categoria cat on c.id_categoria=cat.id_categoria where code='$code' order by c.ordem asc";

       $con_busca_cur=mysqli_query($conexao,$sql_busca_cur);

       while($res_busca_cur=mysqli_fetch_assoc($con_busca_cur)){

          $modalidade=$res_busca_cur["categoria"];

          

          ?>    

      

      <option value=<?php echo $res_busca_cur["id_categoria"]; ?>><?php echo $res_busca_cur["categoria"]; ?></option>

      

      

      

    <?php } ?>

    </select>

     <!-- <button type="button" color="red" onclick="window.location='../config.php?acao=quebra';">SAIR</button> -->

     </div>  

     </div>

     </div>

 </div><!-- mostra_login -->

 </div>

</div><!-- box_topo -->



<!-- navegação -->



<div id="menu" data-container="menu">

<input type="checkbox" id="bt_menu" />

    <label for="bt_menu">&#9776;</label>

    <nav class="menu">

        <ul>

        <li class="col-sm-3"><a href="index.php">Inicio</a></li>

        

                

            </li>

              

            <li class="col-sm-3"> <a href="turmas_e_alunos.php?selec=<?php echo @$_GET['selec'];?>">Turmas e Alunos</a>

            <ul>

            <li><a href="frequencias_geral.php?pg=frequencia&selec=<?php echo @$_GET['selec'];?>&code=<?php echo $code;?>">Gerar Frequência</a></li>

            </ul>

                

            </li>

            <li class="col-sm-3"><a href="">Todas as Avaliações<span class="badge badge-light" style="font-size:6px; background-color:red;">*</span></a>

    <?php 

    if (@$_GET['selec']) {

      $variable=$_GET['selec'];

      # code...

    

    switch ($variable) {

      case '1':

        ?>

    <ul>

     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Notas</a></li>

   

     <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Nota Aprendizagem</a></li>

     <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
     <li><a href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span class="badge badge-light" style="font-size:6px; background-color:red;">*</span></a></li>

    </ul>

     <?php 

        break;

        case '2':

          ?>      

          <ul>

          <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Notas</a></li>

          <li><a href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span class="badge badge-light" style="font-size:6px; background-color:red;">*</span></a></li>

         <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Nota Aprendizagem</a></li>

         <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>

        </ul>

    

          <?php

          break;

          case '3':

            ?>      

      <ul>

      <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Notas</a></li>

      <!-- <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">1ª Ava</a></li>

        <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">2ª Ava</a></li>

         <li><a href="todas_teste.php?pg=teste&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">3ª Ava</a></li>     

         <li><a href="todas_provas.php?pg=provas&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">4ª Ava</a></li> -->

         <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Nota Aprendizagem</a></li>

     <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
     <li><a href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span class="badge badge-light" style="font-size:6px; background-color:red;">*</span></a></li>

    </ul>



      <?php

            break;

            case '4':

              ?>

      

              <ul>

              <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Notas</a></li>

              <!-- <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">1ª Ava</a></li>

              <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">2ª Ava</a></li>

              <li><a href="todas_teste.php?pg=teste&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">3ª Ava</a></li>     

              <li><a href="todas_provas.php?pg=provas&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">4ª Ava</a></li> -->

              <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Nota Aprendizagem</a></li>

             <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>

             <!-- <li><a href="gerar_pdf.php?pg=notas&selec=<php echo $_GET['selec'];?>">Distribuição das Notas</a></li>  -->
             <li><a href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span class="badge badge-light" style="font-size:6px; background-color:red;">*</span></a></li>

            </ul>

              

              <?php

                break;

      

    

    }

  }

   ?>

   </li>

   <li class="col-sm-3"><a href="suporte_tecnico.php?selec=nada selecionado">Suporte Escolar</a></li>

   <li class="col-sm-3"><a href="../config.php?acao=quebra">Sair</a></li>   

        </ul>

        



    </nav>

    </div>

</body>

</html>