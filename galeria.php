<?php $num_paginas=4;
$countReg=0;
$itens_por_pagina=8;
$item4='';

require_once  "Control/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-R">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Escola IST</title>
    <link rel="shortcut icon" href="image/logo.png">
    <!-- Favicon-->
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" /> -->
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="galeri.css">
    <style>

    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <img src="image/logo.png" alt="" style="float:left;margin-right:10px;width:90px;height:40px;">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Escola IST </a>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="index.php">Sair da galeria</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <br><br><br><br>
    <div class="container box">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <form method="post">
                    <div class="registro">


                        <select onChange="submit();" class="form-control-sm" id="exampleFormControlSelect1"
                            name="itens-pagina" >

                            <?php 

						if(isset($_POST['itens-pagina'])){
							$item_paginado = $_POST['itens-pagina'];
						}elseif(@$_GET['l']){
                            $item_paginado=$_GET['l'];
                        }else{
							$item_paginado = 8;
						}

					 ?>

                            <option value="<?php echo @$item_paginado ?>"><?php echo @$item_paginado ?> Registros
                            </option>

                            <?php if(@$item_paginado != $opcao1){ ?>
                            <option value="<?php echo $opcao1 ?>"><?php echo $opcao1 ?> Registros</option>
                            <?php } ?>

                            <?php if(@$item_paginado != $opcao2){ ?>
                            <option value="<?php echo $opcao2 ?>"><?php echo $opcao2 ?> Registros</option>
                            <?php } ?>

                            <?php if(@$item_paginado != $opcao3){ ?>
                            <option value="<?php echo $opcao3 ?>"><?php echo $opcao3 ?> Registros</option>
                            <?php } ?>




                        </select>


                    </div>
                </form>
            </div>
        </div>
        <?php

//DEFINIR O NUMERO DE ITENS POR PÁGINA  
if(isset($_POST['itens-pagina'])){
    $limite = $_POST['itens-pagina'];
}elseif(@$_GET['l']){
    $limite = $_GET['l'];
}else{
    $limite = $opcao1;
}




//CAMINHO DA PAGINAÇÃO
$caminho_pag = 'galeria.php?galeria=3';


if(isset($_GET['galeria']) and @$_GET['txtbuscar'] != ''){
   
//     $nome_buscar = '%'.$_GET['txtbuscar'].'%';
//     $res = $pdo->prepare("SELECT * from usuarios where nome LIKE :nome order by nome asc");
//     $res->bindValue(":nome", $nome_buscar);
//     $res->execute();
}elseif(@$_GET['pagina']){
    $res = $pdo->query("SELECT nome_imagem from imagens where id_album=".$_GET['galeria']." limit $limite offset ".$_GET['pagina']);
    $res =$res->fetchAll(PDO::FETCH_ASSOC);
    $countReg= count($res);
    // echo "SELECT nome_imagem from imagens where id_album=".$_GET['galeria']." limit $limite offset $itens_por_pagina";

//  echo  $num_paginas = $countReg  / $itens_por_pagina;  

}else{
    $res = $pdo->query("SELECT nome_imagem from imagens where id_album=".$_GET['galeria']." limit $limite ");
    $res =$res->fetchAll(PDO::FETCH_ASSOC);
    $countReg= count($res);
    // echo "SELECT nome_imagem from imagens where id_album=".$_GET['galeria']." limit $limite offset $itens_por_pagina";

  $num_paginas = $countReg  / $itens_por_pagina;   
    
}?>



        <div class="container box">

            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">
            </h1>

            <hr class="mt-2 mb-5">

            <div class="row text-center text-lg-left">

                <!--galeriakewen-->

                <ul id="album-galeria">
                <?php for($i=0;$i<$itens_por_pagina;$i++){ ?>
                 <li id="foto"><img class="galeria" src="anexos/imagens-internas/<?=$res[$i]['nome_imagem']?>" alt=""><span>foto01</span>
                    </li>
                <?php } ?>
                    <!-- <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor01.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor02.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor03.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor02.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor03.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor02.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor03.jpg" alt=""><span>foto01</span>
                    </li>
                    <li id="foto"><img class="galeria" src="anexos/outdoor/outdoor02.jpg" alt=""><span>foto01</span>
                    </li> -->

                </ul>

                <div class="center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="btn btn-outline-dark mr-1" href="<?=$caminho_pag?>&pagina=<?php echo @$_GET['pagina']-$itens_por_pagina;?>&l=<?=$limite?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php 
           
            for($i=0;$i<$num_paginas;$i++){
                $v=$i*8;
            $estilo = "";
            if(@$_GET['p'] == $i)
              $estilo = "active";                
            ?>
                            <li class="page-item"><a class="btn btn-outline-dark mr-1 <?= $estilo?>" href="<?=$caminho_pag?>&pagina=<?php echo $v;?>&l=<?=$limite?>&p=<?=$i?>"><?php echo $i+1; ?></a>
                            </li>
                            <?php } ?>

                            <li class="page-item">
                                <a class="btn btn-outline-dark"
                                    href=""
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!--<div class="list">
<div class="item"> item 1</div>
<div class="item"> item 2</div>
<div class="item"> item 3</div>
</div>-->


            <!-- definir o numero de itens ppor pagina -->



</body>
<!-- Footer-->

<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright © Escola IST</small></div>
</div>

</html>