<? $painel_atual = "professor";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require "../config.php"; $code; ?>
<link rel="shortcut icon" href="../image/icone.png">
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<title>To Learn - Administração do Professor</title>
<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/lightbox.js"></script>
<link href="../css/lightbox.css" rel="stylesheet" />


<link rel="stylesheet" href="../jquery.superbox.css" type="text/css" media="all" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

	<script type="text/javascript" src="../jquery.superbox-min.js"></script>
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
   
  <img src="../image/logo.png" width="150" />
 </div><!-- logo -->
 <script language="JavaScript">
function refresh() 
{     <!--  nome_do_form.action -->
    incluir.action="index.php";      <!-- Deve ser o nome deste arquivo, refresh para esta mesma página  -->
    incluir.submit();
}
</script>
 <div id="mostra_login">
  <h1><strong>Olá Professor(a):
     
   <?php 
    
    $sql_busca_nome="select nome,id_professores from professores where code='$code'";
    $con_busca_nome=mysqli_query($conexao,$sql_busca_nome);
    while($res_busca_nome=mysqli_fetch_assoc($con_busca_nome)){
       echo $nome_professor=$res_busca_nome['nome'];
       $id_professor=$res_busca_nome['id_professores'];
       $ano_letivo=date("Y");
       }
    ?> Seu código é:</strong> <?php echo @$code; ?>
      Escolha uma <strong>Modalidade:</strong>
      <form name='incluir' ... />
       <select class="custom-select" name="selec" LANGUAGE="JAVASCRIPT" ONCHANGE="refresh()" >
         <?php
             if (isset($_GET['selec'])){?>
             <option value="<?php echo $_GET['selec']; ?>"><?php echo $_GET['selec'];?></option>
             <?php } ?>
         <option value="">nada selecionado!</option>
      <?php  
      $sql_busca_cur="SELECT DISTINCT cat.categoria,cat.id_categoria FROM disciplinas d inner join professores p on d.id_professores=p.id_professores inner join cursos c on d.id_cursos=c.id_cursos inner join categoria cat on c.id_categoria=cat.id_categoria where code='$code'";
       $con_busca_cur=mysqli_query($conexao,$sql_busca_cur);
       while($res_busca_cur=mysqli_fetch_assoc($con_busca_cur)){
          $modalidade=$res_busca_cur["categoria"];
          
          ?>    
      
      <option value=<?php echo $res_busca_cur["categoria"]; ?>><?php echo $res_busca_cur["categoria"]; ?></option>
      
      
      
    <?php } ?>
    </select>
     <button type="button" color="red" onclick="window.location='../config.php?acao=quebra';">SAIR</button>
    </h1>
  

 </div><!-- mostra_login -->
</div><!-- box_topo -->

<div id="box_menu">
 
 <div id="menu_topo">
  <ul>
   <li><a href="index.php">HOME</a></li>
   <li><a href="turmas_e_alunos.php">TURMAS & ALUNOS</a></li>

   <?php  $selectado=isset($_GET['selec']);?>
   <li><a href="">TODAS AS AVALIAÇÕES</a>
    <?php 
     if((isset($_GET['selec'])&& $_GET['selec']=='fundamental-inicial')){
    ?>
    <ul>
     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>">Atividades/tarefas</a></li>
     <li><a href="todas_as_trabalhos.php?pg=atividades_pesquisa&selec=<?php echo $_GET['selec']; ?>">Trabalhos/Atividades Praticas</a></li>
     <li><a href="todas_as_avaliacoes.php?pg=provas_bimestrais&selec=<?php echo $_GET['selec']; ?>">Provas</a></li>
     <li><a href="distribuicao.php?pg=observacoes">Distribuição das Notas</a></li>
    </ul>
     <?php 
     } elseif((isset($_GET['selec']))&&(($_GET['selec']=="ensino-medio-inicial")||($_GET['selec']=="fundamental-final"))){ ?>      
      <ul>
     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais&selec=<?php echo $_GET['selec'];?>">Atividades/tarefas</a></li>
     <li><a href="todas_pro_inter.php?pg=projetos-interdisciplinar&selec=<?php echo $_GET['selec'];?>">Projetos (Inter)Disciplinar COC</a></li>
     <li><a href="todas_pro_trans.php?pg=projetos-transversal&selec=<?php echo $_GET['selec'];?>">Projeto Transversal</a></li>
     <li><a href="todas_coc.php?pg=coc&selec=<?php echo $_GET['selec'];?>">Avaliação Nacional do COC</a></li>
     <li><a href="todas_teste.php?pg=teste&selec=<?php echo $_GET['selec'];?>">Teste</a></li>
     <li><a href="todas_provas.php?pg=provas&selec=<?php echo $_GET['selec'];?>">Prova</a></li>
     <li><a href="todas_notas.php?pg=notas&selec=<?php echo $_GET['selec'];?>">Lançar Nota Bimestre</a></li>
     <li><a href="distribuicao.php">Distribuição das Notas</a></li>
    </ul>

      <?php }elseif((isset($_GET['selec']))&&($_GET['selec']=='ensino-medio-final')){ ?>
      
      <ul>
     <li><a href="todas_ativ_tarefas.php?pg=atividades_bimestrais">Atividades/tarefas</a></li>
     <li><a href="todas_as_simulados.php?pg=provas_bimestrais">Simulados</a></li>
     <li><a href="todas_as_trabalhos.php?pg=atividades_pesquisa">Trabalho_Individual</a></li>
     <li><a href="todas_os_testes.php?pg=observacoes">Teste</a></li>
     <li><a href="todas_as_avaliacoes.php?pg=provas_bimestrais">Prova</a></li>
     <li><a href="todas_as_observacoes.php?pg=observacoes">Distribuição das Notas</a></li>
    </ul>
      
      <?php }elseif(!isset($_GET['selec'])){

         ?>
         <script>
    alert("<?php echo $_GET['selec'];?>");
    </script>
    <?php }  ?>
      
      
      
 
   </li>
   <li><a href="suporte_tecnico.php">Suporte Escolar</a></li>
  </ul>
 </div><!-- menu_topo -->

</div><!-- box_menu -->
</body>
</html>