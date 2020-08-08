<?php require_once "Control/conexao.php";
require 'site/classes/produto_class.php';
$p= new Produto_class();
$p-> ExecutaConexao();
$id="5";
// if(isset($_GET['id'])&& !empty($_GET['id'])){
//   $id=addslashes($_GET['id']);

// }else{
//     // header('location: produtos.php');
// }
// $outdoor=$p->buscarOutdoors();
$dadosProduto=$p->buscarProdutosPorId($id);
$dadosImagem=$p->ImagensEstrutura();
$outdoor=$p->buscarOutdoors();


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
                            href="#portfolio">Portfolio</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="#about">Nossa História</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="#contact">Contato</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="login.php">Acesso Interno</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <!-- <img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt="" /> -->
            <!-- Masthead Heading-->
            <!-- <h1 class="masthead-heading text-uppercase mb-0">Escola com sistema COC</h1> -->
            <!-- Icon Divider-->
            <!-- <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div> -->
            <div class="slide_title carousel">
                <div class="slide_nav_title">
                    <div class="slide_nav_item_title b  carousel-control-prev"> <span class="carousel-control-prev-icon"
                            aria-hidden="true"></span></div>
                    <div class="slide_nav_item_title g carousel-control-next"> <span class="carousel-control-next-icon"
                            aria-hidden="true"></span></div>
                </div>
                <?php 
            // foreach ($dadosImagem as $value) {
            //     # code...
            // var_dump($dadosImagem);
        //    echo count($outdoor);
            for($c=0;$c<count($outdoor);$c++){
                // echo "este é a imagem ".$dadosImagem[$c]['nome_imagem'];    
                $slide_title=str_pad($c,2,0,STR_PAD_LEFT);
                $first_title=($c==1?' fis' : '');

        ?>
                <article class="slide_item_title <?= $first_title;?>">
                    <?php 
                // foreach($dadosImagem as $value){
                    ?>
                    <a href="<?= $outdoor[$c]['descricao']?>" target="_blank" rel="noopener noreferrer">
                    <img id="image" src="anexos/outdoor/<?= $outdoor[$c]['foto_capa'];?>" alt="">
                    <!-- <div class="slide_item_desc">
                    <h1>es=< $slide." ";?>opa</h1>
                    <p>sçdlasçdlçasldasçdlçsadlsaçdlsçad</p>
                </div> -->
                </a>
                </article>
                <?php  }?>


                <!-- <div id="imagens">
            <div class="caixa-img"><img id="image" src="anexos/outdoor/<?php echo $value['nome_imagem']?>" alt=""></div>
        </div> -->
                <?php 
        //}?>



            </div>
            <!-- Masthead Subheading-->
            <!-- <p class="masthead-subheading font-weight-light mb-0">Escola de qualidade - Dedicação - Educação </p> -->
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModalreg">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nosso Regimento Escolar</h5>
                        <img class="img-fluid" src="assets/img/portfolio/2.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModalestru">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nossa Estrutura Interna</h5>
                        <img class="img-fluid" src="assets/img/portfolio/14.png" alt="" />

                    </div>
                </div>
                <!-- Portfolio Item 3-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModalObj">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nosso Objetivo</h5>
                        <img class="img-fluid" src="assets/img/portfolio/6.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 4-->
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal4">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nosso Propósito</h5>
                        <img class="img-fluid" src="assets/img/portfolio/12.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 5-->
                <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal5">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nossa Equipe</h5>
                        <img class="img-fluid" src="assets/img/portfolio/16.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 6-->
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal6">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Nossos Professores</h5>
                        <img class="img-fluid" src="assets/img/portfolio/1.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="row ">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Calendário Escolar</h5>
                        <img class="img-fluid" src="assets/img/portfolio/15.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Projetos</h5>
                        <img class="img-fluid" src="assets/img/portfolio/22.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 3-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Ciclos de Ensino</h5>
                        <img class="img-fluid" src="assets/img/portfolio/19.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 4-->
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModalcoc">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>

                        </div>
                        <h5 class="tit">COC</h5>
                        <img class="img-fluid" src="assets/img/portfolio/coc.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 5-->
                <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal5">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Eventos</h5>
                        <img class="img-fluid" src="assets/img/portfolio/17.png" alt="" />
                    </div>
                </div>
                <!-- Portfolio Item 6-->
                <div class="col-md-6 col-lg-4">
                    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModalgaleria">
                        <div
                            class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                            <div class="portfolio-item-caption-content text-center text-white"><i
                                    class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <h5 class="tit">Galeria</h5>
                        <img class="img-fluid" src="assets/img/portfolio/18.png" alt="" />
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">Nossa História</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="ml-auto">
                    <p class="lead">
                        <p>Enquanto pessoas comuns, tivemos certo dia, o sonho de abrirmos um espaço - uma escola - onde
                            pudéssemos oferecer a nossa comunidade condições para que desenvolvessem o senso crítico,
                            serem verdadeiros construtores e realizadores de suas aspirações.</p>
                        <p> Enquanto educadoras, firmamos o compromisso de formar cidadãos que contribuam com a
                            transformação da sociedade, que se comprometam com o exercício de uma democracia plena, onde
                            cada vez mais não haja espaço para injustiças sociais. Pautada nestas concepções, abrimos
                            uma ESCOLA que, apesar das tantas dificuldades, temos investido num trabalho pedagógico que
                            tem o aluno como centro, sujeito e objeto do próprio conhecimento, respeitando suas
                            individualidades, diversidades e limites, proporcionando situações em que ela possa vencer
                            suas barreiras e, de fato, atingir os alvos de uma formação integral e uma aprendizagem de
                            qualidade.</p>
                        <p>Pensando assim, procuramos nos integrar ao mundo da EDUCAÇÃO, tanto através do convênio
                            firmado com a rede "COC" quanto, através da informática, fazendo parte do mundo tecnológico,
                            via INTERNET, levando nossos alunos a conhecer esse mundo e tudo aquilo que ele necessita,
                            não para ser CIDADÃO PENSANTE, pois assim já o recebemos, mas para possibilitar ações, a fim
                            de que seu (s) pensamento (s) seja (m) colocado (s) para o mundo, país, estado e/ou
                            município e, através de seu potencial, ajude na transformação da sociedade. </p>
                        <p>No entanto, sabemos que para atingir estas metas, a educacional e a escolar, é preciso que
                            haja uma preocupação extrema com os aspectos pedagógicos que norteiam a vida da Escola. E é
                            por isso que o IST procura ter seu Projeto Político Pedagógico (PPP) fundamentado em
                            políticas pedagógicas consistentes e que referenciam a Educação Nacional, como os Parâmetros
                            Curriculares Nacionais (PCN) que traz no bojo de suas propostas objetivos, que julgamos
                            essenciais à formação do homem moderno. </p>
                        <p>Aqui no IST, a criança é o centro de um processo que se inicia na educação infantil e se
                            estende por toda a vida. É na educação infantil que a criança constrói a base da cidadania,
                            da ética, dos valores, através de uma educação voltada para os estágios de desenvolvimento.
                        </p>
                    </p>
                </div>
            </div>
            <!-- About Section Button-->

        </div>
    </section>
    <!-- Contact Section-->
    <section class="page-section" id="contact">
        <div class="container">
            <!-- Contact Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contato</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Contact Section Form-->
            <div class="page-section-heading text-center  text-secondary mb-0">
                <h4>Telefones:

                    <p>fixo:(075) 3272-2160</p>
                    <p>Celular: (75) 9 9191-4856 (tim)</p>
                </h4>
            </div>
            <div class="page-section-heading text-center text-secondary mb-0">
                <h4>Endereço:
                    <p>Avenida Francisco Araújo de Souza, s/n.</p>
                    <p>Centro-cep 487930-000.</p>
                    <p>Ponto de referência: Ao lado da Rodoviária.</p>
                </h4>
            </div>
            <div class="page-section-heading text-center   text-secondary mb-0">
                <h4>E-mail:</h4>
            </div>
            <p class="text-center text-secondary"> institutosocialdetucano@gmail.com</p>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <!-- Footer Location-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Localização</h4>
                    <p class="lead mb-0">
                        Avenida Francisco Araújo de Souza, s/n.
                        <br /> Tucano, Ba </p>
                </div>
                <!-- Footer Social Icons-->
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Siga-nos</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-instagram"></i></a>

                </div>
                <!-- Footer About Text-->
                <div class="col-lg-4">
                    <h4 class="text-uppercase mb-4">Sobre o Desenvolvedor</h4>
                    <p class="lead mb-0">
                        Start Bootstrap LLC
                        <a href="#">modificado por Mauricio Macedo</a> .
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
    <!-- Portfolio Modal 1-->
    <div class="portfolio-modal modal fade" id="portfolioModalreg" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal1Label">Regimento Escolar</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="" />
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">Para ler todo o conteúdo do Regimento Escolar, visualizar todos os
                                    Títulos, Capítulos e Sessões, clicar ao lado, em formato PDF. Atenção está priobido
                                    toda e qualquer copia ou utilização deste documento sem autorização do proprietario.
                                </p>
                                <div>
                                    <ul>
                                        <li>
                                            <p>Ler:</p>
                                            <a href="leitura.php?file=1">Regimento escolar - PDF</a>
                                        </li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 2-->
    <div class="portfolio-modal modal fade" id="portfolioModalestru" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal2Label">Estrutura Escolar</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <!-- Portfolio Modal - Image-->
                                <!-- <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cake.png" alt="" /> -->
                                <!-- Portfolio Modal - Text-->
                                <section class="slide">
                                    <div class="slide_nav">
                                        <div class="slide_nav_item b">&laquo;</div>
                                        <div class="slide_nav_item g">&raquo;</div>
                                    </div>
                                    <?php
                                    $img='7';
                                    $Albumestru=$p->buscarProdutosPorId($img);
                                    $imgEstru=$p->buscarImagensPorId($img);
                                    // for($c=1;$c<=20;$c++){
                                    //     echo '<div class="fotos"><img id="image" src="assets/img/portfolio/'.$c.'.png" alt=""></div>';
                                    // }
                                    for($i=1;$i<count($imgEstru);$i++){
                                        $slide=str_pad($i,2,0,STR_PAD_LEFT);
                                        $first=($i==1?' fis' : '');

                                ?>
                                    <article class="slide_item <?= $first;?>">
                                        <img src="anexos/imagens-internas/<?php echo $imgEstru[$i]['nome_imagem'];?>"
                                            alt="">
                                        <!-- <div class="slide_item_desc">
                                            <h1>es=< $slide." ";?>opa</h1>
                                            <p>sçdlasçdlçasldasçdlçsadlsaçdlsçad</p>
                                        </div> -->

                                    </article>
                                    <?php }?>
                                </section>


                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 3-->
    <div class="portfolio-modal modal fade" id="portfolioModalObj" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal3Label">Objetivo e Metas</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <!-- <img class="img-fluid rounded mb-5" src="assets/img/portfolio/circus.png" alt="" /> -->
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-5">
                                    <ul>
                                        <li class="lista">Oferecer serviços educacionais de qualidade, garantindo a
                                            formação de sujeitos capazes de acompanhar as transformações inerentes ao
                                            processo de formação de uma nova sociedade, mais justa e igualitária,
                                            atuando desde a Educação Infantil até o Ensino Médio, de acordo com os
                                            Marcos Legais da Educação Brasileira e dos Conselhos Estadual e Municipal da
                                            Educação.</li>
                                        <li class="lista">Criar condições para o desenvolvimento integral dos alunos, em
                                            seus diferentes níveis, proporcionando o desenvolvimento das capacidades
                                            física, afetiva, cognitiva, ética, estética, de relação interpessoal e de
                                            inserção social, considerando diferentes habilidades, interesses e maneiras
                                            de aprender.</li>
                                        <li class="lista"> Possibilitar à comunidade tucanense o contato com parte do
                                            cabedal cultural, científico e esportivo utilizado na formação dos sujeitos,
                                            em forma de eventos abertos, de forma a cumprir a missão de Instituição
                                            Social.</li>
                                        <li class="lista">Sensibilizar e envolver a comunidade escolar na efetivação de
                                            uma política de educação inclusiva.</li>
                                        <li class="lista">Alterar aspectos metodológicos da prática educativa realizada
                                            pelos professores, valorizando a relação teoria-prática na construção de
                                            planejamentos interdisciplinares e coletivos, evitando assim a fragmentação
                                            do saber e a dicotomia conhecimento/vida.</li>
                                        <li class="lista">Proporcionar a integração de todos os envolvidos no processo
                                            ensino-aprendizagem, desde a participação nos encontros de formação e
                                            planejamento até às reuniões de pais e eventos escolares.</li>
                                        <li class="lista"> Discutir com pais e alunos, bimestralmente, os resultados dos
                                            trabalhos desenvolvidos, contribuindo para o planejamento do período
                                            ulterior;</li>
                                        <li class="lista">Melhorar as instalações da Escola, bem como o atendimento em
                                            termos de recursos humanos e materiais.</li>
                                        <li class="lista">Investir em um programa de informatização da Escola.</li>
                                        <li class="lista">Reduzir os índices de inadimplência dos alunos a fim de
                                            garantir novos investimentos na Escola.</li>
                                        <li class="lista">Promover o envolvimento da comunidade escolar com atividades
                                            de leitura, através de uma caminhada prazerosa. </li>


                                    </ul>
                                </p>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 4-->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal4Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal4Label">Nosso Propósito</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <!-- <img class="img-fluid rounded mb-5" src="assets/img/portfolio/game.png" alt="" /> -->
                                <!-- Portfolio Modal - Text-->
                                <h4 class="">FILOSOFIA</h4>
                                <p class="missao">O Instituto Social de Tucano tem uma concepção ampla de educação, não
                                    se restringindo apenas à “transmissão” do conhecimento acumulado no decorrer da
                                    história da humanidade. Na verdade, não se admite que a postura da escola seja de
                                    transmissora do saber, mas de mediadora de um conhecimento que deve ser construído a
                                    partir dos estágios de desenvolvimento do indivíduo, ligando-o a uma realidade
                                    concreta.
                                    Esta concepção ampla de educação impulsiona os atores/sujeitos dessa Unidade de
                                    Ensino a uma práxis pedagógica voltada para a formação integral do homem, em seus
                                    aspectos totalizantes e, para tanto, procura fazer uso de reflexões acerca de uma
                                    educação holística, crítica e progressista, por entender que o aluno é um ser que
                                    tem história e que é capaz de interagir com o seu meio, transformando-o.</p>
                                <p class="missao">
                                    Apesar de enfrentar dificuldades de aprendizagem do aluno, pelo fato de recebê-lo de
                                    outras escolas que privilegiam a memorização, pouco investem na leitura, e muitos
                                    pais entenderem que o resultado quantitativo deve sobrepor-se ao qualitativo, o
                                    Instituto Social de Tucano busca empreender uma conscientização entre os envolvidos
                                    no processo ensino-aprendizagem sobre a necessidade de se “aprender a aprender”.
                                    Percebe-se, pois, que é preciso investir cada vez mais na capacidade de iniciativa
                                    do aluno, possibilitando o processo de autonomia – condição sem a qual não se pode
                                    viver nesse mundo moderno –, que resultará numa atitude de pensar, repensar, fazer,
                                    refazer, criar, recriar, decidir e agir diante do mundo. Estando aberto às novas
                                    perspectivas educacionais no que se refere tanto ao resgate dos valores humanos, que
                                    envolve a construção do ser-cidadão mais humanizado e consciente de seu estar no
                                    mundo, excluindo, dessa forma, a postura acrítica diante dos fatos vivenciados e
                                    voltando-se para os coletivos onde os conceitos de solidariedade, união, justiça
                                    estão presentes, quanto à formação do ser-cidadão-trabalhador que deve estar em
                                    consonância com as questões atuais do mundo globalizado, o Instituto Social de
                                    Tucano busca efetivar nas subjetividades e heterogeneidades coletivas o processo de
                                    desvelamento das identidades pessoais, ou seja, a questão de “ser e estar” no mundo,
                                    de como esses sujeitos se implicam com as situações a eles apresentadas.
                                </p>

                                <h4 class="">MISSÃO</h4>
                                <p class="missao">Assegurar um ensino de qualidade, garantindo o acesso e a permanência
                                    do aluno na escola e a sua transformação em cidadão planetário, capaz de transformar
                                    a realidade na qual está inserido, assimilando uma formação ética e de respeito a si
                                    e aos outros.</p>

                                <h4 class="">PRINCÍPIOS</h4>
                                <ul>
                                    <li class="lista">Igualdade de condições para o acesso e permanência na escola.</li>
                                    <li class="lista">Liberdade de aprender, ensinar, pesquisar e divulgar a cultura, o
                                        pensamento, a arte e o saber.</li>
                                    <li class="lista">Pluralismo de idéias e concepções pedagógicas.</li>
                                    <li class="lista">Respeito à liberdade e apreço à tolerância.</li>
                                    <li class="lista">Garantia de padrão de qualidade.</li>
                                    <li class="lista">Valorização da experiência extra-escolar.</li>
                                    <li class="lista">Vinculação entre a educação escolar, o trabalho e as práticas
                                        sociais.</li>

                                </ul>
                                <h4 class="">ESCOLA</h4>
                                <p class="missao">O Instituto Social de Tucano foi fundado em 06 de março de 1995, pelas
                                    atuais proprietárias, diretora e vice-diretora, Maria Albertina Dantas dos Santos e
                                    Vilma Miranda de Almeida, com o objetivo de que alguns alunos ao saírem para os
                                    grandes centros urbanos, em busca de prosseguimento dos estudos, não enfrentassem
                                    tantas dificuldades de aprendizagem.</p>
                                <p class="missao">
                                    Escola da rede particular de ensino, na sede do município de Tucano, atende alunos
                                    das mais diferentes localidades deste município. Tem a Rede Objetivo de Ensino como
                                    parceira no processo de ensino-aprendizagem dos alunos matriculados.
                                </p>
                                <p class="missao">
                                    O Instituto Social de Tucano está inserido num contexto de transição histórica onde
                                    fatos do passado contribuem para o surgimento de uma sociedade que se modifica numa
                                    velocidade vertiginosa, mediante aos avanços da cibernética, à integração cultural,
                                    política e econômica que gera o fenômeno da globalização, reduzindo limites e
                                    distâncias geográficas. Há, também, nessa sociedade em formação, a emergência de uma
                                    crise que atinge, principalmente, aos países em desenvolvimento, onde as empresas
                                    privadas se multiplicam, geram-se cartéis, o desemprego urbano assola a população e
                                    os conflitos resultantes desses acontecimentos conduzem o homem contemporâneo à
                                    busca de prazeres imediatos.
                                </p>
                                <p class="missao">
                                    Neste sentido, oferecer uma formação integral que possibilite uma identidade, ao
                                    mesmo tempo pessoal e planetária, requer do IST o respaldo de toda a experiência
                                    acumulada ao longo dos 15 anos de existência e da capacidade de sua equipe de
                                    estudar e empreender a busca por uma educação significativa. Isso se consolida com o
                                    ingresso de 80% dos seus alunos egressos do Ensino Médio na Universidade e que,
                                    atualmente, já compõem o quadro dos novos profissionais do mercado, cujas
                                    trajetórias tiveram início dentro dessa Escola.
                                </p>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 5-->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal5Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal5Label">Nossa Equipe</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <!-- <img class="img-fluid rounded mb-5" src="assets/img/portfolio/safe.png" alt="" /> -->

                                <!-- Portfolio Modal - Text-->
                                <h4 class="">DIREÇÃO</h4>
                                <p class="">MARIA ALBERTINA DANTAS DOS SANTOS. (DIRETORA)</p>
                                <p class="">VILMA MIRANDA DE ALMEIDA. (VICE-DIRETORA)</p>
                                <br><br>
                                <h4 class="">COORDENADORES PEDAGÓGICOS</h4>
                                <p class="">MARIA CONCEIÇÃO PIMENTEL DOS SANTOS. (ED. INF. E ENSINO FUNDAMENTAL I)</p>
                                <p class="">GREGÓRIO LUÍS DE JESUS. (ENS. FUNDAMENTAL II E MÉDIO)</p>
                                <p class="">JOANNA SOUSA SANTANA.</p>
                                <br>
                                <h4 class="">SECRETÁRIAS</h4>
                                <p class="">ÍSIS MIRANDA CAVALCANTE DE ALBUQUERQUE. (EMISSÃO DE NFS).</p>
                                <p class="">ZILMARA FERREIRA DA SILVA. (EMISSÃO DE BOLETOS).</p>
                                <br>
                                <h4 class="">DIGITADORAS</h4>
                                <p class="">ISA FABIANA MIRANDA RIBEIRO.</p>
                                <p class="">MÉRCIA CABRAL MORAES RAMOS.</p>
                                <br>
                                <h4 class="">FOTÓGRAFA</h4>
                                <p class="">VANESSA PIMENTEL DE JESUS.</p>
                                <br>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 6-->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal6Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                                              
                                <!-- Header -->
                                <header class="bg-primary text-center py-5 mb-4">
                                    <div class="container">
                                        <h1 class="font-weight-light text-white">Nossos Professores</h1>
                                    </div>
                                </header>

                                <!-- Page Content -->
                                <div class="container">
                                    <div class="row">
                                        <!-- Team Member 1 -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/TMgQMXoglsM/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">professor</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Team Member 2 -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/9UVmlIb0wJU/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Team Member 3 -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/sNut2MqSmds/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Team Member 4 -->
                                        <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/ZI6p3i9SbVU/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Team Member 4 -->
                                         <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/ZI6p3i9SbVU/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Team Member 4 -->
                                         <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/ZI6p3i9SbVU/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                         <!-- Team Member 4 -->
                                         <div class="col-xl-3 col-md-6 mb-4">
                                            <div class="card border-0 shadow">
                                                <img src="https://source.unsplash.com/ZI6p3i9SbVU/500x350"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title mb-0">Team Member</h5>
                                                    <div class="card-text text-black-50">Web Developer</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.container -->
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModalcoc" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal6Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal6Label">Sistema COC de Ensino</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/coc.png" alt="" />
                                <!-- Portfolio Modal - Text-->
                                <h2 class="portfolio-modal-title text-secondary mb-5" id="portfolioModal6Label">Mais de
                                    50 anos no mercado de educação</h2>
                                <p class="mb-5">Há mais de 50 anos o Sistema COC de Ensino alia pioneirismo em
                                    tecnologia, inovação e qualidade. Referência desde a educação infantil até o
                                    pré-vestibular, sua metodologia exclusiva proporciona um ensino multiconectado,
                                    repleto de soluções educacionais e conteúdos digitais, que prepara os alunos não só
                                    para o vestibular, mas para a vida inteira.</p>

                                <div class="mb-5">
                                    <a class="text-uppercase" target="_blank" href="https://www.coc.com.br">clique e
                                        saiba mais</a>
                                </div>
                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 6-->
    <div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal6Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal6Label">GALERIA</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image
                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="" />
                                Portfolio Modal - Text-->
                                <!-- <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur
                                    itaque. Nam.</p> -->
                                <div class="container">

                                    <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Estrutura Interna
                                    </h1>

                                    <hr class="mt-2 mb-5">

                                    <div class="row text-center text-lg-left">
                                        <?php   $dadosProduto=$p->buscarProdutos();
                                                if(empty($dadosProduto)){
                                                    echo 'Ainda não possui produtos cadastrados';
                                                }else
                                                {
                                                    foreach ($dadosProduto as $value) {
                                                        # code...
                                                        ?>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="https://source.unsplash.com/pWkk7iiCoDM/400x300"
                                                class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
                                            </a>
                                        </div>
                                        <?php } }?>
                                        <!-- <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/aJeH0KcFkuc/400x300" alt="">
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="https://source.unsplash.com/p2TQ-3Bh3Oo/400x300" alt="">
                                            </a>
                                        </div> -->
                                    </div>

                                </div>
                                <!-- /.container -->


                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- galeria -->
    <!-- Portfolio Modal 6-->
    <div class="portfolio-modal modal fade" id="portfolioModalgaleria" tabindex="-1" role="dialog"
        aria-labelledby="portfolioModal6Label" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
                <div class="modal-body text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"
                                    id="portfolioModal6Label">GALERIA</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image
                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="" />
                                Portfolio Modal - Text-->
                                <!-- <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur
                                    itaque. Nam.</p> -->


                                <div class="container">

                                    <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">
                                    </h1>

                                    <hr class="mt-2 mb-5">

                                    <div class="row text-center text-lg-left">
                                        <?php   $dadosProduto=$p->buscarGaleria();
                                                if(empty($dadosProduto)){
                                                    echo 'Ainda não possui produtos cadastrados';
                                                }else
                                                {
                                                    foreach ($dadosProduto as $value) {
                                                        # code...
                                                        ?>
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <a href="imagem.php?id=<?= $value['id_album'];?>"
                                                class="d-block mb-4 h-100">
                                                <img class="img-fluid img-thumbnail"
                                                    src="anexos/imagens-internas/<?= $value['foto_capa'];?>" alt="">
                                            </a>
                                        </div>
                                        <?php } }?>

                                        <!-- <div class="col-lg-3 col-md-4 col-6">
        <a href="https://source.unsplash.com/pWkk7iiCoDM/400x300" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
       
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/aJeH0KcFkuc/400x300" alt="">
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
        <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail"
                src="https://source.unsplash.com/p2TQ-3Bh3Oo/400x300" alt="">
        </a>
    </div> -->
                                    </div>

                                </div>
                                <!-- /.container -->

                                <button class="btn btn-primary" data-dismiss="modal">
                                    <i class="fas fa-times fa-fw"></i>
                                    Close Window
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fim galeria -->
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