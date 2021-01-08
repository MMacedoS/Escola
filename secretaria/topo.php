<?php 
$painel_atual="secretaria";
require_once "../config.php";
require "../gerador_cobranca.php"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pt-br">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">

<link rel="shortcut icon" href="../image/logo_ist.gif">
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
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
  <img id="img" src="../image/logo_ist.gif">  
 </div><!-- logo -->

 
 <div id="mostra_login">
  <h1><strong>Seja Bem Vindo  <?php echo $_SESSION['nome']; ?> - Seu código de acesso é: <?php echo @$code; ?></strong> <strong><a href="../config.php?acao=quebra">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->
<div id="menu">
<input type="checkbox" id="bt_menu" />
    <label for="bt_menu">&#9776;</label>
    <nav class="menu">
        <ul>
        <li><a href="index.php">HOME</a></li>
        
                
            </li>
              
            <li> <a href="">Turmas e Disciplinas</a>
                <ul>
                    <li><a href="cursos_e_disciplinas.php?pg=curso">Cadastrar Turma</a></li>
                    <li><a href="cursos_e_disciplinas.php?pg=disciplina">Cadastrar Disciplina</a></li>
                    <li><a href="cursos_e_disciplinas.php?pg=cursoedisciplinas">Cursos & Disciplinas</a></li>
                </ul>
            </li>
            <li><a href="professores.php?pg=todos">PROFESSORES</a></li>  
                
            <li><a href="estudantes.php?pg=todos">ESTUDANTES</a></li>
            <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
            <li> <a href=""> Relatorios </a>
                <ul>
                <li><a href="relatorios.php?tipo=alunos&s=<?php echo base64_encode("pesquisa");?>">Alunos</a></li>
                <li><a href="relatorios.php?tipo=professores&s=<?php echo base64_encode("pesquisa");?>">Professores</a></li>
                <li><a href="fluxo_de_caixa.php?tipo=fluxo&s=<?php echo base64_encode("pesquisa");?>">Fluxo de caixa</a></li>
                </ul>    
            </li>
            
            <li><a href="suporte_tecnico.php">Mensagens</a></li>
                
        </ul>
        

    </nav>
    </div>
</body>
</html>