<?php $painel_atual = "professor";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<?php require_once "../config.php";require_once "../gerador_cobranca.php"; $code; ?>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<title>Administração do Professor</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />
<link rel="stylesheet" href="css/style.css">


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
   
  <img id="img" src="../image/logo_ist.gif" />
 </div><!-- logo -->
 <script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="index.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>
 <div id="mostra_login">
  <h1><strong>Olá, Professor(a)
     
   <?php 
    
    $sql_busca_nome="select nome,id_professores from professores where code='$code'";
    $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=mysqli_fetch_assoc($con_busca_nome)){
       echo $nome_professor=$res_busca_nome['nome'];
       $id_professor=$res_busca_nome['id_professores'];
       $ano_letivo=date("Y");
       }
    ?>, seu código é:</strong> <?php echo @$code."."; ?>
      Escolha uma <strong>Categoria:</strong>
      <form name='incluir' ... />
       <select class="custom-select" name="selec" LANGUAGE="JAVASCRIPT" ONCHANGE="submit()" >
         <?php
            
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
             ?>
         <option value="">Selecione aqui.</option>
      <?php  
      $sql_busca_cur="SELECT DISTINCT cat.categoria,cat.id_categoria FROM disciplinas d inner join professores p on d.id_professores=p.id_professores inner join cursos c on d.id_cursos=c.id_cursos inner join categoria cat on c.id_categoria=cat.id_categoria where code='$code'";
       $con_busca_cur=mysqli_query($conexao,$sql_busca_cur);
       while($res_busca_cur=mysqli_fetch_assoc($con_busca_cur)){
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
              
            <li> <a href="turmas_e_alunos.php?selec=nada selecionado">Turmas e Alunos</a>
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
         <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Atividades/tarefas</a></li>
         <li><a href="todas_pro_inter.php?pg=projetos-interdisciplinar&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Projetos (Inter)Disciplinar COC</a></li>
         <li><a href="todas_pro_trans.php?pg=projetos-transversal&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Projeto Transversal</a></li>
         <li><a href="todas_coc.php?pg=coc&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Avaliação Nacional do COC</a></li>
         <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Teste</a></li>
         <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Prova</a></li>
         <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Nota Bimestre</a></li>
         <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
        </ul>
    
          <?php
          break;
          case '3':
            ?>      
      <ul>
     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Atividades/tarefas</a></li>
     <li><a href="todas_pro_inter.php?pg=projetos-interdisciplinar&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Projetos (Inter)Disciplinar COC</a></li>
     <li><a href="todas_pro_trans.php?pg=projetos-transversal&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Projeto Transversal</a></li>
     <li><a href="todas_coc.php?pg=coc&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Avaliação Nacional do COC</a></li>
     <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Teste</a></li>     
     <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Prova</a></li>
     <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Nota Bimestre</a></li>
     <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
    </ul>

      <?php
            break;
            case '4':
              ?>
      
              <ul>
             <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Atividades/tarefas</a></li>
             <li><a href="todas_simulados.php?pg=simulados&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Simulados</a></li>
             <li><a href="todas_as_trabalhos.php?pg=trabalhos&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Trabalho_Individual</a></li>
             <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Teste</a></li>
             <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Prova</a></li>
             <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Lançar Nota Bimestre</a></li>
             <li><a href="notas_geral.php?pg=notas&selec=<?php echo $_GET['selec'];?>&code=<?php echo $code;?>">Distribuição das Notas</a></li>
             <!-- <li><a href="gerar_pdf.php?pg=notas&selec=<?php echo $_GET['selec'];?>">Distribuição das Notas</a></li>  -->
            </ul>
              
              <?php
                break;
      
    
    }
  }
   ?>
   </li>
   <li><a href="suporte_tecnico.php?selec=nada selecionado">Suporte Escolar</a></li>
   
        </ul>
        

    </nav>
    </div>
</body>
</html>