<?php $painel_atual = "Aluno";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="with=device-width,initial-scale=1">
<meta name="viewport" content="with=device-width,initial-scale=1">
<?php require_once "../config.php";require "../gerador_cobranca.php";
$ano=Date('Y');
 
$sql_aluno = "SELECT cat.categoria,c.curso,e.matricula,e.nome,e.cpf,e.id_estudantes,ce.ano_letivo,ce.id_cursos FROM estudantes e 
INNER JOIN cursos_estudantes ce on ce.id_estudantes=e.id_estudantes 
INNER JOIN cursos c on ce.id_cursos=c.id_cursos 
INNER JOIN categoria cat on c.id_categoria=cat.id_categoria
 WHERE e.matricula ='$code' and ce.ano_letivo='$ano'";
$result = mysqli_query($conexao, $sql_aluno);
	while($r_aluno = mysqli_fetch_assoc($result)){
		$nome = $r_aluno['nome'];
		$serie = $r_aluno['id_cursos'];
    $cpf = $r_aluno['cpf'];
    $code=$r_aluno['matricula'];
	
?>
<title> Portal do aluno</title>
<link rel="shortcut icon" href="../image/logo_ist.gif">
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/style.css">
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
  <!-- <img src="../image/logo.png" width="250" /> -->
   <img src="../image/logo_ist.gif">  
 </div><!-- logo -->
 
 <div id="dados_aluno">
	<h1><strong><?php echo @$code; ?></strong>
    <br />
    <?php echo $cpf; ?></h1>
 </div><!-- dados_aluno -->
 
 <div id="mostra_login">
  <h1><strong>Olá :</strong> <?php echo $nome; ?> <strong><a href="../config.php?acao=quebra">Sair</a></strong></h1>
 </div><!-- mostra_login -->
</div><!-- box_topo -->
<div id="menu">
<input type="checkbox" id="bt_menu" />
    <label for="bt_menu">&#9776;</label>
    <nav class="menu">
    <ul>
   <li><a href="index.php">HOME</a></li>
   <li><a href="minhas_notas.php?pg=bimestrais">MINHAS NOTAS</a>
    <?php if($r_aluno['categoria']=="ensino-medio-inicial"){?>
    <ul>
     <li><a href="minhas_notas.php?pg=trabalhos" align="center">Atividade/tarefas</a></li>
     <li><a href="minhas_notas.php?pg=inter" align="center">Proj.Interdisciplinar</a></li>
     <li><a href="minhas_notas.php?pg=coc" align="center" >Avaliações COC</a></li>
     <li><a href="minhas_notas.php?pg=trans" align="center">Proj.Transversal</a></li>
     <li><a href="minhas_notas.php?pg=teste" align="center">Teste</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Provas</a></li>
     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Bimestrais</a></li>
     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição das Notas</a></li>
    </ul>
    <?php }elseif($r_aluno['categoria']=="ensino-medio-final"){
    ?>
    <ul>
     <li><a href="minhas_notas.php?pg=trabalhos" align="center">Atividade/tarefas</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Interdisciplinar</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center" >Avaliações COC</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Transversal</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center">Teste</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Provas</a></li>
     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Bimestrais</a></li>
     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição das Notas</a></li>
    </ul>
    <?php
    }elseif($r_aluno['categoria']=="fundamental-inicial"){
    ?>
    <ul>
     <li><a href="minhas_notas.php?pg=trabalhos" align="center">Atividade/tarefas</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Interdisciplinar</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center" >Avaliações COC</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Transversal</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center">Teste</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Provas</a></li>
     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Bimestrais</a></li>
     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição das Notas</a></li>
    </ul>
    <?php
    }elseif($r_aluno['categoria']=="fundamental-final"){
    ?>
    <ul>
     <li><a href="minhas_notas.php?pg=trabalhos" align="center">Atividade/tarefas</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Interdisciplinar</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center" >Avaliações COC</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Proj.Transversal</a></li>
     <li><a href="minhas_notas.php?pg=observacao" align="center">Teste</a></li>
     <li><a href="minhas_notas.php?pg=provas" align="center">Provas</a></li>
     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Bimestrais</a></li>
     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição das Notas</a></li>
    </ul>
    <?php
    }
    }?>
   </li>
   <!-- <li><a href="">TRABALHOS</a>
    <ul>
     <li><a href="trabalhos.php?pg=trabalhos_bimestrais">Trabalhos bimestrais</a></li>
     <li><a href="trabalhos.php?pg=trabalhos_extras">Trabalhos extras</a></li>
    </ul>
   </li>     -->
   <li><a href="presencas.php">FREQUENCIA ESCOLAR</a></li>
   <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>
   <li><a href="suporte_tecnico.php">SUPORTE ESCOLAR</a></li>
  </ul>
        

    </nav>
  

</div><!-- box_menu -->
</body>
</html>