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
<link rel="shortcut icon" href="../image/logo.png">
<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />
<link rel="stylesheet" href="css/style1.css">


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

</head>

<body>
<div id="box_topo">
 
 <div id="logo">
   
  <img id="img" src="../image/logo.png" />
 </div><!-- logo -->
 <script language="JavaScript">
function refresh() 
{    // <!--  //nome_do_form.action -->
    incluir.action="index.php";     // <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
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
       <select class="custom-select" name="selec" LANGUAGE="JAVASCRIPT" ONCHANGE="submit()" >
         <?php
            if(@$_GET['selet']){
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
             switch ($_GET['selec']){
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
      
      <option value=<?php echo $res_busca_cur["id_categoria"]; ?>><?php echo $res_busca_cur["categoria"]; ?></option>
      
      
      
    <?php } ?>
    </select>
     <button type="button" color="red" onclick="window.location='../config.php?acao=quebra';">SAIR</button>
    </h1>
  

 </div><!-- mostra_login -->
</div><!-- box_topo -->
<div id="menu">
<input type="checkbox" id="bt_menu" />
    <label for="bt_menu">&#9776;</label>
    <nav class="menu">
        <ul>
        <li><a href="index.php">Inicio</a></li>
        
                
            </li>
              
            <li> <a href="turmas_e_alunos.php?selec=<?php echo @$_GET['selec'];?>">Turmas e Alunos</a>
            <ul>
            <li><a href="frequencias_geral.php?pg=frequencia&selec=<?php echo @$_GET['selec'];?>&code=<?php echo $code;?>">Gerar Frequência</a></li>
            </ul>
                
            </li>
            <li><a href="">Todas as Avaliações</a>
    <?php 
    if (@$_GET['selec']) {
      $variable=$_GET['selec'];
      # code...
    
    switch ($variable) {
      case '1':
        ?>
    <ul>
     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Atividades/tarefas</a></li>
     <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $_GET['selec']; ?>&code=<?php echo $code;?>">Trabalhos/Atividades Praticas</a></li>
     <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec']; ?>&code=<?php echo $code;?>">Provas</a></li>
     <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Nota Bimestre</a></li>
     <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
    </ul>
     <?php 
        break;
        case '2':
          ?>      
          <ul>
         <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">1ª Ava</a></li>
         <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">2ª Ava</a></li>
         <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">3ª Ava</a></li>     
         <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">4ª Ava</a></li>
         <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar Nota Bimestre</a></li>
         <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
        </ul>
    
          <?php
          break;
          case '3':
            ?>      
      <ul>
      <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">1ª Ava</a></li>
        <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">2ª Ava</a></li>
         <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">3ª Ava</a></li>     
         <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">4ª Ava</a></li>
         <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar Nota Bimestre</a></li>
     <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
    </ul>

      <?php
            break;
            case '4':
              ?>
      
              <ul>
              <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">1ª Ava</a></li>
              <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">2ª Ava</a></li>
              <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">3ª Ava</a></li>     
              <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">4ª Ava</a></li>
              <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Visualizar Nota Bimestre</a></li>
             <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
             <!-- <li><a href="gerar_pdf.php?pg=notas&selec=<?php echo $_GET['selec'];?>">Distribuição das Notas</a></li>  -->
            </ul>
              
              <?php
                break;
      
    
    }
  }
   ?>
   </li>
   <li><a href="suporte_tecnico.php?selec=<?php echo $_GET['selec'];?>">Suporte Escolar</a></li>
   
        </ul>
        

    </nav>
    </div>
</body>
</html>