<?php $painel_atual = "Aluno";?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">

<?php require_once "../config.php";require "../gerador_cobranca.php";

$ano = Date('Y');
$mes=Date('m');
if($mes==01){
  $ano=$ano-1;
}

 



$result=$pdo->query("SELECT cat.id_categoria,c.curso,e.matricula,e.nome,e.cpf,e.id_estudantes,ce.ano_letivo,ce.id_cursos FROM estudantes e 

INNER JOIN cursos_estudantes ce on ce.id_estudantes=e.id_estudantes 

INNER JOIN cursos c on ce.id_cursos=c.id_cursos 

INNER JOIN categoria cat on c.id_categoria=cat.id_categoria

 WHERE e.matricula ='$code' and ce.ano_letivo='$ano'");

 $result=$result->fetchAll(PDO::FETCH_ASSOC);

	foreach($result as $key=>$r_aluno){

		$nome = $r_aluno['nome'];

		$serie = $r_aluno['id_cursos'];

    $cpf = $r_aluno['cpf'];

    $code=$r_aluno['matricula'];

    $id_aluno=$r_aluno['id_estudantes'];

    $categoria=$r_aluno['id_categoria'];

  }

?>

<title> Portal do aluno</title>

<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">



<!-- Optional theme -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">



<link rel="shortcut icon" href="../image/logo.png">

<link href="css/toposs.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="css/estilo.css">

<script language="javascript" src="../js/jquery-1.7.2.min.js"></script>

<script src="../js/lightbox.js"></script>

<link href="../css/lightbox.css" rel="stylesheet" />

<style>

#box_topo{display:none;}

</style>



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

   <img id="img" src="../image/logo.png">  

 </div><!-- logo -->

 

 <div id="mostra_login">

  <h1><strong>Olá </strong> <?php echo $rest = substr($nome,0,9).'...';?><strong>, seu código é <?php echo @$code;?></strong></h1>

 </div><!-- mostra_login -->

</div><!-- box_topo -->

<div id="menu">

<input type="checkbox" id="bt_menu" />

    <label for="bt_menu">&#9776;</label>

    <nav class="menu">

    <ul>



    <?php $verifica=$pdo->query("SELECT contrato_id from contrato where matricula='$code'");

        $verifica=$verifica->fetchAll(PDO::FETCH_ASSOC);

        $countContrato=count($verifica);

          foreach($verifica as $key=>$contrato){

            $id_contrato=$contrato['contrato_id'];

          }

        if($countContrato==0){

          echo '<li><a href="index.php">HOME 

          <span class="badge badge-light" style="font-size:6px; background-color:red;">CONTRATO</span></a> 

          <ul>

          <li>

            <a href="Contrato/contrato_cliente.php?id='.$id_aluno.'&matricula='.$code.'">Renovar contrato</a>

          </li>

          </ul>

          </li>';

        }else

        {

          echo '<li><a href="index.php">HOME </a> 

          <ul>

          <li>

            <a href="Contrato/contrato_Assinado.php?contrato='.$id_contrato.'">Contrato</a>

          </li>

          </ul>

          </li>';

        }

        ?>

   

          <!-- if($countContrato==0){

           echo '<span class="badge badge-light" style="font-size:6px; background-color:red;">CONTRATO</span></a>';  

           ?>

          <ul>

          <li>

            <a href="Contrato/contrato_cliente.php?id=<?=$id_aluno;?>&matricula=<?=$code?>">Renovar contrato</a>

          </li>

          </ul>

       

          //   echo '

          //   <ul>

          // <li>

          //   <a href="Contrato/contrato_cliente.php?id=<?=$id_aluno;?>&matricula=<?=$code?>">Contrato</a>

          // </li>

          // </ul>

          //   '; -->



   <li><a href="minhas_notas.php?pg=bimestrais">MINHAS NOTAS  <span class="badge badge-light" style="font-size:6px; background-color:red;">&</span></a>

    <?php if($categoria=="3"){?>

    <ul>

     <!--<li><a href="minhas_notas.php?pg=trabalhos" align="center">1ªAVA</a></li>-->

     <!--<li><a href="minhas_notas.php?pg=coc" align="center" >2ªAVA</a></li>-->

     <!--<li><a href="minhas_notas.php?pg=teste" align="center">3ªAVA</a></li>-->

     <!--<li><a href="minhas_notas.php?pg=provas" align="center">4ªAVA</a></li>-->

     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Média Geral</a></li>

     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição do Bimestre</a></li>
     <li><a href="resultado.php?pg=distribuicao" align="center">Resultados</a></li>

    </ul>

    <?php }elseif($categoria=="4"){

    ?>

    <ul>

    <!--<li><a href="minhas_notas.php?pg=trabalhos" align="center">1ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=coc" align="center" >2ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=teste" align="center">3ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=provas" align="center">4ªAVA</a></li>-->

     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Média Geral</a></li>

     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição do Bimestre</a></li>
     <li><a href="resultado.php?pg=distribuicao" align="center">Resultados</a></li>

    </ul>

    <?php

    }elseif($categoria=="1"){

    ?>

    <ul>

    <!--<li><a href="minhas_notas.php?pg=trabalhos" align="center">1ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=coc" align="center" >2ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=teste" align="center">3ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=provas" align="center">4ªAVA</a></li>-->

     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Média Geral</a></li>

     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição por Bimestre</a></li>
     <li><a href="resultado.php?pg=distribuicao" align="center">Resultados</a></li>

    </ul>

    <?php

    }elseif($categoria=="2"){

    ?>

    <ul>

    <!--<li><a href="minhas_notas.php?pg=trabalhos" align="center">1ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=coc" align="center" >2ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=teste" align="center">3ªAVA</a></li>-->

    <!-- <li><a href="minhas_notas.php?pg=provas" align="center">4ªAVA</a></li>-->

     <li><a href="minhas_notas.php?pg=bimestrais" align="center">Média Geral</a></li>

     <li><a href="minhas_notas.php?pg=distribuicao" align="center">Distribuição por Bimestre</a></li>
     <li><a href="resultado.php?pg=distribuicao" align="center">Resultados</a></li>

    </ul>

    <?php

    }

    ?>

   </li>

   <!-- <li><a href="">TRABALHOS</a>

    <ul>

     <li><a href="trabalhos.php?pg=trabalhos_bimestrais">Trabalhos bimestrais</a></li>

     <li><a href="trabalhos.php?pg=trabalhos_extras">Trabalhos extras</a></li>

    </ul>

   </li>     -->

   <li><a href="frequencia.php">FREQUENCIA ESCOLAR</a></li>

   <li><a href="setor_financeiro.php">SETOR FINANCEIRO</a></li>

   <li><a href="suporte_tecnico.php">SUPORTE ESCOLAR</a></li>

   <li><a href="../config.php?acao=quebra">SAIR</a></li>

  </ul>

        



    </nav>

  



</div><!-- box_menu -->

</body>

</html>