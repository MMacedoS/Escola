<?php 
$painel_atual="admin";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? require_once "../config.php"; ?>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">>
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
    <?php  require_once "../Control/conexao.php";?>
</head>

<body>
<div id="box_topo">
 
 <div id="logo">
  <img src="../image/logo_ist.gif">  
 </div><!-- logo -->

 
 <div id="mostra_login">
  <h1><strong>Seja Bem Vindo  <?php echo @$nome; ?> - Seu código de acesso é: <?php echo @$code; ?></strong> <strong><a href="../config.php?acao=quebra">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->

<div id="box_menu">
 
 <div id="menu_topo">
  <ul>
   <img src="img/separador_menu.png" />
   <li><a href="index.php">HOME</a></li>
   <img src="img/separador_menu.png" />
   <li><a href="">CURSOS E DISCIPLINAS</a>
    <ul>
    <!-- <li><a href="cursos_e_disciplinas.php?pg=categoria">Cadastrar Categoria</a></li> -->
     <li><a href="cursos_e_disciplinas.php?pg=curso">Cadastrar Curso</a></li>
     <li><a href="cursos_e_disciplinas.php?pg=disciplina">Cadastrar Disciplina</a></li>
     <li><a href="cursos_e_disciplinas.php?pg=cursoedisciplinas">Cursos & Disciplinas</a></li>
    </ul>
   </li>
   <img src="img/separador_menu.png" />
   <li><a href="professores.php?pg=todos">PROFESSORES</a></li>   
   <img src="img/separador_menu.png" />
   <li><a href="estudantes.php?pg=todos">ESTUDANTES</a></li>
   <img src="img/separador_menu.png" />
   <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
   <img src="img/separador_menu.png" />
   <li><a href="">RELATÓRIOS</a>
    <ul>
     <li><a href="">Alunos</a></li>
     <li><a href="">Professores</a></li>
     <li><a href="">Fluxo de caixa</a></li>
    </ul>
   </li>
   <img src="img/separador_menu.png" />
   <li><a href="suporte_tecnico.php">Mensagens</a></li>
   <img src="img/separador_menu.png" />
   <li><a href="">EXTRAS</a>
    <ul>
    <li><a href="funcionarios.php?pg=todos">Funcionários</a></li>
    </ul>
   </li>
   <img src="img/separador_menu.png" />   
  </ul>
 </div><!-- menu_topo -->

</div><!-- box_menu -->
</body>
</html>