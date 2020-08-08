<?php require_once "../Control/conexao.php";
require 'classes/produto_class.php';
$p= new Produto_class();
$p-> ExecutaConexao();

// if(isset($_GET['id'])&& !empty($_GET['id'])){
//   $id=addslashes($_GET['id']);

// }else{
//     // header('location: produtos.php');
// }

$dadosAlbum=$p->buscarGaleria();


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Escola IST</title>
    <link rel="shortcut icon" href="../image/logo.png">
    <!-- Favicon-->
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" /> -->
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <style>
   
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <img src="../image/logo.png" alt="" style="float:left;margin-right:10px;width:90px;height:40px;">
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
                            href="login.php">Acesso Interno</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    <br>
    <br>
    </div>
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
           <!-- Portfolio Grid Items-->
            <div class="row">
                <?php 
                    for ($i=0; $i < count($dadosAlbum) ; $i++) { 
                        # code...
                   
                ?>
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-1 mt-2">
                <div class="" >
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <a href="outdoor.php">
                        <h5 class="tit text-center">Cadastro imagens Outdoor</h5>
                        <img class="img-fluid" src="../assets/img/portfolio/10.png" alt="" />
                        </a>
                    </div>
                </div>
                <?php  }?>
        </div>
                
    </section>
   </body>
   
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Localização</h4>
                    <p class="lead mb-0">
                    Avenida Francisco Araújo de Souza, s/n.
                        <br /> Tucano, Ba                    </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Siga-nos</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
                    
                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                   <h4 class="text-uppercase mb-4">Sobre o Desenvolvedor</h4>
                    <p class="lead mb-0">
                     Start Bootstrap LLC
                        <a href="#">modificado por Mauricio Macedo</a> .
                    </p>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright © Escola IST</small></div>
    </div>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i
                class="fa fa-chevron-up"></i></a>
    </div>
    <!-- Portfolio Modals-->
   
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <!-- Bootstrap core JS-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/js.js"></script>
    <!-- Contact form JS-->
    <!-- <script src="assets/mail/jqBootstrapValidation.js"></script> -->
    <!-- <script src="assets/mail/contact_me.js"></script> -->
    <!-- Core theme JS-->
    
</body>

</html>