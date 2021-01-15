<?php $painel_atual = "Coordenacao";?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <?php require_once "../config.php";require_once "../gerador_cobranca.php"; $code; ?>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/topos.css" rel="stylesheet" type="text/css" />
    <title>Coordenação</title>
    <link rel="shortcut icon" href="../image/logo_ist.gif">
    <script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/lightbox.js"></script>
    <link href="../css/lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/estilo.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>


    <script type="text/javascript" src="../jquery.superbox-min.js"></script>

    <script src="js/jquery.maskedinput-1.3.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {

        $.superbox.settings = {

            closeTxt: "Fechar",

            loadTxt: "Carregando...",

            nextTxt: "Next",

            prevTxt: "Previous"

        };

        $.superbox();

    });
    </script>

</head>

<body>
    <div id="box_topo">

        <div id="logo">

            <img id="img" src="../image/logo.png" />
        </div><!-- logo -->
        <script language="JavaScript">
        function refresh() { // <!--  //nome_do_form.action -->
            incluir.action = "index.php"; // <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
            incluir.submit();
        }
        </script>
        <div id="mostra_login">
            <h1><strong>Olá, Coordenador(a)

                    <?php 
    $sql_busca_nome=$pdo->prepare("select nome,id_func from funcionarios where code=:code");
    $sql_busca_nome->bindValue(':code',$code);
    $sql_busca_nome->execute();

    // $sql_busca_nome="select nome,id_func from funcionarios where code='$code'";
    // $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=$sql_busca_nome->fetch()){
       echo $nome_professor=$res_busca_nome['nome'];
       $id_func=$res_busca_nome['id_func'];
       $ano_letivo=date("Y");
       }
    ?>, seu código é:</strong> <?php echo @$code."."; ?>
                Escolha uma <strong>Categoria:</strong>
                <form name='incluir' ... />
                <select class="custom-select" name="selec" LANGUAGE="JAVASCRIPT" ONCHANGE="submit()">
                    <?php
            if(@$_GET['selet'] && $_GET['selec']==''){
              switch ($_GET['selet']){
                case '1':
                 echo '<option value="">Fundamental Anos Iniciais</option>';
                  break;
                  case '2':
                   echo '<option value="">Fundamental Anos Finais</option>';
                    break;
                    case '3':
                     echo '<option value="">Ensino Médio Inicial</option>';
                      break;
                      case '4':
                       echo '<option value="">Ensino Médio Final</option>';
                        break;
                       }
            }else{
             switch (@$_GET['selec']){
               case '1':
                echo '<option value="">Fundamental Anos Iniciais</option>';
                 break;
                 case '2':
                  echo '<option value="">Fundamental Anos Finais</option>';
                   break;
                   case '3':
                    echo '<option value="">Ensino Médio Inicial</option>';
                     break;
                     case '4':
                      echo '<option value="">Ensino Médio Final</option>';
                       break;
                      }
             }
             ?>
                    <option value="">Selecione aqui.</option>
                    <?php  
      $sql_busca_coor=$pdo->prepare("SELECT * FROM coordenador c inner join categoria cat on cat.id_categoria=c.categoria where c.code=:code");
      $sql_busca_coor->bindValue(':code',$code);
      $sql_busca_coor->execute();
      // $sql_busca_cur="SELECT * FROM coordenador c inner join categoria cat on cat.id_categoria=c.categoria where c.code='$code'";
      //  $con_busca_cur=mysqli_query($conexao,$sql_busca_cur);
       while($res_busca_cur=$sql_busca_coor->fetch()){
          $modalidade=$res_busca_cur["categoria"];
          
          ?>

                    <option value=<?php echo $res_busca_cur["id_categoria"]; ?>>
                        <?php echo $res_busca_cur["categoria"]; ?></option>



                    <?php } ?>
                </select>

            </h1>


        </div><!-- mostra_login -->
    </div><!-- box_topo -->
    <div class="pos-f-t">
        <div class="collapse show" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">

                <center>
                    <div class="box-menu">

                        <div class="menu-box">
                            <ul class="menu">
                                <li class="dropdown"><a href="index.php">Inicio</a></li>
                                <li class="dropdown"><a>Frequência</a>
                                    <ul class="dropdown-content">
                                        <li>
                                            <a class="a"
                                                href="turmas_e_alunos.php?selec=<?php echo @$_GET['selec'];?>">Inserir
                                                Frequência</a>
                                        </li>
                                        <li>
                                            <a class="a"
                                                href="frequencias_geral.php?pg=frequencia&selec=<?php echo @$_GET['selec'];?>&code=<?php echo $code;?>">Relatório
                                                de Frequência</a>
                                        </li>
                                        <li>
                                            <a class="a"
                                                href="valor_atividades.php?selec=<?php echo @$_GET['selec'];?>">Valor
                                                max. das Atividades</a>
                                        </li>
                                        <li>
                                            <a class="a"
                                                href="cargaHoraria.php?selec=<?php echo @$_GET['selec'];?>">Inserir
                                                Hora/Aula/Diária
                                                de Frequência</a>
                                        </li>
                                        <li>
                                            <a class="a"
                                                href="turmas_conselho.php?selec=<?php echo @$_GET['selec'];?>">Conselho</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a>Avaliações</a>
                                    <ul class="dropdown-content">
                                        <?php 
    if (@$_GET['selec']) {
      $variable=$_GET['selec'];
      # code...
    
    switch ($variable) {
      case '1':
        ?>

                                        <li><a class="a"
                                                href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar
                                                Notas</a></li>
                                        <!-- <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<php echo $_GET['selec']; ?>&code=<php echo $code;?>">Trabalhos/Atividades Praticas</a></li>
     <li><a href="todas_provas.php?pg=provas&selec=<php echo $_GET['selec']; ?>&code=<php echo $code;?>">Provas</a></li> -->
                                        <li><a class="a"
                                                href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar
                                                nota Apredizagem</a></li>
                                        <li><a class="a"
                                                href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span
                                                    class="badge badge-light"
                                                    style="font-size:6px; background-color:red;">*</span></a></li>

                                        <?php 
        break;
        case '2':
          ?>

                                        <li><a class="a"
                                                href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar
                                                Notas</a></li>
                                        <!-- <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">2ª Ava</a></li>
         <li><a href="todas_teste.php?pg=teste&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">3ª Ava</a></li>     
         <li><a href="todas_provas.php?pg=provas&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">4ª Ava</a></li> -->
                                        <li><a class="a"
                                                href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar
                                                Nota Bimestre</a></li>
                                        <li><a class="a"
                                                href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span
                                                    class="badge badge-light"
                                                    style="font-size:6px; background-color:red;">*</span></a></li>



                                        <?php
          break;
          case '3':
            ?>

                                        <li><a class="a"
                                                href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar
                                                Notas</a></li>
                                        <!-- <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">2ª Ava</a></li>
         <li><a href="todas_teste.php?pg=teste&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">3ª Ava</a></li>     
         <li><a href="todas_provas.php?pg=provas&selec=<php echo $_GET['selec'];?>&code=<php echo $code;?>">4ª Ava</a></li> -->
                                        <li><a class="a"
                                                href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar
                                                Nota Bimestre</a></li>
                                        <li><a class="a"
                                                href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span
                                                    class="badge badge-light"
                                                    style="font-size:6px; background-color:red;">*</span></a></li>


                                        <?php
            break;
            case '4':
              ?>


                                        <li><a class="a"
                                                href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar
                                                Notas</a></li>
                                        
                                        <li><a class="a"
                                                href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar
                                                Nota Bimestre</a></li>
                                        <li><a class="a"
                                                href="notafinal.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Recuperação<span
                                                    class="badge badge-light"
                                                    style="font-size:6px; background-color:red;">*</span></a></li>

                                        <!-- <li><a href="gerar_pdf.php?pg=notas&selec=<?php echo $_GET['selec'];?>">Distribuição das Notas</a></li>  -->


                                        <?php
                break;
      
    
    }
  }
   ?>
                                    </ul>
                                </li>
                                <li class="dropdown"><a>Relatórios</a>
                                    <ul class="dropdown-content">
                                        <li><a class="a"  href="relatorios.php?selec=<?php echo @$_GET['selec'];?>">LISTA AP/RP</a>
                                        </li>
                                        <li><a class="a" href="relatorios_aluno.php?selec=<?php echo @$_GET['selec'];?>">Boletim
                                                Aluno</a></li>
                                        <li><a class="a"
                                                href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição
                                                das Notas</a></li>

                                    </ul>
                                </li>
                                <li class="dropdown"><a href="suporte_tecnico.php?selec=nada selecionado">Chat</a>

                                </li>

                                <li class="dropdown"><a id="right" href="../config.php?acao=quebra">Sair</a></li>
                            </ul>
                        </div>
                    </div>

            </div>

            </center>
        </div>
    </div>

    <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
            aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <!-- </div> -->
    </div>


    <?php for ($i=0; $i <6 ; $i++) { 
      # code...
      echo "</br>";
    }?>
</body>

</html>